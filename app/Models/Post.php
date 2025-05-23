<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{

    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    // Because of update()/create() method of Model:Post defined inside Controller:PostController,all fields must
    // be added to $fillable property as array except for id and timestamps fields which are fillable by default
    protected $fillable = ['title', 'text', 'category_id'];

    // Each post belongs to category: which is a one-to-many relation
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

/*
    Eloquent Model is used for posts and there is relationship where each post belong to one of the categories

    Inside the page, link will show posts by the selected category

    To show category name, use foreign key column: category_id from posts table and define Eloquent relationship.
    Then, use category on post Model and call category field from categories table using: $post->category->name

    Inside the Model, define relationship as public method. There are various relationship types, however here,
    each post belongs to category: which is a one-to-many relation


    Useful DB commands:

    `php artisan make:model Post`     // Create Model class file: Post (1 artisan command) OR

    `php artisan make:model Post -m`  // Create Model class file: Post and Migration:xx_create_posts_table file (2 artisan commands)

    `php artisan migrate`             // Run Database migrations files


    https://laraveldaily.com/lesson/laravel-beginners/second-model-get-parameters-eloquent

*/
