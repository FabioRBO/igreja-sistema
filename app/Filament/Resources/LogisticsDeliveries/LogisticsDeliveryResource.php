<?php

namespace App\Filament\Resources\LogisticsDeliveries;

use App\Filament\Resources\LogisticsDeliveries\Pages\CreateLogisticsDelivery;
use App\Filament\Resources\LogisticsDeliveries\Pages\EditLogisticsDelivery;
use App\Filament\Resources\LogisticsDeliveries\Pages\ListLogisticsDeliveries;
use App\Filament\Resources\LogisticsDeliveries\Schemas\LogisticsDeliveryForm;
use App\Filament\Resources\LogisticsDeliveries\Tables\LogisticsDeliveriesTable;
use App\Models\LogisticsDelivery;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LogisticsDeliveryResource extends Resource
{
    protected static ?string $model = LogisticsDelivery::class;

    protected static ?string $modelLabel = 'Entrega / Devolução';

    protected static ?string $pluralModelLabel = 'Entregas / Devoluções';

    protected static ?string $navigationLabel = 'Entregas / Devoluções';

    protected static string|\UnitEnum|null $navigationGroup = 'Logística';

    protected static ?int $navigationSort = 4;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedArrowPath;

    public static function form(Schema $schema): Schema
    {
        return LogisticsDeliveryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LogisticsDeliveriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLogisticsDeliveries::route('/'),
            'create' => CreateLogisticsDelivery::route('/create'),
            'edit' => EditLogisticsDelivery::route('/{record}/edit'),
        ];
    }
}