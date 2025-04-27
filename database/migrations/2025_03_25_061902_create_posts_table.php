<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('text');
            // 1 to many relationship between posts and categories, removing onDelete('cascade') throws DB exception
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

/*
    Use Eloquent Model for posts and define relationship where each posts row belongs to one of
    categories row and link to show each posts by selected category

    To create foreign keys: use Laravel method foreignId() with constrained() which will create both DB column
    and foreign key relationship

    Name of relation column has format of "xx_id", where "xx" is singular form of relations table: categories
    And constrained(), which is shorter Laravel method for: ->references('id')->on('categories')

    `php artisan migrate`   // Run Database migrations files

    // Declare DB fields
    $table->text('long_description')->nullable();
    $table->boolean('completed')->default(false);
    $table->longText('content');

    // Add foreign key column:category_id to Posts table (Using other separate migration file)
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('category_id')->after('content')->constrained();
        });
    }

    // Add foreign key column:category_id to Posts table
    `php artisan make:migration "add category to posts table"`

*/
