<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Production;
use App\Models\PaymentSale;
use App\Models\SaleHistory;
use App\Models\DeliverySale;
use App\Models\DeliveryProduct;
use App\Models\HistoryDeliverySale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $with = ["customer", "histories", "payment_sales", "delivery_sales"];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot("quantity");
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

    public function sale_productions()
    {
        return $this->belongsToMany(Production::class);
    }

    public function deliveryProducts()
    {
        return $this->belongsToMany(DeliveryProduct::class);
    }

    public function deliveryHistories()
    {
        return $this->hasMany(HistoryDeliverySale::class);
    }
}
