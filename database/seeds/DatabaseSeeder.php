<?php

use App\Patient;
use App\Role;
use App\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

const NO_OF_PATIENTS_ADDRESSES_USERS = 500;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(DoctorTableSeeder::class);
//        $this->call(AddressTableSeeder::class);
//
//        // create patients - user is base model - users and addresses are created first
//        $this->call(UserTableSeeder::class);
//        $this->call(ReminderTableSeeder::class);
//        $this->call(AppointmentTableSeeder::class);

        Model::reguard();
    }
}

class DoctorTableSeeder extends Seeder {
    public function run(){

        DB::table('doctors')->truncate();

        \App\Doctor::create([
            'title'           => 'Dr',
            'forename'        => 'Brian',
            'surname'         => 'Brown',
            'qualifications'  => "PhD in Medicine from Queens University",
            'about'           => 'Dr Brown has worked at Ballydale Medical Clinic since March 2000.
                                  One of three children, James was influenced 
                                    early on to pursue a career in medicine. His father was the local surgeon and 
                                    apothecary, and James\' early education included Latin, Greek, natural philosophy and
                                     shorthand—all subjects considered essential to a doctor\'s basic training.',
            'image'           => 'Dr_Brown.JPG',
        ]);

        \App\Doctor::create([
            'title'           => 'Dr',
            'forename'        => 'Sarah',
            'surname'         => 'Cox',
            'qualifications'  => 'PhD in Medicine from Cambridge University',
            'about'           => 'Dr Cox has worked at Ballydale Medical Clinic since March 2003.
                                    Her father, a former Merchant Marine and an occasional newspaper columnist, taught 
                                    Bath about the wonders of travel and the value of exploring new cultures. Her mother
                                     piqued the young girl\'s interest in science by buying her a chemistry set.',
            'image'           => 'Dr_cox.JPG',
        ]);

        \App\Doctor::create([
            'title'           => 'Dr',
            'forename'        => 'Stephen',
            'surname'         => 'Gill',
            'qualifications'  => 'PhD in Medicine from Harvard University',
            'about'           => 'Dr Gill has worked at Ballydale Medical Clinic since March 1998\n
                                  After earning his degree in 1990, Omalu interned at Jos University Hospital, 
                                  before being accepted to a visiting scholar program at the University of Washington in
                                   1994. He then served his residency at Harlem Hospital Center, where he developed his 
                                   interest in pathology.',
            'image'           => 'dr_gill.jpeg',
        ]);

        \App\Doctor::create([
            'title'           => 'Dr',
            'forename'        => 'Colin',
            'surname'         => 'Shaw',
            'qualifications'  => 'PhD in Medicine from Ulster University',
            'about'           => 'Dr Shaw has worked at Ballydale Medical Clinic since March 2000.
                                  Halfway through his freshman year, however, he became bored with his studies and began
                                   focusing on botany and biology. By midyear, he had set his sights on medical school, 
                                   often taking 20 credit hours in a semester in order to meet the 90-hour medical 
                                   school requirement.',
            'image'           => 'Dr_shaw.jpg',
        ]);

        \App\Doctor::create([
            'title'           => 'Dr',
            'forename'        => 'Dan',
            'surname'         => 'Smith',
            'qualifications'  => 'PhD in Medicine from Galway University',
            'about'           => 'Dr Smith has worked at Ballydale Medical Clinic since March 1996.
                                  After he graduated in 1957, the couple moved to Durham, North Carolina, where Ron 
                                  attended the Duke University School of Medicine. Finishing his degree in 1961, he and 
                                  his young family then moved to Detroit, Michigan. There Paul did his internship and 
                                  residency at Henry Ford Hospital. Serving his country, he was as a doctor in the 
                                  United States Air Force from 1963 to 1965 and then with the United States Air National
                                   Guard from 1965 to 1968.',
            'image'           => 'dr_smith.jpg',
        ]);
    }
}

class ReminderTableSeeder extends Seeder {
    public function run(){

        DB::table('reminders')->truncate();

        \App\Reminder::create([
            'desc' => 'email'
        ]);
        \App\Reminder::create([
            'desc' => 'SMS'
        ]);
        \App\Reminder::create([
            'desc' => 'none'
        ]);
    }
}

class AddressTableSeeder extends Seeder {
    public function run(){

        DB::table('addresses')->truncate();

        factory(App\Address::class, NO_OF_PATIENTS_ADDRESSES_USERS/2)->create(); // 1 address for every 2 patients
    }
}

class UserTableSeeder extends Seeder {

    public function run(){

        $faker = Factory::create();

        DB::table('roles')->truncate();
        DB::table('role_user')->truncate();
        DB::table('users')->truncate();
        DB::table('patients')->truncate();

        $roles = ['admin', 'patient'];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }

        // create admin/staff users
        $adminUser = User::create([
            'email' => 'gerry@ballydale.com',
            'password' => Hash::make('ballydale'),
            'first_name' => 'Gerry',
            'last_name' => 'McCormick',
            'gender' => 'Male',
        ]);
        $adminUser->makeAdmin();

