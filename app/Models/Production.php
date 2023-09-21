<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Production extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $with = ["product", "sales"];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, "product_id", "id");
    }

    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class);
    }
}
