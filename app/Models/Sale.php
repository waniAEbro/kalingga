<?php

namespace App\Models;

use App\Models\Payment;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Delivery;
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

    protected $with = ["customer", "product", "histories", "payments", "deliveries"];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class)->withPivot("quantity");
    }

    public function productions(): HasMany
    {
        return $this->hasMany(Production::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(SaleHistory::class);
    }

    public function payments()
    {
        return $this->hasOne(Payment::class);
    }

    public function deliveries()
    {
        return $this->hasOne(Delivery::class);
    }
}
