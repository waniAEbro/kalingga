<?php

namespace App\Models;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SaleHistory extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function sale(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class);
    }
}
