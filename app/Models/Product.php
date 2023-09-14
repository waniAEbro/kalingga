<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Component;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $with = ["components"];

    public function components(): BelongsToMany
    {
        return $this->belongsToMany(Component::class, "component_product")->withPivot("quantity");
    }

    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class, "product_sale");
    }

    public function suppliers(): BelongsToMany
    {
        return $this->belongsToMany(Supplier::class, "product_supplier");
    }

    public function production(): HasOne
    {
        return $this->hasOne(Production::class, "product_id", "id");
    }
}
