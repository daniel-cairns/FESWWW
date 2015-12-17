<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Subbrand;
use App\Package;
use App\Image;
use App\Slider;
use Validator;

class SubbrandController extends Controller
{
   
    public function index($slug)
    {

        $theslug = str_slug($slug);

        if ($theslug !== $slug) {
            return redirect('subbrand/' . $theslug);
        }
        
        try {
            $subbrand = Subbrand::where('slug', $theslug)->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
            return view('errors.error');
        }    
        // dd($subbrand->images, $subbrand->sliders);
        
        return view('subbrand.index', compact('subbrand'));
    }
   
    public function updateSlider(Request $request)
    {
        // Get the images array
        $images = $request->image;
        $slug   = $request->subbrandSlug;
        
        try {
            $subbrand = Subbrand::findOrFail($request->subbrandId);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
            return view('errors.adminError');
        }  
                
        // Check to see if the array is empty
        if( $images != [])
        {
            foreach( $images as $image) {
                try {
                    $image = Image::findOrFail($image); 
                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
                    return view('errors.adminError');
                }  
                $subbrand->sliders()->save($image);
            }
            return back()->with('message', 'Update Successful');
        }else{
            return back()->with('error', 'Error with Update');
        }    
    }

    
    public function removeSlider(Request $request)
    {
        // Get the sliders array
        $sliders = $request->slider;
        $slug   = $request->subbrandSlug;
        
        try {
            $subbrand = Subbrand::findOrFail($request->subbrandId)->id;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
            return view('errors.adminError');
        }  
                
        // Check to see if the array is empty
        if( $sliders != [])
        {
            foreach( $sliders as $slider) {
                Slider::where('image_id', $slider)
                        ->where('subbrand_id', $subbrand)
                        ->delete();
            }
            return back()->with('message', 'Update Successful');
        }else{
            return back()->with('error', 'Error with Update');
        }    
    }

    public function updateCaption(Request $request)
    {
        // Validate the request
        $validate = Validator::make($request->all(),[
            'caption'      => 'required' 
        ]);

        try {
            $subbrand = Subbrand::findOrFail($request->subbrandId);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
            return view('errors.adminError');
        }  

        $caption    = $request->caption;
        $slug       = $request->subbrandSlug;

        if( $validate->fails()){
            return redirect('subbrand/'.$slug)
                    ->withErrors($validate, 'updateCaption')
                    ->withInput();
        }

        $subbrand->caption = $caption;
        $subbrand->save();
        return redirect('subbrand/'.$slug);
    }

    public function updateDescription(Request $request)
    {
        // Validate the request
        $validate = Validator::make($request->all(),[
            'description'      => 'required' 
        ]);

        try {
            $subbrand = Subbrand::findOrFail($request->subbrandId);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
            return view('errors.adminError');
        }  

        $description    = $request->description;
        $slug       = $request->subbrandSlug;

        if( $validate->fails()){
            return redirect('subbrand/'.$slug)
                    ->withErrors($validate, 'updateDescription')
                    ->withInput();
        }

        $subbrand->description = $description;
        $subbrand->save();
        return redirect('subbrand/'.$slug);
    }

    public function show($subbrand, $package)
    {
        //

        try {
            $subbrand = Subbrand::where('slug', $subbrand)->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
            return view('errors.error');
        }

        try {
            $package = Package::where('slug', $package)->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
            return view('errors.error');
        }    
        
        $images = $subbrand->images;
        $imagecount = count($images);

        if( $imagecount > 1 )
        {
            $image = $images->random(1);
        }else{
            $image = $images;
        }

        return view('packages.package', compact('subbrand', 'package', 'image'));
    }
    
}
