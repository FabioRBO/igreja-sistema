<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogisticsDelivery extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'church_id',
        'logistics_loan_id',
        'inventory_item_id',
        'responsible_person_id',
        'type',
        'quantity',
        'movement_date',
        'condition',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'movement_date' => 'date',
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

    public function logisticsLoan(): BelongsTo
    {
        return $this->belongsTo(LogisticsLoan::class);
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