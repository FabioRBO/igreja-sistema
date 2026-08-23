<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReliefRequest extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'church_id',
        'assisted_person_id',
        'type',
        'requested_at',
        'priority',
        'description',
        'responsible_person_id',
        'status',
        'completed_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'requested_at' => 'datetime',
            'completed_at' => 'datetime',
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

    public function assistedPerson(): BelongsTo
    {
        return $this->belongsTo(AssistedPerson::class);
    }

    public function responsiblePerson(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'responsible_person_id');
    }
}