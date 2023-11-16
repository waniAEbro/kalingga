<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryComponent extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function components()
    {
        return $this->hasMany(Component::class);
    }
}
