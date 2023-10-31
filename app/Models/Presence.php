<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presence extends Model
{
    use HasFactory;

    protected $guarded = ["id"];
    // protected $table = ["presence"];

    public function employee() : BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
