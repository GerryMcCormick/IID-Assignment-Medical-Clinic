<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Doctor;
use DateTimeZone;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;

class AppointmentController extends Controller
{
    private $doctors, $now, $mondayNineAM, $wk3FriFiveThirty, $mon, $fri, $appointments, $timezone;

    // british summer time causing diff of -1 hour, so use Carbon::now(new DateTimeZone('Europe/London'))
    public function __construct(){
        // php date timezone
        date_default_timezone_set('Europe/London');
        // timezone used for Carbon
        $this->timezone = new DateTimeZone('Europe/London');

        $this->doctors          = Doctor::all();
        $this->now              = Carbon::now($this->timezone);
        $this->mon              = Carbon::now($this->timezone)->startOfWeek()->format('l jS F Y');
        $this->fri              = Carbon::now($this->timezone)->startOfWeek()->addDays(4)->format('l jS F Y');

        $this->mondayNineAM     = Carbon::now($this->timezone)->startOfWeek()->addHours(9);
        $this->wk3FriFiveThirty = Carbon::now($this->timezone)->startOfWeek()->addDays(18)->setTime(17, 30);
    }

    // week 1, 2, or 3   mon - fri, dr id 0 = all doctors
    public function availableAppointments($week = 1, $dr_id = 0){
        $page          = 'Available Appointments';
        $doctors       = $this->doctors;
        $wk1Over       = false;

        // if week 1 is over, don't allow it to be displayed, set to week 2 and hide previous week buttons in view
        if(Carbon::now($this->timezone)->isWeekend()){
            $this->mondayNineAM->addDays(7);
            $wk1Over = true;
            if($week == 1){
                $week = 2;
            }
        }

        //sets $this->appointments
        $this->getAppointments($dr_id); // first week (patients only allowed to book 2 weeks in advance)
        $appointments  = $this->appointments;
        //dd($appointments);
        $patient_id    = Auth::user()->id; // must be logged in before landing on this page
        $mon           = $this->mon;
        $fri           = $this->fri;

        // mon and fri dates for displaying appointments in this date range
        if($week == 2){
            $mon = Carbon::now($this->timezone)->startOfWeek()->addDays(7)->format('l jS F Y');
            $fri = Carbon::now($this->timezone)->startOfWeek()->addDays(11)->format('l jS F Y');
        }elseif($week == 3){
            $mon = Carbon::now($this->timezone)->startOfWeek()->addDays(14)->format('l jS F Y');;
            $fri = Carbon::now($this->timezone)->startOfWeek()->addDays(18)->format('l jS F Y');;
        }

        // pagination is done by mon - fri
        return view('page.availableAppointments', compact('page', 'doctors', 'appointments', 'patient_id', 'mon', 'fri',
            'week', 'dr_id', 'wk1Over'));
    }

    public function bookAppointment(Request $request){
        $date       = $request->datetime;
        $dr_id      = $request->dr_id;
        $patient_id = $request->patient_id;

        $app = Appointment::create([
            'datetime'   => $date,
            'doctor_id'  => $dr_id,
            'patient_id' => $patient_id,
        ]);

        return $app->id;
    }


    /**
     * @param bool $cancel - if $cancel = true display flash notification
     * @return mixed
     */
    public function pendingOrPreviousAppointments(){
        $page = 'Pending/Previous Appointments';
        $user = Auth::user();

        $cancelled = isset($_POST['cancelled']) && $_POST['cancelled'] ? true : false;

        $pendingAppointments = Appointment::where('patient_id', $user->id)
                                          ->where('datetime', '>', $this->now)
                                          ->orderBy('datetime')->get();
        $pending = [];
        // formatted array for display in view
        if(count($pendingAppointments) > 0){
            foreach($pendingAppointments as $pen){
                $appointment['time'] = date('H:i l jS F Y', strtotime($pen->datetime));
                $appointment['doctor']['id']   = $pen->doctor_id;
                $appointment['doctor']['name'] = 'Dr ' . $this->doctors[$pen->doctor_id - 1]->surname;
                $appointment['app_id']         = $pen->id;

                $pending[] = $appointment;
            }
        }

        $previousAppointments = Appointment::where('patient_id', $user->id)
                                           ->where('datetime', '<', $this->now)
                                           ->orderBy('datetime')->get();
        $previous = [];
        // formatted array for display in view
        if(count($previousAppointments) > 0){
            foreach($previousAppointments as $pre){
                $appointment['time'] = date('H:i l jS F Y', strtotime($pre->datetime));
                $appointment['doctor']['id']   = $pre->doctor_id;
                $appointment['doctor']['name'] = 'Dr ' . $this->doctors[$pre->doctor_id - 1]->surname;

                $previous[] = $appointment;
            }
        }

        if($cancelled){
            // because flashing to view and not redirecting, flash must be pushed to flash old
            // in session else will be displayed for 2 requests
            Flash::success('Your appointment has been cancelled ' . Auth::user()->first_name);
            Session::push('flash.old', 'flash_notification.message');
            Session::push('flash.old', 'flash_notification.level');
        }

        return view('page.pending_previous', compact('page', 'pending', 'previous'));
    }


