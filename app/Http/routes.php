<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/',       'PageController@home'); // home
    Route::post('/',      'PageController@homeAfterBooking'); // home after booking appointment
    Route::get('logout',  'PageController@logout');

    Route::get('about',   'PageController@about');
    Route::get('contact', 'PageController@contact');

    //  APPOINTMENTS
    // some routes should only be accessible if logged in!
    Route::get('appointments', 'PageController@appointments'); // 2 buttons just, Available and pending/previous

    // browse appointments page
    Route::get('appointments/available_appointments/{week}/{doctor_id}', 'AppointmentController@availableAppointments'); 
    route::post('appointments/book_appointment',            'AppointmentController@bookAppointment');
    route::get('appointments/pending_previous',             'AppointmentController@pendingOrPreviousAppointments');
    route::post('appointments/cancel{appointment_id}',      'AppointmentController@cancel');
    
    // same as get for this route but with posted cancel param set to true
    route::post('appointments/pending_previous',            'AppointmentController@pendingOrPreviousAppointments');



// AUTHENTICATION
    Route::controllers([
        'auth'     => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
    ]);

// Password reset link request routes...
    Route::get('password/email',  'Auth\PasswordController@getEmail');
    Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset',        'Auth\PasswordController@postReset');

//Admin Dashboard
    Route::get('admin', 'Admin\AdminDashboardController@index');

//CMS ROUTES
    Route::resource('admin/doctor',      'Admin\AdminDoctorController');
    Route::resource('admin/patient',     'Admin\AdminPatientController');
    Route::resource('admin/appointment', 'Admin\AdminAppointmentController');
    Route::resource('admin/address',     'Admin\AdminAddressController');
    Route::resource('admin/reminder',    'Admin\AdminReminderController');

    
});
