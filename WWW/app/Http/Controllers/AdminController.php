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
use App\SubbrandPackage;
use App\SubbrandImage;
use App\Slider;
use App\BoughtPackage;
use Validator;
use Response;
use Auth;
use App\PackageProduct;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if( Auth::user()->privilege == 'admin' ) {
                      
            $subbrands            = Subbrand::with('images','packages')->get();
            $users                = User::with('messages')->get();
            $products             = Product::all();
            $messages             = Message::all();
            $packages             = Package::with('subbrands')->get();
     
            return view('admin.index', compact('users', 'subbrands', 'messages', 'products', 'packages'));
        } else {

            return redirect('/account');
        }
    }

    public function storeImage(Request $request)
    {
        // Validate the request
        $validate = Validator::make($request->all(),[
            'subbrand'      => 'required|exists:subbrands,id',
            'photo'         => 'required|image',
            'description'   => 'required|min:5|max:100',
        ]);

        if( $validate->fails()){
            return back()
                    ->withErrors($validate, 'storeImage')
                    ->with('error', 'error on upload')
                    ->withInput();
        }

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

        return back();
    }

    public function updateImage(Request $request)
    {
        // Validate the request
        $validate = Validator::make($request->all(),[
            'subbrand'      => 'exists:subbrands,id',
            'image'         => 'exists:images,id',
            'photo'         => 'image',
            'description'   => 'required|min:5|max:100',
        ]);

        if( $validate->fails()){
            return back()
                    ->withErrors($validate, 'updateImage')
                    ->with('error', 'error on upload')
                    ->withInput();
        }

        $subbrand   = Subbrand::where($request->subbrand);
        
        
        $image      = Image::findOrFail($request->image);

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
            
            // Delete the old files                    
            \File::Delete('img/original'.$fileName);
            \File::Delete('img/gallery'.$fileName);                   
            
            $image->name = $fileName;
        }

        $image->description = $request->description;
        $image->save();

        return back();  
    }

    public function removeImage(Request $request)
    {
        // Validate the request
        $validate = Validator::make($request->all(),[
            'image_id'      => 'required|exists:images,id',
            'subbrand_id'   => 'required|exists:subbrands,id'
        ]);

        if( $validate->fails()){
            return back()
                    ->withErrors($validate, 'removeImage')
                    ->with('error', 'error on upload')
                    ->withInput();
        }

        $image_id       = $request->image_id;
        $subbrand_id    = $request->subbrand_id;
        $imageName      = Image::where('id',$image_id)->firstOrFail();
        // dd( $imageName);

        \File::Delete('img/original/'.$imageName->name);
        \File::Delete('img/gallery/'.$imageName->name);

        SubbrandImage::where('image_id', $image_id)
                        ->where('subbrand_id', $subbrand_id)
                        ->delete();

        Slider::where('image_id', $image_id)
                        ->where('subbrand_id', $subbrand_id)
                        ->delete();                

        return back()->with('message', 'Succesfully removed Image');
    }

    public function storePackage(Request $request)
    {
        $validate = Validator::make($request->all(),[
                'name'          => 'required|min:3|max:15',
                'price'         => 'required|numeric',
                'hours'         => 'required|numeric',
                'description'   => 'required|min:3|max:500',
                'product'       => 'required|exists:products,id',
                'subbrand'      => 'required|exists:subbrands,id'
        ]);

        if( $validate->fails()){
            return back()
                    ->withErrors($validate, 'storePackage')
                    ->with('error', 'error on upload')
                    ->withInput();
        }

        $package        = new Package();
        $subbrands      = Subbrand::findOrFail($request->subbrand);
        $products       = Product::findOrFail($request->product); 

        $package->name          = $request->name;
        $package->price         = $request->price;
        $package->hours         = $request->hours;
        $package->description   = $request->description;
        $package->slug          = str_slug( $request->name);
        $package->product       = $products->name;

        $subbrands->packages()->save($package);
        $products->packages()->save($package);

        return back()->with('message', 'Creation of Package Successful');
    }

    public function updatePackage(Request $request)
    {
        $validate = Validator::make($request->all(),[
                'name'          => 'min:3|max:15',
                'price'         => 'numeric',
                'hours'         => 'numeric',
                'description'   => 'min:3|max:500',
                'product'       => 'required|exists:products,id',
                'package'       => 'required|exists:packages,id',
        ]);

        // dd( $request);
        if( $validate->fails()){
            return back()
                    ->withErrors($validate, 'updatePackage')
                    ->with('error', 'error with update')
                    ->withInput();
        }
        
        $package = Package::findOrFail($request->package);
        $products = Product::where('id', $request->product)->first();
        
        $package->name          = $request->name;
        $package->price         = $request->price;
        $package->hours         = $request->hours;
        $package->description   = $request->description;
        $package->slug          = str_slug( $request->name);
        $package->product       = $products->name;

        $package->save();
        $products->packages()->save($package);
        
        return back()->with('message', 'Update Successful');
    }
    
    public function removePackage(Request $request)
    {
      $validate = Validator::make($request->all(),[
          'package_id'    => 'required|exists:packages,id',
          'subbrand_id'   => 'required|exists:subbrands,id'
      ]);

      if( $validate->fails()){
            return back()
                    ->withErrors($validate, 'removePackage')
                    ->with('error', 'error on upload')
                    ->withInput();
        }

      $package_id     = $request->package_id;
      $subbrand_id    = $request->subbrand_id;
      
      SubbrandPackage::where('package_id', $package_id)
                      ->where('subbrand_id', $subbrand_id)
                      ->delete();

      return back()->with('message', 'Removal Successful');
    }

    public function updateSubbrandPackages(Request $request)
    {
      $packages = $request->packageId;
      $subbrand = $request->subbrandId;

      $validate = Validator::make($request->all(),[
          'packageId'    => 'required|array|exists:packages,id',
          'subbrandId'   => 'required|exists:subbrands,id'
      ]);
      
      if( $validate->fails()){
            return back()
                    ->withErrors($validate, 'updateSubbrandPackages')
                    ->with('error', 'error with update')
                    ->withInput();
      }
      
      foreach ($packages as $package) {
        SubbrandPackage::create([
            'package_id'    => $package,
            'subbrand_id'   => $subbrand,
        ]);
      }
      
      return back()->with('message', 'Succesfully added package');     
    }

    public function deletePackage(Request $request)
    {
        $package = $request->packageId;

        $validate = Validator::make($request->all(),[
            'packageId' => 'required|exists:packages,id'
        ]);

        if($validate->fails()){
            return back()
                    ->withErrors($validate, 'deletePackage')
                    ->with('error', 'Unable to delete the selected package. Packages that are related to a subbrand or a client cannot be deleted.')
                    ->withInput();
        }

        PackageProduct::where('package_id', $package)->delete();
        Package::where('id', $package )->delete();
        

        return back()->with('message', 'Package was succesfully deleted.');
    }

    public function userRemove(Request $request)
    {
      $validate = Validator::make($request->all(),[
          'userId'    => 'required|exists:users,id',
      ]);

      if( $validate->fails()){
            return back()
                    ->withErrors($validate, 'userRemove')
                    ->with('error', 'error on delete')
                    ->withInput();
      }
            
      $id = $request->userId;
            
      $user = User::where('id', $id)->first();
      
      if( $user->privilege == 'admin')
      {
        return back()->with('error', 'You cannot delete an admin user!');
      
      } else {
        
        $images = Image::where('description', $id)->get();

        foreach ($images as $image) 
        {
          \File::Delete('img/users/'.$image->name);
          Image::where('id', $image->id)->delete();
        }

        $packages = BoughtPackage::where('user_id', $id)->get();

        foreach ($packages as $package ) {
            $package->delete();
        }

        $user->delete();
        
        return back()->with('message', 'The user was removed succesfully'); 
      }
    }

    public function packageAssociation(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'subbrands'   => 'required|array|exists:subbrands,id',
            'package'     => 'required|exists:packages,id'  
        ]);

        if( $validate->fails()){
                return back()
                        ->withErrors($validate, 'packageAssociation')
                        ->with('error', 'Error removing package')
                        ->withInput();
        }

        $package = $request->package;
        $subbrands = $request->subbrands;

        foreach ($subbrands as $subbrand ) {
            SubbrandPackage::where('package_id', $package)
                            ->where('subbrand_id', $subbrand)
                            ->delete();
        }

        return back()->with('message', 'Succesfully package from subbrands');
    } 

    public function userDisplay($id)
    {
      
      $user = User::where('id', $id)->first();
      $boughtPackages = BoughtPackage::where('user_id', $id)->get();
      $data = [ 'user' => $user, 'packages' => $boughtPackages];

      return $data;                    
    }

    public function userPackages($id)
    {
      $packages = Package::where('id', $id)->get();
      
      return $packages;                    

    }

    public function userImages($id) {

        $images = Image::where('description', $id)->get();

        return $images;
    }   

    // public function trycatch(){
    //     try {
    //         $capture = Capture::where('user_id', \Auth::user()->id)->where('id', $id)->firstOrFail();
    //     } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    //         return view('errors.captureNotFound');
    //     }
    // }
}   








