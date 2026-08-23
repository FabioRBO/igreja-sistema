<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssistedPerson extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'church_id',
        'person_id',
        'name',
        'phone',
        'address',
        'family_situation',
        'notes',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
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

    public function reliefRequests(): HasMany
    {
        return $this->hasMany(ReliefRequest::class);
    }
}