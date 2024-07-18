<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function detail($slug){
        $product = Product::query()->where('slug', $slug)->first();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->pluck('name', 'id')->all();

        return view('product-detail', compact('product', 'sizes', 'colors')) ;
    }
}
