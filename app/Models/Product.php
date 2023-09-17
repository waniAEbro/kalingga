<?php

namespace App\Models;

use App\Models\Pack;
use App\Models\Category;
use App\Models\Component;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $with = ["components", "pack"];

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

    public function warehouse(): HasOne
    {
        return $this->hasOne(Warehouse::class, "product_id", "id");
    }

    public function pack(): BelongsTo
    {
        return $this->belongsTo(Pack::class);
    }
}
