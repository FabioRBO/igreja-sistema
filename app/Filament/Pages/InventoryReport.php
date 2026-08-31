<?php

namespace App\Filament\Pages;

use App\Models\InventoryCategory;
use App\Models\InventoryItem;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class InventoryReport extends Page
{
    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedChartBar;

    protected static ?string $navigationLabel =
        'Relatório de Inventário';

    protected static ?string $title =
        'Relatório de Inventário';

    protected static string|\UnitEnum|null $navigationGroup =
        'Inventário';

    protected static ?int $navigationSort = 4;

    protected string $view =
        'filament.pages.inventory-report';

    public ?string $startDate = null;
    public ?string $endDate = null;

    public ?string $categoryId = null;
    public ?string $itemId = null;

    public function mount(): void
    {
        $this->startDate = now()
            ->startOfYear()
            ->format('Y-m-d');

        $this->endDate = now()
            ->endOfYear()
            ->format('Y-m-d');
    }

    public function getCategoriesProperty(): Collection
    {
        return InventoryCategory::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    public function getItemsProperty(): Collection
    {
        return InventoryItem::query()
            ->when(
                $this->categoryId,
                fn (Builder $query) =>
                    $query->where('inventory_category_id', $this->categoryId)
            )
            ->orderBy('name')
            ->get();
    }

    public function getInventoryProperty(): Collection
    {
        return InventoryItem::query()
            ->with([
                'category',
                'church',
            ])
            ->when(
                $this->startDate,
                fn (Builder $query) =>
                    $query->whereDate(
                        'acquisition_date',
                        '>=',
                        $this->startDate
                    )
            )
            ->when(
                $this->endDate,
                fn (Builder $query) =>
                    $query->whereDate(
                        'acquisition_date',
                        '<=',
                        $this->endDate
                    )
            )
            ->when(
                $this->categoryId,
                fn (Builder $query) =>
                    $query->where(
                        'inventory_category_id',
                        $this->categoryId
                    )
            )
            ->when(
                $this->itemId,
                fn (Builder $query) =>
                    $query->where('id', $this->itemId)
            )
            ->orderBy('name')
            ->get();
    }

    public function updatedCategoryId(): void
    {
        $this->itemId = null;
    }
}