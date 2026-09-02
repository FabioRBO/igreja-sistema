<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogisticsRequestItem extends Model
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'logistics_request_id',
        'inventory_item_id',
        'quantity',
        'notes',
    ];

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function logisticsRequest(): BelongsTo
    {
        return $this->belongsTo(LogisticsRequest::class);
    }

    public function inventoryItem(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class);
    }
}