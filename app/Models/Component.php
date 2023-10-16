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

    protected $with = ["supplier"];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, "component_product");
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, "supplier_id", "id");
    }
}
