<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\Production;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductionSale extends Model
{
    use HasFactory;

    protected $table = "production_sale";

    protected $guarded = ["id"];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function production(): BelongsTo
    {
        return $this->belongsTo(Production::class);
    }
}
