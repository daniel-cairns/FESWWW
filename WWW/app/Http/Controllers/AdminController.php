<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Image;
use App\Subbrand;
use App\Message;
use App\Package;
use App\Product;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $subbrands            = Subbrand::with('images','packages')->get();
      // $users                = User::with('messages');
      $products             = Product::all();
      $users                = User::all();
      $messages             = Message::all();
      
      return view('admin.index', compact('users', 'subbrands', 'messages', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeImage(Request $request)
    {
        // Check to see if it is the photo upload form
        // if($request->input('image', 'image') ){    
            // Validate the update form
            $this->validate($request,[
                'subbrand'      => 'required|exists:subbrands,id',
                'photo'         => 'required|image',
                'description'   => 'required|min:5|max:100',
            ]);

            $subbrand = Subbrand::findOrFail($request->subbrand);

            $image = new Image();

            // Check if a photo has been subitted in the form
            if($request->hasFile('photo'))
            {
                // Generate a new file name
                $fileName = uniqid().'.'.$request->file('photo')->getClientOriginalExtension();

                // Use intervention Image to resize the image
                \Image::make($request->file('photo') )
                                    ->save( 'img/original/'.$fileName);
                \Image::make($request->file('photo') )
                                    ->fit(600,360)
                                    ->save( 'img/gallery/'.$fileName);
                $image->name = $fileName;
            }
            $image->name = $fileName;
           
            $image->description = $request->description;

            $subbrand->images()->save($image);

            return redirect('admin');
        
    }
    
    public function storePackage(Request $request)
    {
        $this->validate($request,[
                'name'          => 'required',
                'price'         => 'required',
                'hours'         => 'required',
                'description'   => 'required',
                'product'       => 'required',
                'subbrand'      => 'required|exists:subbrands,id'
            ]);

            $package        = new Package();
            $subbrands      = Subbrand::findOrFail($request->subbrand);
            $products       = Product::findOrFail($request->product); 

            $package->name          = $request->name;
            $package->price         = $request->price;
            $package->hours         = $request->hours;
            $package->description   = $request->description;
            $package->product       = $request->product;

            $subbrands->packages()->save($package);
            $products->packages()->save($package);

            return redirect('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
