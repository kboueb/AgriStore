<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Product extends Model
{
    public function getPrice() {
        $price = $this->price . ' FCFA';
        return $price;
    }

    public function categories() {
        return $this->belongsToMany('App\Category');
    }
}
