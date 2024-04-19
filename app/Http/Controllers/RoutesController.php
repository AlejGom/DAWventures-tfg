<?php

namespace App\Http\Controllers;
use App\Models\Country;
use App\Models\Experience;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ExperiencesController;

class RoutesController extends Controller
{
    public function showMainForm() {
        $experiences = $this->loadExperiences(1);

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
        $experiences = $this->loadExperiences(2);
        /* dd($experiences); */
        return view('profile', [
            'experiences' => $experiences
        ]);
    }

    public function loadExperiences($number) {
        if ($number == 1) {
            $experiences = Experience::orderBy('created_at', 'desc')->get();
        }
        if ($number == 2) {
            $experiences = Experience::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        }

        return $experiences;
    }

}
