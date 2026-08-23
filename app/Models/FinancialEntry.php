<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialEntry extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'church_id',
        'financial_category_id',
        'financial_account_id',
        'person_id',
        'type',
        'description',
        'competence_date',
        'due_date',
        'amount',
        'paid_amount',
        'payment_date',
        'payment_method',
        'status',
        'document_number',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'competence_date' => 'date',
            'due_date' => 'date',
            'payment_date' => 'datetime',
            'amount' => 'decimal:2',
            'paid_amount' => 'decimal:2',
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

    public function financialCategory(): BelongsTo
    {
        return $this->belongsTo(FinancialCategory::class);
    }

    public function financialAccount(): BelongsTo
    {
        return $this->belongsTo(FinancialAccount::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}