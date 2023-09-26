<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Production;
use App\Models\SaleHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $with = ["customer", "product", "histories"];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class)->withPivot("quantity");
    }

    public function productions(): BelongsToMany
    {
        return $this->belongsToMany(Production::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(SaleHistory::class);
    }
}
