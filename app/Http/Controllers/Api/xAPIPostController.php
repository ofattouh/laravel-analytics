<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\xAPIPost;
use Illuminate\Http\Request;

// Eloquent API Resource class
use App\Http\Resources\xAPIPostResource;

class xAPIPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // return view('categories.index', compact('categories')); // Use compact: pass same variable name categories
        // var_dump($request);
        // Route::view('/welcome', 'welcome', ['name' => 'foo']);

        $profileId = $request->query('profileId');
        $activityId = $request->query('activityId');

        // echo "<br>profileId: ".$profileId;
        // echo "<br>activityId: ".$activityId;

        // echo "<br><br>";
        // print_r($request->query());

        // return "xAPIPostController:index";
        return view('xapi.prototypes', ['profileId' => $profileId, 'activityId' => $activityId]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        return "xAPIPostController:create";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(xAPIPost $xAPIPost, Request $request)
    {
        //
        // var_dump($request);
        return "xAPIPostController:store";
    }

    /**
     * Display the specified resource.
     */
    public function show(xAPIPost $xAPIPost)
    {
        //
        return "xAPIPostController:show";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        // xAPI Statements
        $statement   = $request->request->all();
        $statementId = $request->request->get('id');
        $statementTimeStamp = $request->request->get('timestamp');
        $statementActor = $request->array('actor');
        $statementVerb = $request->array('verb');
        $statementContext = $request->array('context');
        $statementObject = $request->array('object');

        echo "<br><br>statement: "; print_r($statement);
        echo "<br><br>statementId: ".$statementId;
        echo "<br><br>statementTimestamp: ".$statementTimeStamp;
        echo "<br><br>statementActor: "; print_r($statementActor);
        echo "<br><br>statementVerb: "; print_r($statementVerb);
        echo "<br><br>statementContext: "; print_r($statementContext);
        echo "<br><br>statementObject: "; print_r($statementObject);

        /*
        echo "<br><br>";
        print_r ($request->request);
        echo "<br><br>";
        print_r($request->request->get('id'));
        print_r($request->request->all());
        */

        // return post resource object
        // return new xAPIPostResource('post');

        // echo "<br><br>";
        return "xAPIPostController:edit";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(xAPIPost $xAPIPost, Request $request)
    {
        //
        return "xAPIPostController:update";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(xAPIPost $xAPIPost, Request $request)
    {
        //
        return "xAPIPostController:destroy";
    }
}

/*

    https://laravel.com/docs/12.x/requests
*/
