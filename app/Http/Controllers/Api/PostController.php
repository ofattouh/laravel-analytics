<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

// Data model
use App\Models\Post;

// Eloquent API Resource class
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        // return collection of all posts from DB Model:Post
        // return Post::all();

        // `PostResource` collection is a wrapper on top of Eloquent Query: Post::all() which can transform
        // each field to different format by returning array from `PostResource`:`toArray()` method
        // return PostResource::collection(Post::all());

        $numberRecords = 10;

        // N+1 issue: To avoid N+1 duplicate queries, eager load categories by using Laravel keyword `with`

        // Eloquent conditional clause: when() method, accepts where condition as first parameter. If condition
        // is true, Eloquent will execute closure function which is second parameter of when() method
        // Meaning: if `category` from request exists, this where condition closure will be added to query
        $posts = Post::with('category')
            ->when(request('category'), function (Builder $query) {
                $query->where('category_id', request('category'));
            })
            ->paginate($numberRecords);

        // Paginated posts data with number of database records
        return PostResource::collection($posts);
    }
}

/*
    Because all routes will be for API endpoint:`<domain>/api/posts` which will be added to routes/api.php file.
    This way Laravel automatically adds api/ prefix to the routes. By running below `api` artisan command,
    API routes is added to bootstrap/app.php file

    `php artisan install:api`  // Prepare Laravel application for API routes

    https://laravel-vue-pagination.org/
    https://laravel.com/docs/12.x/queries#conditional-clauses

*/
