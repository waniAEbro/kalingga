<?php

namespace App\Models;

use App\Models\Production;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warehouse extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $with = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
