<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryDeliveryPurchase extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
