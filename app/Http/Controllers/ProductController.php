<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    public function index(){
        if(request()-> categorie){
            $products = Product::with('categories')->whereHas('categories', function($query){
                $query->where('slug', request()->categorie);
            })->orderByDesc('created_at')->paginate(10);
        }else {
            # code...
            $products = Product::with('categories')->orderByDesc('created_at')->paginate(10);
        }

        //dd($products);
        return view('products.index')->with('products', $products);
    }

    public function show($slug) {
        $product = Product::where('slug', $slug)->firstorfail();

        return view('products.show')->with('product', $product);
    }

    public function search()
    {
        request()->validate([
            'q' => 'required|min:2'
        ]);

        $q = request()->input('q');

        $products = Product::where('title', 'like', "%$q%")
                ->orWhere('description', 'like', "%$q%")
                ->paginate(6);

        return view('products.search')->with('products', $products);
    }
}
