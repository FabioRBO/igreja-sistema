<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CellMeetingAttendance extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'cell_meeting_id',
        'person_id',
        'is_present',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'is_present' => 'boolean',
        ];
    }

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function cellMeeting(): BelongsTo
    {
        return $this->belongsTo(CellMeeting::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}