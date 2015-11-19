<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Package;
use App\Subbrand;
use Mail;


class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
      $subbrands = Subbrand::with('packages')->get();
      return view('packages.index', compact('subbrands'));
    }

    public function order($subbrand, $package)
    {
        
      $subbrand   = Subbrand::where('slug', $subbrand)->first();
      $package    = Package::where('slug', $package)->first();
      
      return view('packages.order', compact('subbrand', 'package'));
    }

    public function confirm(Request $request)
    {
      //validate

      // Get the information from the form
      $order = [
          'firstName'   => $request->firstName,
          'lastName'    => $request->lastName,
          'email'       => $request->email,
          'organisation'=> $request->organisation,
          'comments'    => $request->comments,
          'date'        => $request->date,
          'subbrand'    => $request->subbrand,
          'package'     => $request->package
      ];

      $subbrand   = Subbrand::where('id', $order['subbrand'])->first();
      $package    = Package::where('id', $order['package'])->first();

      return view('packages.confirm', compact('order', 'subbrand', 'package'));
    }

    public function sendConfirm(Request $request)
    {
      $subbrand   = Subbrand::where('id', $request->subbrand)->first();
      $package    = Package::where('id', $request->package)->first();
      
      $data = [
          'firstName'   => $request->firstName,
          'lastName'    => $request->lastName,
          'email'       => $request->email,
          'organisation'=> $request->organisation,
          'comments'    => $request->comments,
          'date'        => $request->date,
          'subbrand'    => $subbrand->name,
          'package'     => $package->name
      ];
      
      Mail::send('emails.booking', $data, function ($message) {
        $message->from('admin@FES.com', 'FES');

        $message->to('danielcairns30@gmail.com');
        $message->attach('/img/logo/logo.png');
      }); 
      

      return 'cheers';
    }
}
