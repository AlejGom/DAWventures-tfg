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
            'images.*'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images'       => 'max:4',
        ]);
    
        $country = Country::find($request->country);
    
        $experience = Experience::create([
            'title'       => $request->title, 
            'description' => $request->description,
            'country'     => $country->name,
            'user_id'     => Auth::user()->id
        ]);
    
        if ($request->hasFile('images')) {
            $request->validate([
                'images.*'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
    
            $images = $request->file('images');
    
            foreach ($images as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/experience_images', $imageName);
                
                $experience->images()->create([
                    'experience_id' => $experience->id,
                    'user_id'       => Auth::user()->id,
                    'name'          => $imageName,
                    'route'         => '../../storage/app/public/experience_images/' . $imageName,
                ]);
            }
        }
    
        return redirect('/main');
    }

    public function deleteExperience($id) {
        $experience = Experience::find($id);

        if ($experience->user_id == Auth::user()->id) {
            $experience->delete();
        }

        return redirect('/profile');
    }
    
    public function update(Request $request, $id) {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'country'     => 'required',
        ]);

        $country = Country::find($request->country);
        $experience = Experience::find($id);

        if ($experience->user_id == Auth::user()->id) {
            $experience->update([
                'title'       => $request->title, 
                'description' => $request->description,
                'country'     => $country->name,
            ]);
        }

        return redirect('/profile');
    }
    
    
}
