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
use Carbon\Carbon;
use Validator;
use App\Image;

class PackagesController extends Controller
{
    
    public function index()
    {
      $subbrands = Subbrand::with('packages')->get();

      return view('packages.index', compact('subbrands'));
    }

    public function order($subbrand, $package)
    {
        
      try {
        $subbrand   = Subbrand::where('slug', $subbrand)->firstOrFail();
      } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
        return view('errors.adminError');
      }

      try {
        $package    = Package::where('slug', $package)->firstOrFail();
      } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
        return view('errors.adminError');
      }      
          
      return view('packages.order', compact('subbrand', 'package'));
    }

    public function confirm(Request $request)
    {
      //validate
      $validate = Validator::make($request->all(),[
            'firstName'     => 'required|min:3|max:20',
            'lastName'      => 'required|min:3|max:20',
            'email'         => 'required|email|min:5|max:255',
            'date'          => 'required',
            'subbrand'      => 'required|exists:subbrands,id',
            'package'       => 'required|exists:packages,id',
            'location'      => 'max:50'
        ]);
      
      if( $validate->fails()){
          // dd($validate);
          return back()
                  ->withErrors($validate, 'confirm')
                  ->with('error', 'error')
                  ->withInput();
      }
      // Get the information from the form
      $order = [
          'firstName'   => $request->firstName,
          'lastName'    => $request->lastName,
          'email'       => $request->email,
          'organisation'=> $request->organisation,
          'comment'     => $request->comment,
          'date'        => $request->date,
          'subbrand'    => $request->subbrand,
          'package'     => $request->package,
          'location'    => $request->location,
          'sendAddress' => $request->sendAddress,
      ];

      try {
        $subbrand   = Subbrand::where('id', $order['subbrand'])->firstOrFail();
      } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
        return view('errors.adminError');
      }

      try {
        $package    = Package::where('id', $order['package'])->firstOrFail();
      } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
        return view('errors.adminError');
      }      

      return view('packages.confirm', compact('order', 'subbrand', 'package'));
    }

    public function sendConfirm(Request $request)
    {
      //validate
      $validate = Validator::make($request->all(),[
            'firstName'     => 'required|min:3|max:20',
            'lastName'      => 'required|min:3|max:20',
            'email'         => 'required|email|min:5|max:255',
            'date'          => 'required',
            'subbrand'      => 'required|exists:subbrands,id',
            'package'       => 'required|exists:packages,id',
            'location'      => 'max:50'
        ]);

      if( $validate->fails()){
          return back()
                  ->withErrors($validate, 'sendConfirm')
                  ->withInput();
      }

      try {
        $subbrand   = Subbrand::where('id', $request->subbrand)->firstOrFail();
      } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
        return view('errors.adminError');
      }

      try {
        $package    = Package::where('id', $request->package)->firstOrFail();
      } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
        return view('errors.adminError');
      }

      $password   = uniqid();
      $passCrypt  = bcrypt($password);

      $date = $request->date;
      $dbDate = Carbon::parse($date);

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
          'location'    => $request->location,
          'address'     => $request->sendAddress,
      ];

      $user = User::create([
            'name'      => $data['firstName'].$data['lastName'],
            'email'     => $data['email'],
            'password'  => $passCrypt
      ]);

      Mail::send('emails.booking', $data, function ($message) use ($data) {
        $message->from('info@faredgestudios.co.nz', 'FES');
        $message->subject('package booking');

        $message->to($data['email']);
        // $message->attach($data['logo'], ['as' => 'logo', 'mime' => 'image/png']);
      });

      Mail::send('emails.newBooking', $data, function ($message) use ($data) {
        $message->from('info@faredgestudios.co.nz', 'FES');
        $message->subject('package booking');

        $message->to('info@faredgestudios.co.nz');
        // $message->attach($data['logo'], ['as' => 'logo', 'mime' => 'image/png']);
      });

      BoughtPackage::create([
          'user_id'       => $user->id,
          'package_id'    => $package->id,
          'booking_date'  => $dbDate,
          'location'      => $data['location'],
      ]);

      Auth::login($user);
      
      return redirect('/account');
    }

    public function userConfirm(Request $request)
    { 
      
      try {
        $subbrand = Subbrand::where('id', $request->subbrand)->firstOrFail();
      } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
        return view('errors.adminError');
      }

      try {
        $package = Package::where('id', $request->package)->firstOrFail();
      } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
        return view('errors.adminError');
      }
      
      $date = $request->date;
      $dbDate = Carbon::parse($date);
      
      $data = [
          'username'    => Auth::user()->name,
          'email'       => Auth::user()->email,
          'organisation'=> $request->organisation,
          'comments'    => $request->comment,
          'date'        => $date,
          'subbrand'    => $subbrand->name,
          'package'     => $package->name,
          'location'    => $request->location,
          'address'     => $request->sendAddress,
      ];
      // dd($data['location']);
      Mail::send('emails.userBooking', $data, function ($message) use ($data) {
        $message->from('info@faredgestudios.co.nz', 'FES');
        $message->subject('package booking');

        $message->to($data['email']);
        // $message->attach($data['logo'], ['as' => 'logo', 'mime' => 'image/png']);
      });

      Mail::send('emails.userNewBooking', $data, function ($message) use ($data) {
        $message->from('info@faredgestudios.co.nz', 'FES');
        $message->subject('package booking');

        $message->to('info@faredgestudios.co.nz');
        // $message->attach($data['logo'], ['as' => 'logo', 'mime' => 'image/png']);
      });

      $newpackage = BoughtPackage::create([
          'user_id'       => Auth::user()->id,
          'package_id'    => $package->id,
          'booking_date'  => $dbDate,
          'location'      => $data['location'],
      ]);
      
      return redirect('/account')->with( 'message', 'Booking submitted!');
    }

    public function cancelPackage(Request $request)
    {
      $user       = Auth::user()->id;
      $package    = $request->package_id;
      
      BoughtPackage::where('user_id', $user)
                      ->where('id', $package)
                      ->delete();
      
      return back()->with('message', 'Booking canceled!');
    }

    public function uploadPackage(Request $request)
    {
        // Validate the request
        $validate = Validator::make($request->all(),[
            'userId'    => 'required|exists:users,id',
            'myFile'    => 'required|array',
            // 'packageId' => 'required|exists:bought_packages,id',
        ]);

        if( $validate->fails()){
            return back()
                    ->withErrors($validate, 'uploadPackage')
                    ->withInput();
        }
     
        $myFile = $request->myFile;
        
        // Check if some photo's have been subitted in the form
        if( $myFile != [] )
        {
          
          foreach ($myFile as $file) 
          {
            $image = new Image();

            // Generate a new file name
            $fileName = uniqid().'.'.$file->getClientOriginalExtension();

            // Use intervention Image to resize the image
            \Image::make($file)->save( 'img/users/'.$fileName);

            $image->name = $fileName;
            $image->description = $request->userId;
            $image->save();
          }
        }
        
        return back()->with('message', 'Upload Successful');
    }
}

