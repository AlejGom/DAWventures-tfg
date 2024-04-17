<?php

namespace App\Http\Controllers;

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
        return view('upload');
    }
    public function showProfile() {
        return view('profile');
    }


}
