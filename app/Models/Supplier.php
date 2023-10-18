<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function components()
    {
        return $this->hasMany(Component::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
