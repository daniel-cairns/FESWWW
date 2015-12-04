<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubbrandPackage extends Model
{
    protected $fillable = ['package_id', 'subbrand_id'];
    public $table = 'subbrands_packages';
}
