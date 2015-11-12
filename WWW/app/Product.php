<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = "products";

    public function packages()
    {
    	return $this->belongsToMany('App\Package', 'packages_products');
    }
}
