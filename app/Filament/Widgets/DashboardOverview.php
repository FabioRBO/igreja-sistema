<?php

namespace App\Filament\Widgets;

use App\Models\Cell;
use App\Models\Family;
use App\Models\Member;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Membros', Member::count())
                ->description('Total de membros')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Famílias', Family::count())
                ->description('Famílias cadastradas')
                ->descriptionIcon('heroicon-m-home')
                ->color('info'),

            Stat::make('Células', Cell::count())
                ->description('Células cadastradas')
                ->descriptionIcon('heroicon-m-building-library')
                ->color('warning'),
        ];
    }
}