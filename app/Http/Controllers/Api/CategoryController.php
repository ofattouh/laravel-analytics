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
        Gate::authorize('db.rows.select');

        // return collection of all categories from DB Model:Category
        return CategoryResource::collection(Category::all());
    }
}
