<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marriage extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'church_id',
        'person_one_id',
        'person_two_id',
        'marriage_date',
        'is_active',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'marriage_date' => 'date',
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

    public function personOne(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_one_id');
    }

    public function personTwo(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_two_id');
    }
}