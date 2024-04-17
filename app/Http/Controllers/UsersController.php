<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function signup(Request $request) {
        $request->validate([
            'name'                  => 'required|min:4,max:20|unique:users',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required',
            'password_confirmation' => 'required|same:password',
        ]);
        
        $defaultImage = public_path('storage/profile_images/default.png');

        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'profile_image' => $defaultImage,
        ]);

        return redirect('/login');
    }

    public function login(Request $request) {
        $request->validate([
            'name'     => 'required',
            'password' => 'required',
        ]);
        $name     = $request->name;
        $password = $request->password;
        
        $bdUser   = User::where('name', $name)->first();

        if($bdUser && Hash::check($password, $bdUser->password)) {

            $credentials = $request->only('name', 'password');

            if(auth()->attempt($credentials)) {
                return redirect('/main');
            }

        } else {
            return back()->withErrors([
                'error'=> 'Credenciales incorrectas',
            ]);
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/main');
    }
}
