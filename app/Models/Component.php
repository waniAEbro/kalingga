<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Component extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $with = ["suppliers"];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function suppliers(): BelongsToMany
    {
        return $this->belongsToMany(Supplier::class, "component_supplier")->withPivot("price_per_unit");
    }

    public function purchases(): BelongsToMany
    {
        return $this->belongsToMany(Purchase::class, "component_purchase")->withPivot("quantity");
    }

    public function deliveryComponents()
    {
        return $this->hasMany(DeliveryComponent::class);
    }
}
