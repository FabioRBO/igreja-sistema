<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorshipParticipant extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'church_id',
        'person_id',
        'role_type',
        'instruments',
        'availability',
        'is_active',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'instruments' => 'array',
            'availability' => 'array',
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

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function schedules(): BelongsToMany
    {
        return $this->belongsToMany(
            WorshipSchedule::class,
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