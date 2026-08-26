<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorshipSchedule extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'church_id',
        'schedule_date',
        'service_type',
        'start_time',
        'title',
        'notes',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'schedule_date' => 'date',
            'is_active' => 'boolean',
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

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(
            WorshipParticipant::class,
            'worship_schedule_participant'
        )
            ->withPivot([
                'role',
                'instrument',
                'notes',
            ])
            ->withTimestamps();
    }
}