<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
// Use HasFactory if needed
    protected $fillable = [
        'subcategory_name',
        'category_id',
    ];
    
    // Define relationship with Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
