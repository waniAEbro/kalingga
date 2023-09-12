<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Production extends Model
{
    use HasFactory;

    public function products() :BelongsToMany {
        return $this->belongsToMany(Product::class);
    }

    public function sales() : BelongsToMany {
        return $this->belongsToMany(Sale::class);
    }
}
