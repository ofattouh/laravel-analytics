<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{

    // MUST match number of paginated records in Vue Laravel Pagination library
    protected $numberRecords = 6;

    // Used for API call:`api/products` defined in `routes/api.php`
    public function index()
    {
        // Product is paginated and eager loaded with Category to eliminate N+1 duplicate queries using `with`
        // $products = Product::with('category')->get();
        $products = Product::with('category')->paginate($this->numberRecords);

        // return resource object to change output fields format
        $productsResource = ProductResource::collection($products);

        return $productsResource;
        // return $products;
    }

    // Used to get result from:`api/products` and pass it as variable:`products` to view:`products.index`
    public function list()
    {
        // Product is paginated and eager loaded with Category to eliminate N+1 duplicate queries using `with`
        // $products = Product::with('category')->get();
        $products = Product::with('category')->paginate($this->numberRecords);

        // return resource object to change output fields format
        $productsResource = ProductResource::collection($products);

        return view('products.index', ['products' => $productsResource]);
    }
}

/*

    In Controller use `paginate(numberRecords)` and in Blade template, you can use `$products->links()`
    to generate pagination links instead of using Vue Laravel Pagination library

*/
