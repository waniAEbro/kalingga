<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Purchase extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $with = ["components", "supplier"];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function components(): BelongsToMany
    {
        return $this->belongsToMany(Component::class)->withPivot("quantity");
    }
}
