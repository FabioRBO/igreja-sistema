<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryItem extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'church_id',
        'inventory_category_id',
        'name',
        'asset_code',
        'quantity',
        'location',
        'condition',
        'acquisition_date',
        'value',
        'notes',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'acquisition_date' => 'date',
            'value' => 'decimal:2',
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            InventoryCategory::class,
            'inventory_category_id'
        );
    }
}