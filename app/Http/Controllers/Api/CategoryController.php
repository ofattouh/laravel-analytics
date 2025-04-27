<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Data model
use App\Models\Category;

// Eloquent API Resource class
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    //
    public function index()
    {
         // return collection of all categories from DB Model:Category
        return CategoryResource::collection(Category::all());
    }
}
