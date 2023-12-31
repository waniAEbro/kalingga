<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentSupplier extends Model
{
    use HasFactory;

    protected $table = 'component_supplier';

    protected $guarded = ["id"];
}
