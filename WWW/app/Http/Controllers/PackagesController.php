<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Package;
use App\Subbrand;
use Mail;
use App\User;
use App\Message;
use App\BoughtPackage;
use Auth;


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
          'comment'     => $request->comment,
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
      
      $password   = uniqid();
      $passCrypt  = bcrypt($password);

      $data = [
          'firstName'   => $request->firstName,
          'lastName'    => $request->lastName,
          'email'       => $request->email,
          'organisation'=> $request->organisation,
          'comments'    => $request->comments,
          'date'        => $request->date,
          'subbrand'    => $subbrand->name,
          'package'     => $package->name,
          'password'    => $password,
      ];

      $user = User::create([
            'name'      => $data['firstName'].$data['lastName'],
            'email'     => $data['email'],
            'password'  => $passCrypt
      ]);

      if( !$data['comments'] == '')
      {
        Message::create([
            'message' => $data['comments'],
            'user_id' => $user->id,
            'status'  => 'unread'
        ]);
      }

      Mail::send('emails.booking', $data, function ($message) use ($data) {
        $message->from('admin@FES.com', 'FES');
        $message->subject('package booking');

        $message->to($data['email']);
        // $message->attach($data['logo'], ['as' => 'logo', 'mime' => 'image/png']);
      });

      Mail::send('emails.newBooking', $data, function ($message) use ($data) {
        $message->from('admin@FES.com', 'FES');
        $message->subject('package booking');

        $message->to('danzo169@gmail.com');
        // $message->attach($data['logo'], ['as' => 'logo', 'mime' => 'image/png']);
      });

      BoughtPackage::create([
          'user_id'     => $user->id,
          'package_id'  => $package->id,
          'booking_date' => $data['date']
      ]);

      Auth::login($user);
      return redirect('/account');
    }

    public function userConfirm(Request $request)
    { 
      $subbrand   = Subbrand::where('id', $request->subbrand)->first();
      $package    = Package::where('id', $request->package)->first();

      $data = [
          'username'    => Auth::user()->name,
          'email'       => Auth::user()->email,
          'organisation'=> $request->organisation,
          'comments'    => $request->comments,
          'date'        => $request->date,
          'subbrand'    => $subbrand->name,
          'package'     => $package->name,
      ];

      if( !$data['comments'] == '')
      {
        Message::create([
            'message' => $data['comments'],
            'user_id' => Auth::user()->id,
            'status'  => 'unread'
        ]);
      }

      Mail::send('emails.userBooking', $data, function ($message) use ($data) {
        $message->from('admin@FES.com', 'FES');
        $message->subject('package booking');

        $message->to($data['email']);
        // $message->attach($data['logo'], ['as' => 'logo', 'mime' => 'image/png']);
      });

      Mail::send('emails.userNewBooking', $data, function ($message) use ($data) {
        $message->from('admin@FES.com', 'FES');
        $message->subject('package booking');

        $message->to('danzo169@gmail.com');
        // $message->attach($data['logo'], ['as' => 'logo', 'mime' => 'image/png']);
      });


      BoughtPackage::create([
          'user_id'     => Auth::user()->id,
          'package_id'  => $package->id,
          'booking_date' => $data['date']
      ]);

      return redirect('/account');
    }
}
