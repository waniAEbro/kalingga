<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $with = ["products"];

    public function products()
    {
        return $this->belongsToMany(Product::class, "component_products");
    }
}
