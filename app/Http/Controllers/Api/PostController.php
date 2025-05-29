<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;

// Data model
use App\Models\Post;

// Eloquent API Resource class
use App\Http\Resources\PostResource;

// Request Class:StorePostRequest used for Form validation
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index()
    {
        // return collection of all posts from DB Model:Post
        // return Post::all();

        // `PostResource` collection is a wrapper on top of Eloquent Query: Post::all() which can transform
        // each field to different format by returning array from `PostResource`:`toArray()` method
        // return PostResource::collection(Post::all());

        // Check user role permissions with Laravel Gate using boot() method of AppServiceProvider
        // Authorize ONLY 1 action at a time
        Gate::authorize('db.rows.select');

        // `numberRecords` should match `:limit` property of TailwindPagination Vue component
        $numberRecords = 10;

        // Pass `order_column`, `order_direction` URL parameters with default values:"updated_at", "desc"
        $orderColumn = request('order_column', 'updated_at');
        $orderDirection = request('order_direction', 'desc');

        // Add validation to check if sort URL parameter has valid value
        if (! in_array($orderColumn, ['id', 'title', 'created_at', 'updated_at'])) {
            $orderColumn = 'updated_at';
        }

        // Add validation to check if sort URL parameter has valid value
        if (! in_array($orderDirection, ['asc', 'desc'])) {
            $orderDirection = 'desc';
        }

        // N+1 issue: To avoid N+1 duplicate queries, eager load categories by using Laravel keyword `with`

        // Eloquent conditional clause: when() method, accepts where condition as first parameter. If condition
        // is true, Eloquent will execute closure function which is second parameter of when() method
        // Meaning: if `search_variable` from request exists, this where condition closure will be added to query
        // Added prefix search_ to each DB search column/variable
        $posts = Post::with('category')
            ->when(request('search_category'), function (Builder $query) {
                $query->where('category_id', request('search_category'));
            })
            ->when(request('search_id'), function (Builder $query) {
                $query->where('id', request('search_id'));
            })
            ->when(request('search_title'), function (Builder $query) {
                $query->where('title', 'like', '%' . request('search_title') . '%');
            })
            ->when(request('search_content'), function (Builder $query) {
                $query->where('text', 'like', '%' . request('search_content') . '%');
            })
            ->when(request('search_global'), function (Builder $query) {
                $query->whereAny([ // Query any of following DB fields
                    'category_id',
                    'id',
                    'title',
                    'text',
                ], 'LIKE', '%' . request('search_global') . '%');
            })
            ->orderBy($orderColumn, $orderDirection)
            ->paginate($numberRecords);

        // Paginated posts data with number of database records
        return PostResource::collection($posts);
    }

    //
    public function store(StorePostRequest $request)
    {
        // Check user role permissions with Laravel Gate using boot() method of AppServiceProvider
        Gate::authorize('db.rows.create');
        Gate::authorize('db.rows.update');

        // Authorize/not multiple actions at a time using any or none
        // Gate::any(['db.rows.create', 'db.rows.update']);
        // Gate::none(['db.rows.create', 'db.rows.update']);

        // Validate Request when Form is submitted from Vue component:Posts/Create.vue,insert new Posts table entry
        $post = Post::create($request->validated());

        // return post resource object
        return new PostResource($post);
    }

    // Show single post from Vue Edit component
    public function show(Post $post)
    {
        // Check user role permissions with Laravel Gate using boot() method of AppServiceProvider
        Gate::authorize('db.rows.select');
        Gate::authorize('db.rows.update');

        // Check permission:db.rows.update against model:`Post`
        // Gate::authorize('db.rows.update', $post);

        // Authorize multiple actions at a time using any or none
        // Gate::any(['db.rows.select', 'db.rows.update']);

        return new PostResource($post);
    }

    // Save updated single post from Vue Edit component
    public function update(Post $post, StorePostRequest $request)
    {
        // Check user role permissions with Laravel Gate using boot() method of AppServiceProvider
        // Authorize ONLY 1 action at a time
        Gate::authorize('db.rows.update');

        // Validate Request when Form is submitted from Vue component:Posts/Edit.vue
        $post->update($request->validated());

        // return post resource object
        return new PostResource($post);
    }

    // Delete post
    public function destroy(Post $post)
    {
        // Check user role permissions with Laravel Gate using boot() method of AppServiceProvider
        // Authorize ONLY 1 action at a time
        Gate::authorize('db.rows.delete');

        $post->delete();

        // return nothing since record is deleted which will return 204 HTTP status code
        return response()->noContent();
    }
}

/*
    Because all routes will be for API endpoint:`<domain>/api/posts` which will be added to routes/api.php file.
    This way Laravel automatically adds api/ prefix to the routes. By running below `api` artisan command,
    API routes is added to bootstrap/app.php file

    `php artisan install:api`  // Prepare Laravel application for API routes


    // Simulate file upload, check if file exists and display filename in Laravel Log
    if ($request->hasFile('thumbnail')) {
        $filename = $request->file('thumbnail')->getClientOriginalName();
        info($filename);
    }


    https://laraveldaily.com/lesson/laravel-beginners/form-validation-controller-form-requests
    https://laravel.com/docs/12.x/validation#form-request-validation
    https://laravel.com/docs/12.x/queries#conditional-clauses

*/
