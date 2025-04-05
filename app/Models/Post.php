<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Because of update()/create() method of Model:Category defined inside Controller:CategoryController,
    // all fields must be added to $fillable property as array except for id and timestamps fields which
    // are fillable by default
    protected $fillable = ['title', 'text', 'category_id'];
}

/*
    Eloquent Model is used for posts and there is relationship where each post belong to one of the categories

    Inside the page, link will show posts by the selected category

    Useful DB commands:

    `php artisan make:model Post`     // Create Model class file: Post (1 artisan command) OR

    `php artisan make:model Post -m`  // Create Model class file: Post and Migration:xx_create_posts_table file (2 artisan commands)

    `php artisan migrate`             // Run migrations Database files


    https://laraveldaily.com/lesson/laravel-beginners/second-model-get-parameters-eloquent

*/
