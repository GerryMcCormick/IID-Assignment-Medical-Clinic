<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Doctor;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class PageController extends Controller
{
    public function home(){
        $page = 'Home';
        $user = Auth::user();

        if($user){
            return view('page.home', compact('user', 'page'));
        }else{
            return redirect('auth/login');
        }
    }

    // method called after booking an appointment
    public function homeAfterBooking(){
        $page = 'Home';
        $user = Auth::user();

        if($user){
            Flash::success('Your appointment has been booked ' . $user->first_name);
            return redirect('/')->with(compact('user', 'page'));

        }else{
            return redirect('auth/login');
        }
    }

    public function logout(){
        Flash::success("You have sucessfully logged out " . Auth::user()->first_name);
        Auth::logout();
        return redirect('auth/login');
    }

    public function appointments(){
        $page = 'Appointments';
        return view('page.appointments', compact('page'));
    }

    public function about(){
        $page    = 'About';
        $doctors = Doctor::all();

        return view('page.about', compact('page', 'doctors'));
    }

    public function contact(){
        $page    = 'Contact Us';
        return view('page.contact', compact('page'));
    }
}
