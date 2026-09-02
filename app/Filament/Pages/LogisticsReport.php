<?php

namespace App\Filament\Pages;

use App\Models\LogisticsDelivery;
use App\Models\LogisticsRequest;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class LogisticsReport extends Page
{
    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedChartBar;

    protected static ?string $navigationLabel =
        'Relatório de Logística';

    protected static ?string $title =
        'Relatório de Logística';

    protected static string|\UnitEnum|null $navigationGroup =
        'Logística';

    protected static ?int $navigationSort = 5;

    protected string $view =
        'filament.pages.logistics-report';

    public ?string $startDate = null;
    public ?string $endDate = null;
    public ?string $requestId = null;

    public function mount(): void
    {
        $this->startDate = now()
            ->startOfMonth()
            ->format('Y-m-d');

        $this->endDate = now()
            ->endOfMonth()
            ->format('Y-m-d');
    }

    public function getRequestsProperty(): Collection
    {
        return LogisticsRequest::query()
            ->orderBy('title')
            ->get();
    }

    public function getDeliveriesProperty(): Collection
    {
        return LogisticsDelivery::query()
            ->with([
                'church',
                'inventoryItem',
                'responsiblePerson',
                'logisticsLoan.logisticsRequest.requesterPerson',
            ])
            ->when(
                $this->startDate,
                fn (Builder $query) =>
                    $query->whereDate(
                        'movement_date',
                        '>=',
                        $this->startDate
                    )
            )
            ->when(
                $this->endDate,
                fn (Builder $query) =>
                    $query->whereDate(
                        'movement_date',
                        '<=',
                        $this->endDate
                    )
            )
            ->when(
                $this->requestId,
                fn (Builder $query) =>
                    $query->whereHas(
                        'logisticsLoan',
                        fn (Builder $loanQuery) =>
                            $loanQuery->where(
                                'logistics_request_id',
                                $this->requestId
                            )
                    )
            )
            ->orderByDesc('movement_date')
            ->get();
    }
}