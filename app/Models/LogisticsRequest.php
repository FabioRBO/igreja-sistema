<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LogisticsRequest extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'church_id',
        'requester_person_id',
        'title',
        'description',
        'request_date',
        'needed_date',
        'return_date',
        'status',
        'destination',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'request_date' => 'date',
            'needed_date' => 'date',
            'return_date' => 'date',
        ];
    }

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function church(): BelongsTo
    {
        return $this->belongsTo(Church::class);
    }

    public function requesterPerson(): BelongsTo
    {
        return $this->belongsTo(
            Person::class,
            'requester_person_id'
        );
    }

    public function items(): HasMany
    {
        return $this->hasMany(LogisticsRequestItem::class);
    }
}