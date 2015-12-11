<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Subbrand;
use App\Package;

class SiteMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subbrands  = Subbrand::all();
        $packages   = Package::all();

        return view('sitemap.index', compact('subbrands', 'packages'));
    }
}
    