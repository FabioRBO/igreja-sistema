<?php

namespace App\Filament\Resources\InventoryMovements\Schemas;

use App\Models\InventoryMovement;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InventoryMovementInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('uuid')
                    ->label('UUID'),
                TextEntry::make('church.name')
                    ->label('Church'),
                TextEntry::make('inventory_item_id')
                    ->numeric(),
                TextEntry::make('type'),
                TextEntry::make('quantity')
                    ->numeric(),
                TextEntry::make('movement_date')
                    ->date(),
                TextEntry::make('origin')
                    ->placeholder('-'),
                TextEntry::make('destination')
                    ->placeholder('-'),
                TextEntry::make('responsiblePerson.name')
                    ->label('Responsible person')
                    ->placeholder('-'),
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
                    ->visible(fn (InventoryMovement $record): bool => $record->trashed()),
            ]);
    }
}