    /**
     * @param Request $request - appointment id
     * Cancel an appointment - called from js
     * @return bool $deleted
     */
    public function cancel(Request $request){
        $app_id = $request->app_id;
        $deleted = Appointment::destroy([$app_id]);

        return $deleted;
    }

    private function getAppointments($dr_id){
        // last bookable appointment is 2 weeks from $now at 17.30
        $lastBookable  = Carbon::now($this->timezone)->addWeeks(2)->setTime(17, 30);

        // if weekend (sat/sun) set to previous fri at 5.30
        if($lastBookable->isWeekend()){
            $lastBookable = $lastBookable->startOfWeek()->addDays(4)->setTime(17,30);
        }

        if($dr_id > 0){
            $bookedAppointments = Appointment::where('datetime', '>=', $this->now)->where('doctor_id', $dr_id)->get();
        }else{
            $bookedAppointments = Appointment::where('datetime', '>=', $this->now)->get();
        }

        // set first timeslot of week to $mondayNineAM
        $timeSlot = $this->mondayNineAM;

        while($timeSlot->lte($this->wk3FriFiveThirty)){

            $datetime = $timeSlot->format('Y-m-d H:i:s'); // datetime for time attribute in appointments table when booking
            $index    = $timeSlot->format('YmdHi'); // add dr id to this to get unique appointment id for <a> tag
            $day      = $timeSlot->format('Ddm');
            $time     = $timeSlot->format('H:i');
            $readableDateTime = $timeSlot->format('H:i l jS F Y');

            // appointments < now and > lastbookable should be greyed out/blank
            if($timeSlot->lte($this->now) || $timeSlot->gt($lastBookable) && ($time < '13:00' || $time > '13.45')){
                $this->appointments[$time][$day]['not_available'] = true;
                $this->appointments[$time][$day]['datetime']      = $datetime;
            }

            if($timeSlot->gt($this->now) && $timeSlot->lte($lastBookable) && ($time < '13:00' || $time > '13.45')){ // add && <= lastbookable
                // check which docs have appointments booked for this timeslot
                $bookedDocsIds = [];

                $appointmentsForTimeslot = $bookedAppointments->where('datetime', $datetime);
                foreach($appointmentsForTimeslot as $ba){
                    // get id's of docs booked for this timeslot
                    if($ba->datetime == $timeSlot){
                        $bookedDocsIds[] = $ba->doctor_id;
                    }
                }
                if($dr_id == 0){ // all doctors
                    foreach($this->doctors as $d){
                        $this->addAvailableAppointmentsToArray($d, $datetime, $index, $bookedDocsIds, $readableDateTime, $time, $day);
                    }
                }else{// specific dr
                    $d = $this->doctors[$dr_id - 1];
                    $this->addAvailableAppointmentsToArray($d, $datetime, $index, $bookedDocsIds, $readableDateTime, $time, $day);
                }

                unset($bookedDocsIds);
            }

            if($time == '13:00'){ // don't add appointments for lunchtime
                $timeSlot->addHour();
            }else{
                // increment appointment time by 15 mins
                $timeSlot->addMinutes(15);
            }

            // if $timeslot > 5.30, set timeslot to next morning at 9 am
            if($timeSlot->hour == 17 && $timeSlot->minute > 30){
                $timeSlot->addDay()->setTime(9, 0);
            }
            // if $timeslot > last booking of first week (fri 17.30), set timeslot to mon 9 am - start of 2nd week
            if($timeSlot->isWeekend()){
                $timeSlot->addWeek()->startOfWeek()->setTime(9, 0);
            }
        }
    }

    private function addAvailableAppointmentsToArray($d, $datetime, $index, $bookedDocsIds, $readableDateTime, $time, $day){
        if(!in_array($d->id, $bookedDocsIds)){
            $drDetails['dr_name']  = 'Dr ' . $d->surname;
            $drDetails['dr_id']    = $d->id;
            $drDetails['datetime'] = $datetime;
            $drDetails['link_id']  = $index . $d->id;
            $drDetails['display_app_time'] = $readableDateTime;

            $this->appointments[$time][$day]['available'][] = $drDetails;
            $this->appointments[$time][$day]['datetime']    = $datetime;
        }else{
            $this->appointments[$time][$day]['booked']   = true;
            $this->appointments[$time][$day]['datetime'] = $datetime;
        }
    }
}
