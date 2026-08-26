<?php

namespace App\Filament\Resources\Employees\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('person.name')
                    ->label('Funcionário')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('position')
                    ->label('Cargo / Função')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('employment_type')
                    ->label('Vínculo')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'clt' => 'CLT',
                        'service_provider' => 'Prestador',
                        'self_employed' => 'Autônomo',
                        'paid_volunteer' => 'Voluntário remunerado',
                        'other' => 'Outro',
                        default => $state,
                    }),

                TextColumn::make('base_amount')
                    ->label('Valor base')
                    ->money('BRL')
                    ->sortable(),

                TextColumn::make('payment_frequency')
                    ->label('Periodicidade')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'monthly' => 'Mensal',
                        'biweekly' => 'Quinzenal',
                        'weekly' => 'Semanal',
                        'per_service' => 'Por serviço',
                        default => $state,
                    }),

                TextColumn::make('church.name')
                    ->label('Igreja')
                    ->searchable()
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Ativo')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('admission_date')
                    ->label('Admissão')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('person.name')
            ->filters([
                SelectFilter::make('employment_type')
                    ->label('Tipo de vínculo')
                    ->options([
                        'clt' => 'CLT',
                        'service_provider' => 'Prestador de serviço',
                        'self_employed' => 'Autônomo',
                        'paid_volunteer' => 'Voluntário remunerado',
                        'other' => 'Outro',
                    ]),

                SelectFilter::make('is_active')
                    ->label('Situação')
                    ->options([
                        '1' => 'Ativos',
                        '0' => 'Inativos',
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