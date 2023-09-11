<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Component;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $with = ["components", "categories"];

    public function components(): BelongsToMany
    {
        return $this->belongsToMany(Component::class, "component_product");
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }
}
