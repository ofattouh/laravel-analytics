<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;

// Data models
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Get user role and permissions
        $userRolePermissions = $this->getUserRolePermissions($request);

        return view('profile.edit', [
            'user' => $request->user(),
            'userRole' => $userRolePermissions['userRole'],
            'userPermissions' => $userRolePermissions['userPermissions'],
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Get User role and permissions.
     */
    public function getUserRolePermissions(Request $request) {
        $userPermissions = array();

        // Query 1 Output
        $userRoleObj = Role::whereHas('users', function (Builder $q) use ($request) {
            $q->where('id', $request->user()->id);
        })->get();

        // Query 2 Output
        $userPermissionsObj = Permission::whereHas('rolePermissions', function (Builder $q) use ($userRoleObj) {
            $q->where('role_id', $userRoleObj[0]->id);
        })->get();

        // Populate logged-in user role permissions
        $count = 0;
        foreach ($userPermissionsObj as $permission) {
            $userPermissions[$count]['name'] = $permission->name;
            $userPermissions[$count]['description'] = $permission->description;
            $count++;
        }

        // var_dump($userPermissions);

        return [
            'userRole' => $userRoleObj[0]->name,
            'userPermissions' => $userPermissions,
        ];
    }
}


/*

    // Query 1 Output
    SQLSTATE[42S22]: Column not found: 1054 Unknown column 'user_id_@' in 'where clause'
    (Connection: mysql, SQL: select * from `roles` where exists (select * from `users` inner join `role_user`
    on `users`.`id` = `role_user`.`user_id` where `roles`.`id` = `role_user`.`role_id` and `user_id_@` = 7))

    // Query 2 Output
    SQLSTATE[42S22]: Column not found: 1054 Unknown column 'id2' in 'where clause'
    (Connection: mysql, SQL: select * from `permissions` where exists (select * from `roles` inner join
    `permission_role` on `roles`.`id` = `permission_role`.`role_id` where `permissions`.`id` =
    `permission_role`.`permission_id` and `id2` = 3))


     // Get logged in user role
    $roles = User::with('roles')->get();
    $roles2 = Role::where('user_id', $request->user()->id)->get();

    $userObj = User::whereHas('roles', function (Builder $q) use ($request) {
        $q->where('user_id', $request->user()->id);
    })->get();

    $posts = Post::whereHas('comments', function (Builder $query) {
        $query->where('content', 'like', 'code%');
    })->get();


    https://laravel.com/docs/12.x/eloquent-relationships
*/
