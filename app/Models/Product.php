<?php

namespace App\Models;

use App\Models\Pack;
use App\Models\Category;
use App\Models\Component;
use App\Models\ProductionCost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $with = ["components", "pack", "production_costs", "other_costs"];

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

    public function production_costs(): BelongsTo
    {
        return $this->belongsTo(ProductionCost::class);
    }

    public function other_cost(): BelongsTo
    {
        return $this->belongsTo(OtherCost::class);
    }
}
