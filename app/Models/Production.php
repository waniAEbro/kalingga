<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Production extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $with = ["saleProductions"];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function saleProductions()
    {
        return $this->belongsToMany(Sale::class)->withPivot("quantity_finished", "quantity_not_finished");
    }
}
