<?php

namespace App\Models;

use App\Models\Presence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $with = ["presence"];

    public function presence(): HasMany
    {
        return $this->hasMany(Presence::class);
    }

}
