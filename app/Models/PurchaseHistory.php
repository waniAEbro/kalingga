<?php

namespace App\Models;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseHistory extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }
}
