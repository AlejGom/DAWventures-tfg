<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;

class ExperiencesController extends Controller
{
    public function upload(Request $request) {

        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'country'     => 'required', 
        ]);

        $country = Country::find($request->country);

        /* dd($request->title, $request->description, $country->name, Auth::user()->id); */
        Experience::create([
            'title'       => $request->title, 
            'description' => $request->description,
            'country'     => $country->name,
            'user_id'     => Auth::user()->id
        ]);

        return redirect('/main');

    }
}
