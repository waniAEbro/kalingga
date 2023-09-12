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

    protected $guarded = ["id"];

    protected $with = ["components", "categories"];

    public function components(): BelongsToMany
    {
        return $this->belongsToMany(Component::class, "component_product")->withPivot("quantity");
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }

    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class, "product_sale");
    }

    public function suppliers(): BelongsToMany
    {
        return $this->belongsToMany(Supplier::class, "product_supplier");
    }

    public function productions(): BelongsToMany
    {
        return $this->belongsToMany(Production::class, "product_production");
    }
}
