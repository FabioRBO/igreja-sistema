<?php

namespace App\Filament\Resources\Families\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class FamiliesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Família')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Data de cadastro')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('updated_at')
                    ->label('Última alteração')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
