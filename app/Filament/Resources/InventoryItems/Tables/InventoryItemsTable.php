<?php

namespace App\Filament\Resources\InventoryItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class InventoryItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Item')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('asset_code')
                    ->label('Patrimônio')
                    ->searchable()
                    ->placeholder('—'),

                TextColumn::make('category.name')
                    ->label('Categoria')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('quantity')
                    ->label('Quantidade')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('location')
                    ->label('Local')
                    ->searchable()
                    ->placeholder('—'),

                TextColumn::make('condition')
                    ->label('Conservação')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'new' => 'Novo',
                        'excellent' => 'Ótimo',
                        'good' => 'Bom',
                        'regular' => 'Regular',
                        'bad' => 'Ruim',
                        'unusable' => 'Inutilizado',
                        default => '—',
                    }),

                TextColumn::make('value')
                    ->label('Valor')
                    ->money('BRL')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('church.name')
                    ->label('Igreja')
                    ->searchable()
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Ativo')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Data de cadastro')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Última alteração')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('name')
            ->filters([
                SelectFilter::make('church_id')
                    ->label('Igreja')
                    ->relationship('church', 'name'),

                SelectFilter::make('inventory_category_id')
                    ->label('Categoria')
                    ->relationship('category', 'name'),

                SelectFilter::make('condition')
                    ->label('Conservação')
                    ->options([
                        'new' => 'Novo',
                        'excellent' => 'Ótimo',
                        'good' => 'Bom',
                        'regular' => 'Regular',
                        'bad' => 'Ruim',
                        'unusable' => 'Inutilizado',
                    ]),

                SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        '1' => 'Ativo',
                        '0' => 'Inativo',
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