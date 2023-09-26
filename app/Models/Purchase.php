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

class Purchase extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $with = ["components", "supplier", "histories"];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function components(): BelongsToMany
    {
        return $this->belongsToMany(Component::class)->withPivot("quantity");
    }

    public function histories(): HasMany
    {
        return $this->hasMany(PurchaseHistory::class);
    }
}
