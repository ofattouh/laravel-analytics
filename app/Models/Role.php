<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    // Because of update()/create() method of Model, all fields must be added to $fillable property
    // as array except for id and timestamps fields which are fillable by default
    protected $fillable = ['name'];

    // Many-to-many relationship between models:role,permission
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    // Many-to-many relationship between models: role,user
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}

/*

    Create pivot table for many-to-many relationship,add relations to models: permission,role:
    `php artisan make:migration "create permission role table"`

    // Each user has a role: which is a one-to-many relation
    public function userRole(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

*/
