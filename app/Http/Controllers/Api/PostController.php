<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Data models
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // return collection of all posts from DB Model:Post
        return Post::all();
    }
}

/*
    Because all routes will be for API endpoint:`<domain>/api/posts` which will be added to routes/api.php file.
    This way Laravel automatically adds api/ prefix to the routes. By running below `api` artisan command,
    API routes is added to bootstrap/app.php file

    `php artisan install:api`  // Prepare Laravel application for API routes

*/
