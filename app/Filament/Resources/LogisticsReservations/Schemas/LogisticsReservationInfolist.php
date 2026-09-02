<?php

namespace App\Filament\Resources\LogisticsReservations\Schemas;

use App\Models\LogisticsReservation;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LogisticsReservationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('uuid')
                    ->label('UUID'),
                TextEntry::make('church.name')
                    ->label('Church'),
                TextEntry::make('logisticsRequest.title')
                    ->label('Logistics request')
                    ->placeholder('-'),
                TextEntry::make('inventoryItem.name')
                    ->label('Inventory item'),
                TextEntry::make('responsiblePerson.name')
                    ->label('Responsible person')
                    ->placeholder('-'),
                TextEntry::make('quantity')
                    ->numeric(),
                TextEntry::make('start_date')
                    ->date(),
                TextEntry::make('end_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('status'),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (LogisticsReservation $record): bool => $record->trashed()),
            ]);
    }
}
