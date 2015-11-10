<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public $table = "packages";

    public function subbrands()
    {
    	return $this->belongsToMany('App\Subbrand', 'subbrand_packages');
    }
}
