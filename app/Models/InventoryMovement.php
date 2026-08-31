<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryMovement extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'church_id',
        'inventory_item_id',
        'type',
        'quantity',
        'movement_date',
        'origin',
        'destination',
        'responsible_person_id',
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

    public function item(): BelongsTo
    {
        return $this->belongsTo(
            InventoryItem::class,
            'inventory_item_id'
        );
    }

    public function responsiblePerson(): BelongsTo
    {
        return $this->belongsTo(
            Person::class,
            'responsible_person_id'
        );
    }
}