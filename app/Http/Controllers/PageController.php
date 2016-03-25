<?php

namespace App\Http\Controllers;

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
        Auth::logout();
        return redirect('/');
    }

    public function appointments(){
        $page = 'Appointments';
        return view('page.appointments', compact('page'));
    }
}
