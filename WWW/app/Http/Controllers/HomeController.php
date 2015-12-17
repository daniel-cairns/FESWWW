<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Subbrand;
use App\SubbrandImages;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the subbrands from the database
        $subbrands = Subbrand::all();

        // Send the subbbrands to the home page HTML 
        return view('home', compact('subbrands'));
    }

    
    public function update(Request $request)
    {
        // Validate the update form
        $this->validate($request,[
            'landing_description' => 'required|min:5|max:200',
            'photo' => 'image'
        ]);

        // Find the requested subbrand in the database
        try {
           $subbrand = Subbrand::where('name', $request->subbrandName)->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
            return view('errors.adminError');
        }  

        $subbrand->subbrandImages;

        // Check if a photo has been subitted in the form
        if($request->hasFile('photo'))
        {
            // Generate a new file name
            $fileName = uniqid().'.'.$request->file('photo')->getClientOriginalExtension();

            // Use intervention Image to resize the image
            \Image::make($request->file('photo') )
                                // ->resize( 273,668,function($constraint){$constraint->aspectRatio();})
                                ->fit( 273, 668)
                                ->save( 'img/landing/'.$fileName);

            // Delete the old image
            \File::Delete('img/landing/'.$subbrand->photo);

            $subbrand->photo = $fileName;
        }

        $subbrand->landing_description = $request->landing_description;

        $subbrand->save();

        return redirect('/home');
       
    }
    
}
