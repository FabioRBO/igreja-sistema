<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CellParticipant extends Model
{
    //use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'cell_id',
        'person_id',
        'joined_at',
        'is_leader',
        'is_active',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'joined_at' => 'date',
            'is_leader' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function cell(): BelongsTo
    {
        return $this->belongsTo(Cell::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
