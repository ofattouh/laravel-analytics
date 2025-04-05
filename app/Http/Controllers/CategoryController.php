<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get records from table categories of Model:Category, pass category to View using Route Model binding
        $categories = Category::all();
        return view('categories.index', compact('categories')); // Use compact: pass same variable name categories

        // return 'Test Categories';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Use View file:create.blade.php from sub-folder:categories, return view as:sub-folder.viewfile
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Pass input name from Request class, which is injected into this method using Laravel
        Category::create([
            'name' => $request->input('name'),
        ]);

        // After submit/insert redirect to this route
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Clicking on category edit link, return the view and pass category variable using Route Model binding
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Pass input name from Request class, which is injected into this method using Laravel
        $category->update([
            'name' => $request->input('name'),
        ]);

        // After submit/update redirect to this route
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Pass category using Route Model Binding, meaning we can call delete() Eloquent method on Model:category
        $category->delete();

        // After submit/update redirect to this route
        return redirect()->route('categories.index');
    }
}

/*

    // Create Resource Controller:CategoryController with Model:Category to add type-hinted models for controller methods
    `php artisan make:controller CategoryController --resource --model=Category`

    These created methods are used:
    index() show a list of categories
    create() for showing the create form
    store() for saving record into database
    show() for showing individual records
    edit() for showing the edit form
    update() for updating data in the database
    destroy() for deleting a record

    Verb 	    URI 	                        Action 	    Route Name
    ------------------------------------------------------------------------
    GET 	    /categories 	                index 	    categories.index
    GET 	    /categories/create 	            create 	    categories.create
    POST 	    /categories 	                store 	    categories.store
    GET 	    /categories/{category} 	        show 	    categories.show
    GET 	    /categories/{category}/edit 	edit 	    categories.edit
    PUT/PATCH 	/categories/{category} 	        update 	    categories.update
    DELETE 	    /categories/{category} 	        destroy 	categories.destroy


    To add View file:index.blade.php in sub-folder:categories when returning this View, add dot between folder name
    and View file name as:categories.index. Example: Create index view file inside resources/views/categories

    To edit category inside view, use form with method POST, and action is Route of categories.update from
    resource: CategoryController with $category parameter. For update form, REST method is PUT/PATCH, which
    must be defined inside the view file for the form using @method Blade directive. Every form must have
    @csrf Blade directive for cross-site protection

    The categories.update Route goes to update() method of Controller: CategoryController where category
    is passed using Route Model Binding by default


    https://laraveldaily.com/lesson/laravel-beginners/categories-crud-table-create-edit-delete

*/
