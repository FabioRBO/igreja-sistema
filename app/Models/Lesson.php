<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'church_id',
        'subject_offering_id',
        'lesson_number',
        'title',
        'description',
        'lesson_date',
        'start_time',
        'end_time',
        'room',
        'qr_token',
        'qr_enabled',
        'qr_expires_at',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'lesson_number' => 'integer',
            'lesson_date' => 'date',
            'qr_enabled' => 'boolean',
            'qr_expires_at' => 'datetime',
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

    public function subjectOffering(): BelongsTo
    {
        return $this->belongsTo(SubjectOffering::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(LessonAttendance::class);
    }
}
