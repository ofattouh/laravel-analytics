<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyUserController extends Controller
{

    /**
     * Get logged in user information
     */
    public function getUserInfo(Request $request)
    {
        $userDetails = [];

        // Check that user is logged in
        if (Auth::check()) {
            $userDetails = [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ];
        }

        return $userDetails;
    }
}

/*

    $user = $request->user();
    $user = Auth::user();
    $id = Auth::id();
    $userDetails = response()->json($request->user());

    https://laravel.com/docs/12.x/authentication

*/
