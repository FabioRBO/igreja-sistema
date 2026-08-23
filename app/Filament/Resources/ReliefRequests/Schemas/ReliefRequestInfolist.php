<?php

namespace App\Filament\Resources\ReliefRequests\Schemas;

use App\Models\ReliefRequest;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ReliefRequestInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('uuid')
                    ->label('UUID'),
                TextEntry::make('church.name')
                    ->label('Church'),
                TextEntry::make('assistedPerson.name')
                    ->label('Assisted person'),
                TextEntry::make('type'),
                TextEntry::make('requested_at')
                    ->dateTime(),
                TextEntry::make('priority'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('responsiblePerson.name')
                    ->label('Responsible person')
                    ->placeholder('-'),
                TextEntry::make('status'),
                TextEntry::make('completed_at')
                    ->dateTime()
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
                    ->visible(fn (ReliefRequest $record): bool => $record->trashed()),
            ]);
    }
}
