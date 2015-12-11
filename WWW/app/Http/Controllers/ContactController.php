<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Validator;

class ContactController extends Controller
{
    
    public function index()
    {
        return view('contact.index');
    }

    public function contact(Request $request)
    {
    	
    	$validate = Validator::make($request->all(),[
            'firstname' => 'required|min:3|max:25',
            'lastname' 	=> 'required|min:3|max:25',
            'email'		=> 'required|email|min:6|max:255',
            'phone'		=> 'required|min:6|max:30',
            'comment'	=> 'required|min:3|max:500',
        ]);

        if( $validate->fails()){
            return back()
                    ->withErrors($validate, 'contact')
                    ->withInput();
        }

        $data = [
        	'firstname' => $request->firstname,
            'lastname' 	=> $request->lastname,
            'email'		=> $request->email,
            'phone'		=> $request->phone,
            'comment'	=> $request->comments
        ];

        Mail::send('emails.contact', $data, function ($message) use ($data) {
	        $message->from($data['email'], 'Client');
	        $message->subject('FES Contact Form');

	        $message->to('info@faredgestudios.co.nz');
        });

        return view('contact.confirm', compact('data'));
    }
}
