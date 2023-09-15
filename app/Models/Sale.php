<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Production;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $with = ["customer", "product", "productions"];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class)->withPivot("quantity", "packing_cost", "outer_length", "outer_width", "outer_height", "inner_length", "inner_width", "inner_height");
    }

    public function productions(): BelongsToMany
    {
        return $this->belongsToMany(Production::class);
    }
}
