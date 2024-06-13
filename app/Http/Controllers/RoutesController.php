<?php

namespace App\Http\Controllers;
use App\Models\Country;
use App\Models\Experience;
use Illuminate\Support\Facades\Auth;
use App\Models\ExperienceImage;
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
    public function showOtherUser($id) {
        $experience = Experience::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        $user       = User::find($id);

        return view('pageUser', [
            'experiences' => $experience,
            'user'        => $user
        ]);
    }
    public function showProfile() {
        if (Auth::user()->name == 'admin') {
            $experiences = $this->loadExperiences(1);
        } else {
            $experiences = $this->loadExperiences(2);
        }
        
        return view('profile', [
            'experiences' => $experiences
        ]);
    }

    public function loadExperiences($number) {
        // 1 = main and admin, 2 = profile
        if ($number == 1) {
            $experiences = Experience::orderBy('created_at', 'desc')->get();
        }
        if ($number == 2) {
            $experiences = Experience::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        }

        return $experiences;
    }

    public function showExperience($id) {

        $experience = Experience::find($id);
        $images     = ExperienceImage::where('experience_id', $experience->id)->get();

        return view('experiences', [
            'experience' => $experience,
            'images'     => $images,
        ]);
    }

    public function showEditForm($id) {
        /* dd(Auth::user()->name); */

        $experience = Experience::find($id);

        if ($experience->user_id != Auth::user()->id) {
            if (Auth::user()->name != 'admin') {
                return redirect()->back();
            }
        }

        $countries  = Country::all();
        $countryId  = Country::where('name', $experience->country)->first()->id;

        return view('edit', [
            'experience' => $experience,
            'countries'  => $countries,
            'countryId'  => $countryId,
        ]);
    }
}
