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

    protected $with = ["product", "sale"];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, "product_id", "id");
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }
}
