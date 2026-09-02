<?php

namespace App\Filament\Resources\LogisticsRequests\Schemas;

use App\Models\LogisticsRequest;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LogisticsRequestInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('uuid')
                    ->label('UUID'),
                TextEntry::make('church.name')
                    ->label('Church'),
                TextEntry::make('requesterPerson.name')
                    ->label('Requester person')
                    ->placeholder('-'),
                TextEntry::make('title'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('request_date')
                    ->date(),
                TextEntry::make('needed_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('return_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('status'),
                TextEntry::make('destination')
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
                    ->visible(fn (LogisticsRequest $record): bool => $record->trashed()),
            ]);
    }
}
