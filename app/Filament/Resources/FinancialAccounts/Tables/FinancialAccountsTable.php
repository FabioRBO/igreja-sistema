<?php

namespace App\Filament\Resources\FinancialAccounts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class FinancialAccountsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Conta / Caixa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'cash' => 'Caixa',
                        'checking' => 'Conta Corrente',
                        'savings' => 'Poupança',
                        'digital' => 'Conta Digital',
                        'other' => 'Outro',
                        default => $state,
                    }),

                TextColumn::make('bank_name')
                    ->label('Banco')
                    ->placeholder('—'),

                TextColumn::make('initial_balance')
                    ->label('Saldo inicial')
                    ->money('BRL')
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
                        'cash' => 'Caixa',
                        'checking' => 'Conta Corrente',
                        'savings' => 'Poupança',
                        'digital' => 'Conta Digital',
                        'other' => 'Outro',
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