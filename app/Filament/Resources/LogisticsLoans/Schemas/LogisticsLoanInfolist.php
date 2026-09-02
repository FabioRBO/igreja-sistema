<?php

namespace App\Filament\Resources\LogisticsLoans\Schemas;

use App\Models\LogisticsLoan;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LogisticsLoanInfolist
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
                TextEntry::make('logisticsReservation.id')
                    ->label('Logistics reservation')
                    ->placeholder('-'),
                TextEntry::make('inventoryItem.name')
                    ->label('Inventory item'),
                TextEntry::make('responsiblePerson.name')
                    ->label('Responsible person')
                    ->placeholder('-'),
                TextEntry::make('quantity')
                    ->numeric(),
                TextEntry::make('loan_date')
                    ->date(),
                TextEntry::make('expected_return_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('return_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('status'),
                TextEntry::make('condition_on_loan')
                    ->placeholder('-'),
                TextEntry::make('condition_on_return')
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
                    ->visible(fn (LogisticsLoan $record): bool => $record->trashed()),
            ]);
    }
}
