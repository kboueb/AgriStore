<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
    public function products(){
        return $this->belongsToMany('App\Product');
    }
}
