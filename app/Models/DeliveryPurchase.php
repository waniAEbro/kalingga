<?php

namespace App\Models;
use App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryPurchase extends Model
{
    protected $guarded = ['id'];
    protected $with = ['purchases'];
    use HasFactory;

    public function purchases()
    {
        return $this->belongsTo(Purchase::class);
    }
}
