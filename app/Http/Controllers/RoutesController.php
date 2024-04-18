<?php

namespace App\Http\Controllers;
use App\Models\Country;
use Illuminate\Http\Request;

class RoutesController extends Controller
{
    public function showMainForm() {
        return view('main');
    }
    public function showLoginForm() {
        return view('login');
    }
    public function showSignupForm() {
        return view('signup');
    }
    public function showUploadForm() {
        $countries = Country::all();
        return view('upload', [
            'countries' => $countries
        ]);
    }
    public function showProfile() {
        return view('profile');
    }


}
