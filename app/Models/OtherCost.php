<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OtherCost extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function product(): HasOne
    {
        return $this->hasOne(Product::class);
    }
}
