<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Package;
use App\Product;
use App\BoughtPackage;
use App\Image;
use App\User;
use Auth;
use Validator;


class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
      // If the user is an admin, redirect them to the appropriate route
      if( Auth::user()->privilege == 'admin' ) {
        return redirect('/admin');
      }

      $user     = User::where('name', Auth::user()->name)->first();
      $images   = Image::where('description', $user->id)->get();

      return view('account.index', compact('user', 'images'));
    }

    public function resetPassword(Request $request) {
       
      $validator = \Validator::make($request->all(), [
          'current_password'=>'required',
          'new_password'=>'required|min:8|confirmed',
          'new_password_confirmation'=>'required|min:8'
      ]);

      // Make sure the current password is the same as what is in the database
      $validator->after(

          function($validator) use($request){
             
              if( !Auth::attempt([ 'email'=>Auth::user()->email, 'password'=>$request->current_password ]) ) {
                $validator->errors()->add('current_password', 'Incorrect password');
              }
          }
      );
      
      // If the validation failed
      if( $validator->fails())
      {
        return back()
                ->withErrors($validator, 'resetPassword')
                ->with('error', 'Could not reset pasword!')
                ->withInput();
      }
      // Change the users password
      
      
      try {
          $user = User::find( Auth::user()->id );
      } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
          return view('errors.error');
      }  

      $user->password = bcrypt($request->password);
      $user->save();
    
      // Prepare a flash message
      return redirect('/account')->with('message', 'Success, Password Changed!');
    }

    public function resetEmail(Request $request)
    {
      $validator = Validator::make($request->all(), 
        [
          'password'            => 'required',
          'email'               => 'required|email|max:255|unique|confirmed',
          'email_confirmation'  => 'required|email|max:255',
        ]
      );

      $validator->after(

          function($validator) use($request){
             
              if( !Auth::attempt([ 'email'=>Auth::user()->email, 'password'=>$request->password ]) ) {
                $validator->errors()->add('password', 'Incorrect password');
              }
          }
      );

      // If the validation failed
      if( $validator->fails())
      {
        return back()
                ->withErrors($validator, 'resetEmail')
                ->with('error', 'Couldn\'t change your email')
                ->withInput();
      }

      // Change the users password
      try {
          $user = User::find( Auth::user()->id );
      } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
          return view('errors.error');
      }  

      $user->email = $request->email;
      $user->save();

      return redirect('/account')->with('message', 'Success, Email Changed!');

    }

    public function resetUsername(Request $request)
    {
      
      $validator = Validator::make($request->all(), 
        [
          'password'      => 'required',
          'new_username'  => 'required|max:255|unique:users,name',
        ]
      );
      
      $validator->after(

        function($validator) use($request){
            
          if( !Auth::attempt([ 'email'=>Auth::user()->email, 'password'=>$request->password ]) ) {
            $validator->errors()->add('password', 'Incorrect password');
          }
        }
      );

       // If the validation failed
      if( $validator->fails())
      {
        // return'test';
        return back()
                ->withErrors($validator, 'resetUsername')
                ->with('error', 'Could not update username!')
                ->withInput();
      }

      // Change the username
      try {
          $user = User::find( Auth::user()->id );
      } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {    
          return view('errors.error');
      }  
      
      $user->name = $request->new_username;
      $user->save();

      return redirect('/account')->with('message', 'Success, Username Changed!');
    }
}
