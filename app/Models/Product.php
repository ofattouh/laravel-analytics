<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
   /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    // All fields must be added to $fillable property as array except for id and timestamps fields which
    // are fillable by default
    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    // 1 to Many relationship between Product and Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
