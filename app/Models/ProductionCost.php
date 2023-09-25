<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Product;

class ProductionCost extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function product(): HasOne
    {
        return $this->hasOne(Product::class);
    }
}
