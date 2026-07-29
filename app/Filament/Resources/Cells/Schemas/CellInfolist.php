<?php

namespace App\Filament\Resources\Cells\Schemas;

use App\Models\Cell;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CellInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('uuid')
                    ->label('UUID'),
                TextEntry::make('church_id')
                    ->numeric(),
                TextEntry::make('name'),
                TextEntry::make('logo')
                    ->placeholder('-'),
                TextEntry::make('meeting_place')
                    ->placeholder('-'),
                TextEntry::make('address')
                    ->placeholder('-'),
                TextEntry::make('meeting_day')
                    ->placeholder('-'),
                TextEntry::make('meeting_time')
                    ->time()
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
                    ->visible(fn (Cell $record): bool => $record->trashed()),
            ]);
    }
}
