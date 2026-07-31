<?php

namespace App\Filament\Resources\CellParticipants\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CellParticipantsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cell.name')
                    ->label('Célula')
                    ->searchable(),

                TextColumn::make('person.name')
                    ->label('Pessoa')
                    ->searchable(),

                TextColumn::make('joined_at')
                    ->label('Entrada')
                    ->date('d/m/Y'),

                IconColumn::make('is_leader')
                    ->label('Líder')
                    ->boolean(),

                IconColumn::make('is_active')
                    ->label('Ativo')
                    ->boolean(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}