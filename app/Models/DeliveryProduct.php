<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryProduct extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function deliveryPurchases()
    {
        return $this->belongsToMany(Purchase::class);
    }

    public function deliverySales()
    {
        return $this->belongsToMany(Sale::class);
    }
}
