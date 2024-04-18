<?php

namespace App\Http\Controllers;
use App\Models\Country;
use App\Models\Experience;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ExperiencesController;

class RoutesController extends Controller
{
    public function showMainForm() {
        $experiences = Experience::all();

        



        return view('main', [
            'experiences' => $experiences
        ]);
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
