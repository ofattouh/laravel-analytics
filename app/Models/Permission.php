<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    // Because of update()/create() method of Model, all fields must be added to $fillable property
    // as array except for id and timestamps fields which are fillable by default
    protected $fillable = ['name', 'description'];

    // Many-to-many relationship between models: permission,role
    public function rolePermissions(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}

/*

    Create pivot table for many-to-many relationship,add relations to models: permission,role:
    `php artisan make:migration "create permission role table"`

*/
