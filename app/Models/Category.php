<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Use custom table name from database instead of default Model class plural name as database table name
    // protected $table = 'test_categories';
    protected $table = 'categories';

    // Because of update()/create() method of Model:Category defined inside Controller:CategoryController,
    // all fields must be added to $fillable property as array except for id and timestamps fields which
    // are fillable by default
    protected $fillable = ['name'];

}

/*

    The Model layer is used to fetch data from the database. There are two ways to fetch data:

    First method is using Query Builder with: `DB` facade, table, and call methods

    Second method is using Eloquent which is database layer of Laravel with many features and methods and
    is more convenient than using Query Builder method. Model name is the database table name in singular
    form. All model classes are created inside app/Models Directory, and they extend Model class from Eloquent

    By default, if you use Laravel naming, the Category Model name will use the categories table from the database,
    as plural form of the word "category". If you have another naming convention, you can specify table name
    inside the Model class with the protected $table property

    `php artisan make:model Category`     // Create Model class file: Category (1 artisan command) OR

    `php artisan make:model Category -m`  // Create both Model class file: Category, and migration xx_create_categories_table file (2 artisan commands)

    `php artisan migrate`                 // Run Database migrations files

*/
