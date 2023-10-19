<?php

namespace App\Models;

use App\Models\Supplier;
use App\Models\Component;
use App\Models\PaymentPurchase;
use App\Models\PurchaseHistory;
use App\Models\DeliveryPurchase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Purchase extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $with = ["components", "supplier", "histories", "products","payment_purchases", "delivery_purchases"];

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

    public function payment_purchases(): HasOne
    {
        return $this->hasOne(PaymentPurchase::class);
    }

    public function delivery_purchases(): HasOne
    {
        return $this->hasOne(DeliveryPurchase::class);
    }
}
