<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogisticsLoan extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'church_id',
        'logistics_request_id',
        'logistics_reservation_id',
        'inventory_item_id',
        'responsible_person_id',
        'quantity',
        'loan_date',
        'expected_return_date',
        'return_date',
        'status',
        'condition_on_loan',
        'condition_on_return',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'loan_date' => 'date',
            'expected_return_date' => 'date',
            'return_date' => 'date',
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

    public function logisticsRequest(): BelongsTo
    {
        return $this->belongsTo(LogisticsRequest::class);
    }

    public function logisticsReservation(): BelongsTo
    {
        return $this->belongsTo(LogisticsReservation::class);
    }

    public function inventoryItem(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class);
    }

    public function responsiblePerson(): BelongsTo
    {
        return $this->belongsTo(
            Person::class,
            'responsible_person_id'
        );
    }
}