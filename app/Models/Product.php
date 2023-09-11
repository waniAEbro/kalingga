<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $with = ["components", "categories"];

    public function components()
    {
        return $this->belongsToMany(Component::class, "component_products");
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, "category_products");
    }
}
