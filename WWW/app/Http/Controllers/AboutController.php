<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\About;
use App\Image;


class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = About::first();
        $image = Image::all();
        
        
        $imagecount = count($image);

        if( $imagecount > 6 )
        {
            $images = $image->random(6);
        }else{
            $images = $image;
        } 
        
        return view('about.index', compact('about', 'images'));
    }

}
