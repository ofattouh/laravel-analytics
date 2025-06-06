<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    //
    public function index()
    {
        // Product is eager loaded with Category which eliminates N+1 duplicate queries using `with`
        $products = Product::with('category')->get();

        // return resource object to change output fields format
        return ProductResource::collection($products);

        //return $products;
    }
}
