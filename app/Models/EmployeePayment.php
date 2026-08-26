<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeePayment extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'employee_id',
        'financial_account_id',
        'competence',
        'due_date',
        'base_amount',
        'additions',
        'discounts',
        'net_amount',
        'payment_date',
        'payment_method',
        'status',
        'financial_entry_id',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'due_date' => 'date',
            'payment_date' => 'datetime',
            'base_amount' => 'decimal:2',
            'additions' => 'decimal:2',
            'discounts' => 'decimal:2',
            'net_amount' => 'decimal:2',
        ];
    }

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function financialAccount(): BelongsTo
    {
        return $this->belongsTo(FinancialAccount::class);
    }

    public function financialEntry(): BelongsTo
    {
        return $this->belongsTo(FinancialEntry::class);
    }
}