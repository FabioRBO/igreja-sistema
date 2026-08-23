<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialAccount extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'church_id',
        'name',
        'type',
        'bank_name',
        'agency',
        'account_number',
        'pix_key',
        'initial_balance',
        'is_active',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'initial_balance' => 'decimal:2',
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

    public function financialEntries(): HasMany
    {
        return $this->hasMany(FinancialEntry::class);
    }
}