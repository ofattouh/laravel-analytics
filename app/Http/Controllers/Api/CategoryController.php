<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

// Data model
use App\Models\Category;

// Eloquent API Resource class
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    //
    public function index()
    {
        // Check user role permissions with Laravel Gate using boot() method of AppServiceProvider
        // Gate::authorize('db.rows.select');

        // return Category::all();

        // return collection of all categories as resource wrapped in `data` with only 2 fields:`id`,`name`
        // from Resource:`CategoryResource` using DB Model:`Category`
        return CategoryResource::collection(Category::all());
    }

    // Instead of returning category object,return new Resource object with category as parameter
    public function show(Category $category)
    {
        // return $category;
        return new CategoryResource($category);
    }

    // This method doesn't show field:`description` using `when` closure of Resource:`CategoryResource`
    public function list()
    {
        return CategoryResource::collection(Category::all());
    }

    // Save category to DB using API call to:`api/categories` or using Vue HTML Form with submit method
    public function store(Request $request)
    {
        // $category = Category::create($request->all());

        // Pass only the needed DB variable:`name` from API call
        $category = Category::create($request->only('name'));

        return new CategoryResource($category);
    }
}


/*

    After returning category resource instead of category object, ALL endpoints at:routes/api.php for this
    controller will return only two fields:`id`,`name` with new layer of data. It is best practice of JSON API
    to return data within the data, and everything else is reserved for error messages and additional information

    This is how we add rules of what fields must be returned using resource object:`CategoryResource`

    To create new category in `CategoryController`,in HTML Form without API,return redirect to a page however
    in API,return data in JSON format while best practice is to return the created record

*/
