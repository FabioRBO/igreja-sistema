<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Person extends Model
{
    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }
}
