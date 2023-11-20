<?php

namespace App\Models;

use App\Models\Component;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryComponent extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function component()
    {
        return $this->belongsTo(Component::class);
    }

    public function deliveryPurchases()
    {
        return $this->belongsToMany(Purchase::class);
    }
}
