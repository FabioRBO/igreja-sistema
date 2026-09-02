<?php

namespace App\Filament\Resources\LogisticsReservations;

use App\Filament\Resources\LogisticsReservations\Pages\CreateLogisticsReservation;
use App\Filament\Resources\LogisticsReservations\Pages\EditLogisticsReservation;
use App\Filament\Resources\LogisticsReservations\Pages\ListLogisticsReservations;
use App\Filament\Resources\LogisticsReservations\Schemas\LogisticsReservationForm;
use App\Filament\Resources\LogisticsReservations\Tables\LogisticsReservationsTable;
use App\Models\LogisticsReservation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LogisticsReservationResource extends Resource
{
    protected static ?string $model = LogisticsReservation::class;

    protected static ?string $modelLabel = 'Reserva';

    protected static ?string $pluralModelLabel = 'Reservas';

    protected static ?string $navigationLabel = 'Reservas';

    protected static string|\UnitEnum|null $navigationGroup = 'Logística';

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedCalendarDays;

    public static function form(Schema $schema): Schema
    {
        return LogisticsReservationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LogisticsReservationsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLogisticsReservations::route('/'),
            'create' => CreateLogisticsReservation::route('/create'),
            'edit' => EditLogisticsReservation::route('/{record}/edit'),
        ];
    }
}