<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Validation\ValidationException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register ALL permissions with Laravel Gate and return these permissions as a service
        try {
            foreach (Permission::pluck('name') as $permission) {
                Gate::define($permission, function ($user) use ($permission) {
                    return $user->roles()->whereHas('permissions', function (Builder $q) use ($permission) {
                        $q->where('name', $permission);
                    })->exists();
                });
            }
        } catch (QueryException $e) {
            /*
            throw ValidationException::withMessages([
                'Gate.Permission.exception' => $e,
            ]);
            */
        }
    }
}

/*

    Define all permissions for Laravel gate. The Gate::define accepts closure where we define what needs
    to be true. We check if any of the user roles have the needed permissions

    try/catch is needed because initially, there is no permissions table and even running migrations will
    result in error message: 'Base table or view not found'


    https://laravel.com/docs/12.x/authorization
    https://casl.js.org/v6/en/

*/