        $adminUser = User::create([
            'email' => 'amy@ballydale.com',
            'password' => Hash::make('ballydale'),
            'first_name' => 'Amy',
            'last_name' => 'Hoy',
            'gender' => 'Female',
        ]);
        $adminUser->makeAdmin();

        $adminUser = User::create([
            'email' => 'sandra@ballydale.com',
            'password' => Hash::make('ballydale'),
            'first_name' => 'Sandra',
            'last_name' => 'Simpson',
            'gender' => 'Female',
        ]);
        $adminUser->makeAdmin();

        $adminUser = User::create([
            'email' => 'may@ballydale.com',
            'password' => Hash::make('ballydale'),
            'first_name' => 'May',
            'last_name' => 'Hughes',
            'gender' => 'Female',
        ]);
        $adminUser->makeAdmin();

        $adminUser = User::create([
            'email' => 'bella@ballydale.com',
            'password' => Hash::make('ballydale'),
            'first_name' => 'Bella',
            'last_name' => 'Davis',
            'gender' => 'Female',
        ]);
        $adminUser->makeAdmin();

        // create users - user is base model for patients and must be created first

        // male users
        for($i=0; $i<NO_OF_PATIENTS_ADDRESSES_USERS/2; $i++){
            $user = User::create([
                'email' => $faker->unique()->email,
                'password' => Hash::make('ballydale'),
                'first_name' => $faker->firstNameMale,
                'last_name' => $faker->lastName,
                'gender' => 'Male',
            ]);

            if($user){
                $user->makePatient();

                Patient::create([
                    'title'      => $faker->titleMale,
                    'user_id'    => $user->id,
                    'address_id' => $i + 1,
                    'doctor_id'  => $faker->numberBetween($min = 1, $max = 5), // 5 doctors
                    'phone'      => $faker->phoneNumber,
                    'dob'        => $faker->dateTimeBetween($startDate = '-70 years', $endDate = 'now'),
                    'reminder_id' => $faker->numberBetween($min = 1, $max = 3),
                ]);
            }
        }

        // female users
        for($i=0; $i<NO_OF_PATIENTS_ADDRESSES_USERS/2; $i++){
            $user = User::create([
                'email' => $faker->unique()->email,
                'password' => Hash::make('ballydale'),
                'first_name' => $faker->firstNameFemale,
                'last_name' => $faker->lastName,
                'gender' => 'Female',
            ]);

            if($user){
                $user->makePatient();

                Patient::create([
                    'title'      => $faker->titleFemale,
                    'user_id'    => $user->id,
                    'address_id' => $i + 1,
                    'doctor_id'  => $faker->numberBetween($min = 1, $max = 5), // 5 doctors
                    'phone'      => $faker->phoneNumber,
                    'dob'        => $faker->dateTimeBetween($startDate = '-70 years', $endDate = 'now'),
                    'reminder_id' => $faker->numberBetween($min = 1, $max = 3),
                ]);
            }
        }
    }
}

class AppointmentTableSeeder extends Seeder{
    private $doctors;

    public function run(){
        $this->doctors = \App\Doctor::all();

        DB::table('appointments')->truncate();
        $noAppointments = $this->createAppointments();
        
        print $noAppointments . " Appointments created\n";
    }

    private function createAppointments(){
        // last bookable appointment is 2 weeks from $now at 17.30
        $lastBookable  = Carbon::now()->addWeeks(2)->setTime(17, 30);

        // if weekend (sat/sun) set to previous fri at 5.30
        if($lastBookable->isWeekend()){
            $lastBookable = $lastBookable->startOfWeek()->addDays(4)->setTime(17,30);
        }

        // set first timeslot of week to $mondayNineAM
        $timeSlot = Carbon::now()->startOfWeek()->addHours(9);

        $patient_id = 1;

        $bookedDocsIds = [ 1, 2, 3 ];
        
        while($timeSlot->lte($lastBookable)){
            $datetime = $timeSlot->format('Y-m-d H:i:s');
            $day      = $timeSlot->format('D');
            $time     = $timeSlot->format('H:i');

            $appointments[$time][$day] = [];

            if($timeSlot->gt(Carbon::now()) && ($time < '13:00' || $time > '13.45')){
                
                // check which docs have appointments booked for this timeslot
                foreach($this->doctors as $d){
                    if(!in_array($d->id, $bookedDocsIds)){
                        \App\Appointment::create([
                            'datetime'   => $datetime,
                            'doctor_id'  => $d->id,
                            'patient_id' => $patient_id,
                        ]);
                        $patient_id++;
                    }
                }

                // increment dr_ids
                // if reaches 5 (no of doctors), set back to 1
                $bookedDocsIds[0] = $bookedDocsIds[0] == 5 ? 1 : ++$bookedDocsIds[0];
                $bookedDocsIds[1] = $bookedDocsIds[1] == 5 ? 1 : ++$bookedDocsIds[1];
                $bookedDocsIds[2] = $bookedDocsIds[2] == 5 ? 1 : ++$bookedDocsIds[2];
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
        return $patient_id;
    }
}

