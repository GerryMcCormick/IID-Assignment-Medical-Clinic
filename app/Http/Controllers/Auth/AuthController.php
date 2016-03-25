<?php

namespace App\Http\Controllers\Auth;

use App\Address;
use App\Patient;
use App\User;
use DateTime;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['phone'] = str_replace(' ', '', $data['phone']);
        $data['dob']   = strtotime($data['dob']);

        if($data['dr_id'] == 0)
            $data['dr_id'] = null;

        return Validator::make($data, [
            // user
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'email'      => 'required|email|max:255|unique:users',
            'password'   => 'required|confirmed|min:6',

            // patient
            'title'       => 'required|max:15',
            'phone'       => 'required', // validate for numbers only on form input
            'dob'         => 'required', // date validated, range set on datepicker
            'dr_id'       => 'required',

            // address
            'add_line_1'  => 'required',
            'town'        => 'required|min:2',
            'postcode'    => 'required|min:4',

        ]);
        
//        return Validator::make($data, [
//            'name' => 'required|max:255',
//            'email' => 'required|email|max:255|unique:users',
//            'password' => 'required|min:6|confirmed',
//        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $dob = new DateTime($data['dob']);

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'password'   => bcrypt($data['password']),
            'gender'     => $data['gender'][0],
        ]);

        $address = Address::create([
            'add_line_1'  => $data['add_line_1'],
            'add_line_2'  => $data['add_line_2'],
            'town'        => $data['town'],
            'postcode'    => $data['postcode'],
        ]);

        $patient = Patient::create([
            'title'       => $data['title'],
            'user_id'     => $user->id,
            'address_id'  => $address->id,
            'doctor_id'   => $data['dr_id'],
            'phone'       => $data['phone'],
            'dob'         => $dob,
            'reminder_id' => $data['reminder_id'][0],
        ]);

        $user->makePatient();

        return $user;
        
//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => bcrypt($data['password']),
//        ]);
    }
}
