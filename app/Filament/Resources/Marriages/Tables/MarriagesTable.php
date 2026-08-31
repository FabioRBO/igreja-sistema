<?php

namespace App\Filament\Resources\Marriages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MarriagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('personOne.name')
                    ->label('Pessoa 1')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('personTwo.name')
                    ->label('Pessoa 2')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('marriage_date')
                    ->label('Data do casamento')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('years')
                    ->label('Anos')
                    ->state(function ($record): int {
                        return $record->marriage_date
                            ? $record->marriage_date->diffInYears(now())
                            : 0;
                    }),

                TextColumn::make('church.name')
                    ->label('Igreja')
                    ->searchable()
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Ativo')
                    ->boolean(),
            ])
            ->defaultSort('marriage_date')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}