<?php

namespace App\Http\Controllers;

// Data models
use App\Models\Post;
use App\Models\Category;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // For performance reasons and to prohibit duplidate queries, We must use with() instead of all()
        // on the Post Model and provide the relationships that should be eagerly loaded which means all
        // categories will be fetched from posts table using 1 query
        //$posts = Post::all();
        $posts = Post::with('category')->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get list of categories and pass variable to View using compact() method
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Post::create([
            'title' => $request->input('title'),
            'text' => $request->input('text'),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Get list of categories and pass variable to View using compact() method
        $categories = Category::all();

        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
        $post->update([
            'title' => $request->input('title'),
            'text' => $request->input('text'),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();

        return redirect()->route('posts.index');
    }
}

/*

    After installing Laravel DebugBar package as Dev dependancy, open browser toolbar and check Queries tab for
    Laravel project performance issues and/or duplicate Database Queries if any

    With DB relationships, we can use eager loading to prevent too many SQL queries to Database because for
    many DB posts: one DB query will run for each of them which cause performance degredation of Laravel
    project and is also called the N+1 query problem. Therefore all() method is used if there was no DB
    foreign key relationship/condition and if there was any, we must use get() method on class Model:Post


*/

