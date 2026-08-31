<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Person extends Model
{
    protected $fillable = [
        'family_id',
        'name',
        'birth_date',
        'is_active',

        'is_visitor',
        'visit_date',
        'address_type',

        'street',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'zip_code',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'visit_date' => 'date',

            'is_active' => 'boolean',
            'is_visitor' => 'boolean',
        ];
    }

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }
}