<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    function sales(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class);
    }
}
