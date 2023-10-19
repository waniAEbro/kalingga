<?php

namespace App\Models;

use App\Models\PaymentSale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\DeliverySale;
use App\Models\Production;
use App\Models\SaleHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $with = ["customer", "products", "histories", "payment_sales", "delivery_sales"];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot("quantity");
    }

    public function productions(): HasOne
    {
        return $this->hasOne(Production::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(SaleHistory::class);
    }

    public function payment_sales(): HasOne
    {
        return $this->hasOne(PaymentSale::class);
    }

    public function delivery_sales(): HasOne
    {
        return $this->hasOne(DeliverySale::class);
    }
}
