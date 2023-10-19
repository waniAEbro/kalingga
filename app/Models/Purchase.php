<?php

namespace App\Models;

use App\Models\Supplier;
use App\Models\Component;
use App\Models\PurchaseHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Purchase extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $with = ["components", "supplier", "histories", "products"];

    public function supplier(): HasOne
    {
        return $this->hasOne(Supplier::class);
    }

    public function components(): HasMany
    {
        return $this->hasMany(Component::class);
    }

    public function products(): HasMany
    {
        return $this->HasMany(Product::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(PurchaseHistory::class);
    }
}
