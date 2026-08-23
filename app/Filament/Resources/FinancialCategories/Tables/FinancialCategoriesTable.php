<?php

namespace App\Filament\Resources\FinancialCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class FinancialCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Categoria')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'income' => 'Receita',
                        'expense' => 'Despesa',
                        'both' => 'Receita e Despesa',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'income' => 'success',
                        'expense' => 'danger',
                        'both' => 'info',
                        default => 'gray',
                    }),

                TextColumn::make('church.name')
                    ->label('Igreja')
                    ->searchable()
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Ativa')
                    ->boolean(),
            ])
            ->defaultSort('name')
            ->filters([
                SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'income' => 'Receita',
                        'expense' => 'Despesa',
                        'both' => 'Receita e Despesa',
                    ]),
            ])
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