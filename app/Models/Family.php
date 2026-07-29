<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Family extends Model
{
    public function people(): HasMany
    {
        return $this->hasMany(Person::class);
    }
}
