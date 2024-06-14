<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecoverMail;

class UsersController extends Controller
{
    // Function to signup
    public function signup(Request $request) {
        $request->validate([
            'name'                  => 'required|min:4,max:20|unique:users',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:4|max:20',
            'password_confirmation' => 'required|same:password',
        ]);
        
        $defaultImage = public_path('storage\images\default.png');
        

        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'profile_image' => $defaultImage,
        ]);

        $credentials = $request->only('name', 'password');

        if(auth()->attempt($credentials)) {
            return redirect('/main');
        }

        /* return redirect('/login'); */
    }

    // Function to login
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

    // Function to logout
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/main');
    }

    // Function to update user profile
    public function updateProfile(Request $request) {
        $user = User::find(Auth::user()->id);
    
        $rules = [
            'name'  => 'min:4|max:20|unique:users,name,'.$user->id,
            'email' => 'email|unique:users,email,'.$user->id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    
        if ($request->has('name') && $request->name !== $user->name) {
            $rules['name'] .= '|required';
        }
        if ($request->has('email') && $request->email !== $user->email) {
            $rules['email'] .= '|required';
        }
    
        $request->validate($rules);
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_images', 'public');
    
            $user->profile_image = '../storage/app/public/'.$imagePath;
        }
    
        if ($request->has('name') && $request->name !== $user->name) {
            $user->name = $request->name;
        }
        if ($request->has('email') && $request->email !== $user->email) {
            $user->email = $request->email;
        }
    
        $user->save();
    
        return redirect('/profile');
    }
    
    public function sendMail(Request $request)
    {

        $request->validate([
            'name' => 'required'
        ]);

        $subject = 'Recupera tu contraseña';
        $messageContent1 = 'Hola, ¿estás intentando recuperar tu contraseña?';
        $messageContent2 = 'Por favor, introduce el siguiente código en la página de recuperación.';
        $code            = random_int(100000, 999999);
        $messageContent3 = 'Gracias por usar nuestra aplicación';

        $userEmail = User::where('name', $request->name)->first();

        Mail::to($userEmail->email)->send(new RecoverMail($subject, $messageContent1, $messageContent2, $messageContent3, $code));

        return view ('introduceCode', [
            'code' => $code,
            'user' => $userEmail
        ]);
    }

    public function changePassword(Request $request) {

        $request->validate([
            'hiddenCode'            => 'required',
            'hiddenUser'          => 'required',
            'code'                  => 'required',
            'password'              => 'required|min:4|max:20',
            'password_confirmation' => 'required|same:password'
        ]);

        if ($request->hiddenCode == $request->code) {

            $user = User::find($request->hiddenUser);

            $user->password = Hash::make($request->password);

            $user->save();

            return redirect('/login');
        } else {
            return back()->withErrors([
                'codigoError' => 'Código incorrecto',
            ]);
        }
    }
    
    
}
