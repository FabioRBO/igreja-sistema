<?php

namespace App\Filament\Resources\InventoryItems\Schemas;

use App\Models\InventoryItem;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InventoryItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('uuid')
                    ->label('UUID'),
                TextEntry::make('church.name')
                    ->label('Church'),
                TextEntry::make('inventory_category_id')
                    ->numeric(),
                TextEntry::make('name'),
                TextEntry::make('asset_code')
                    ->placeholder('-'),
                TextEntry::make('quantity')
                    ->numeric(),
                TextEntry::make('location')
                    ->placeholder('-'),
                TextEntry::make('condition')
                    ->placeholder('-'),
                TextEntry::make('acquisition_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('value')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                IconEntry::make('is_active')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (InventoryItem $record): bool => $record->trashed()),
            ]);
    }
}
