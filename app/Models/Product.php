<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function exists():bool {

        return (bool) $this->id;

    }
    
    protected $with = [

    ];
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
