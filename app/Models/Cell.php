<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Cell extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'church_id',
        'name',
        'logo',
        'location',
        'address',
        'meeting_day',
        'meeting_time',
        'notes',
        'is_active',
    ];

    public function church(): BelongsTo
    {
        return $this->belongsTo(Church::class);
    }
}