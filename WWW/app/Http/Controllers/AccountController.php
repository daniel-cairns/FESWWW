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
    public function index( $slug )
    {
      $user = User::where('name', $slug)->first();

      return view('account.index', compact('user'));
    }
    
}
