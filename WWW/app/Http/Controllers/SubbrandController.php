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

        $subbrand   = Subbrand::where('slug', $theslug)->first();
        
        return view('subbrand.index', compact('subbrand'));
    }

   
    public function updateSlider(Request $request)
    {
        // Get the images array
        $images = $request->image;
        $slug   = $request->subbrandSlug;
        
        $subbrand = Subbrand::findOrFail($request->subbrandId);
        
        // Check to see if the array is empty
        if( $images != [])
        {
            foreach( $images as $image) {
                $image = Image::findOrFail($image);                
                $subbrand->sliders()->save($image);
            }
            return redirect( 'subbrand/'.$slug);
        }else{
            return'error';
        }    
    }

    
    public function removeSlider(Request $request)
    {
        // Get the sliders array
        $sliders = $request->slider;
        $slug   = $request->subbrandSlug;
        
        $subbrand = Subbrand::findOrFail($request->subbrandId)->id;
        
        // Check to see if the array is empty
        if( $sliders != [])
        {
            foreach( $sliders as $slider) {
                Slider::where('image_id', $slider)
                        ->where('subbrand_id', $subbrand)
                        ->delete();
            }
            return redirect( 'subbrand/'.$slug);
        }else{
            return 'error';
        }    
    }

    public function updateCaption(Request $request)
    {
        // Validate the request
        $validate = Validator::make($request->all(),[
            'caption'      => 'required' 
        ]);

        $caption    = $request->caption;
        $subbrand   = Subbrand::findOrFail($request->subbrandId);
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

    public function show($subbrand, $package)
    {
        //
        $subbrand   = Subbrand::where('slug', $subbrand)->first();
        $package    = Package::where('slug', $package)->first();

        return view('packages.package', compact('subbrand', 'package'));
    }
}
