<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChurchEvent extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'church_id',
        'event_type_id',
        'title',
        'event_date',
        'start_time',
        'end_time',
        'location',
        'description',
        'youtube_url',
        'banner',
        'publish_on_site',
        'is_active',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'publish_on_site' => 'boolean',
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

    public function eventType(): BelongsTo
    {
        return $this->belongsTo(EventType::class);
    }

    public function preachers(): BelongsToMany
    {
        return $this->belongsToMany(
            Preacher::class,
            'church_event_preacher'
        )->withTimestamps();
    }
}