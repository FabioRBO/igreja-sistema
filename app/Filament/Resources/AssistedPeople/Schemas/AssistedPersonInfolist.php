<?php

namespace App\Filament\Resources\AssistedPeople\Schemas;

use App\Models\AssistedPerson;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AssistedPersonInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('uuid')
                    ->label('UUID'),
                TextEntry::make('church.name')
                    ->label('Church'),
                TextEntry::make('person.name')
                    ->label('Person')
                    ->placeholder('-'),
                TextEntry::make('name'),
                TextEntry::make('phone')
                    ->placeholder('-'),
                TextEntry::make('address')
                    ->placeholder('-'),
                TextEntry::make('family_situation')
                    ->placeholder('-')
                    ->columnSpanFull(),
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
                    ->visible(fn (AssistedPerson $record): bool => $record->trashed()),
            ]);
    }
}
