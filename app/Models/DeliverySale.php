<?php

namespace App\Models;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliverySale extends Model
{
    protected $guarded = ["id"];
    protected $with = ["sales"];
    use HasFactory;

    public function sales()
    {
        return $this->belongsTo(Sale::class);
    }
}
