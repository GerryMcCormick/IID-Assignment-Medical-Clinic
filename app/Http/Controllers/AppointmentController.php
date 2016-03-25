<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Doctor;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    private $doctors;
    private $now;
    private $mondayNineAM;
    private $wk3FriFiveThirty;
    private $mon;
    private $fri;
    private $appointments;

    public function __construct(){
        $this->doctors       = Doctor::all();
        $this->now           = Carbon::now();
        $this->mon           = Carbon::now()->startOfWeek()->format('l jS F Y');
        $this->fri           = Carbon::now()->startOfWeek()->addDays(4)->format('l jS F Y');

        $this->mondayNineAM     = Carbon::now()->startOfWeek()->addHours(9);
        $this->wk3FriFiveThirty = Carbon::now()->startOfWeek()->addDays(18)->setTime(17, 30);
    }

    // week 1, 2, or 3   mon - fri, dr id 0 = all doctors
    public function availableAppointments($week = 1, $dr_id = 0){
        $page          = 'Available Appointments';
        $doctors       = $this->doctors;

        //sets $this->appointments
        $this->getAppointments($dr_id); // first week (patients only allowed to book 2 weeks in advance)
        $appointments  = $this->appointments;
        //dd($appointments);
        $patient_id    = Auth::user()->id; // must be logged in before landing on this page
        $mon           = $this->mon;
        $fri           = $this->fri;

        // mon and fri dates for displaying appointments in this date range
        if($week == 2){
            $mon = Carbon::now()->startOfWeek()->addDays(7)->format('l jS F Y');
            $fri = Carbon::now()->startOfWeek()->addDays(11)->format('l jS F Y');
        }elseif($week == 3){
            $mon = Carbon::now()->startOfWeek()->addDays(14)->format('l jS F Y');;
            $fri = Carbon::now()->startOfWeek()->addDays(18)->format('l jS F Y');;
        }

        // pagination is done by mon - fri
        return view('page.availableAppointments', compact('page', 'doctors', 'appointments', 'patient_id', 'mon', 'fri', 'week', 'dr_id'));
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

    private function getAppointments($dr_id){
        // last bookable appointment is 2 weeks from $now at 17.30
        $lastBookable  = Carbon::now()->addWeeks(2)->setTime(17, 30);

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
