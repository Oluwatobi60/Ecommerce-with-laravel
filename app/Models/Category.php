<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name'
    ];

    // Define relationship with SubCategory model
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    // Define relationship with Product model
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
