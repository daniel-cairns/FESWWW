<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    public $table = 'images';

    public function subbrands_images()
    {
        return $this->hasMany('App\SubbrandImages');
    }

    public function bought_packages_images() 
    {
        
    }

    public function gallery_images()
    {
    	
    }
}
