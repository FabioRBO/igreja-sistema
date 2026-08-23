<?php

namespace App\Filament\Resources\FinancialEntries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class FinancialEntriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('due_date')
                    ->label('Vencimento')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable()
                    ->limit(40),

                TextColumn::make('financialCategory.name')
                    ->label('Categoria')
                    ->searchable(),

                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'income' => 'Receita',
                        'expense' => 'Despesa',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'income' => 'success',
                        'expense' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('amount')
                    ->label('Valor')
                    ->money('BRL')
                    ->sortable(),

                TextColumn::make('paid_amount')
                    ->label('Pago / Recebido')
                    ->money('BRL'),

                TextColumn::make('status')
                    ->label('Situação')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pendente',
                        'partial' => 'Parcial',
                        'paid' => 'Pago / Recebido',
                        'cancelled' => 'Cancelado',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'partial' => 'info',
                        'paid' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('financialAccount.name')
                    ->label('Conta / Caixa')
                    ->placeholder('—')
                    ->toggleable(),
            ])
            ->defaultSort('due_date', 'desc')
            ->filters([
                SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'income' => 'Receitas',
                        'expense' => 'Despesas',
                    ]),

                SelectFilter::make('status')
                    ->label('Situação')
                    ->options([
                        'pending' => 'Pendente',
                        'partial' => 'Parcial',
                        'paid' => 'Pago / Recebido',
                        'cancelled' => 'Cancelado',
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