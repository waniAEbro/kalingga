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
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $with = ["components", "pack", "production_costs", "other_costs", "warehouses", "suppliers", "production"];

    public function components(): BelongsToMany
    {
        return $this->belongsToMany(Component::class)->withPivot("quantity");
    }

    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class, "product_sale");
    }

    public function suppliers(): BelongsToMany
    {
        return $this->belongsToMany(Supplier::class, "product_supplier")->withPivot("price_per_unit");
    }

    public function production(): HasOne
    {
        return $this->hasOne(Production::class);
    }

    public function warehouses(): HasMany
    {
        return $this->hasMany(Warehouse::class);
    }

    public function pack(): BelongsTo
    {
        return $this->belongsTo(Pack::class);
    }

    public function production_costs(): BelongsTo
    {
        return $this->belongsTo(ProductionCost::class, "productioncosts_id", "id");
    }

    public function other_costs(): BelongsTo
    {
        return $this->belongsTo(OtherCost::class, "othercosts_id", "id");
    }
}
