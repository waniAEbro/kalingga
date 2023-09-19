<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentPurchase extends Model
{
    use HasFactory;
    protected $table = 'component_purchase';
    protected $guarded = ["id"];
}
