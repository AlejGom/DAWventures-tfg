<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;
use App\Models\Country;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class ExperiencesController extends Controller
{
    // Function to upload an experience
    public function upload(Request $request) {
        $request->validate([
            'title'       => 'required',
            'description' => 'required|max:2000',
            'country'     => 'required',
            'images.*'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images'      => 'max:4',
        ]);
    
        if ($request->hasFile('images') && count($request->file('images')) > 4) {
            return redirect()->back()->withErrors(['images' => 'The maximum number of images is 4.'])->withInput();
        }
        
        $country = Country::find($request->country);
    
        $experience = Experience::create([
            'title'       => $request->title, 
            'description' => $request->description,
            'country'     => $country->name,
            'user_id'     => Auth::user()->id
        ]);
    
        if ($request->hasFile('images')) {
            /* $request->validate([
                'images.*'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]); */
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

    // Function to delete an experience
    public function deleteExperience($id) {
        $experience = Experience::find($id);

        if ($experience->user_id == Auth::user()->id) {
            $experience->delete();
        }

        return redirect('/profile');
    }
    
    // Function to update an experience
// Function to update an experience
public function update(Request $request, $id) {
    $request->validate([
        'title'       => 'required',
        'description' => 'required|max:2000',
        'country'     => 'required',
        'images.*'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'images'      => 'max:4',
    ]);

    $country = Country::find($request->country);
    $experience = Experience::find($id);

    // Eliminar las imágenes anteriores
    $experience->images()->delete();

    // Actualizar los datos de la experiencia
    $experience->update([
        'title'       => $request->title,
        'description' => $request->description,
        'country'     => $country->name,
    ]);

    // Subir las nuevas imágenes
    if ($request->hasFile('images')) {
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

    return redirect('/profile')->with('success', 'Experiencia actualizada correctamente.');
}

    
    // Function to create a commentary on an experience
    public function comment(Request $request) {
        $request->validate([
            'comment' => 'required|max:255',
        ]);

        $user = Auth::user();
        $experience = Experience::find($request->experience_id);

        $comment = Comment::create([
            'experience_id' => $experience->id,
            'user_id'       => $user->id,
            'comment'       => $request->comment
        ]);

        return redirect('/experience/' . $experience->id);
    }

    // Function to delete a commentary on an experience
    public function deleteComment($id) {
        $comment = Comment::find($id);

        if ($comment->user_id == Auth::user()->id) {
            $comment->delete();
        }

        return redirect('/experience/' . $comment->experience_id);
    }
}
