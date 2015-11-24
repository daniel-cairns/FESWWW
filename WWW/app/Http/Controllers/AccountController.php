<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Package;
use App\Product;
use App\BoughtPackage;
use App\User;
use Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $id )
    {
      $user     = User::where('id', $id)->first();             
      
      $packages = BoughtPackage::where('user_id', $id)->get();
      // dd($user);
      // foreach ($packages as $package ) {
      //   dd($package->package_id);
      // }
      
      
      return view('account.index', compact('user', 'packages'));
    }
    
}
