<?php

namespace App\Filament\Resources\InventoryCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class InventoryCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Categoria')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('church.name')
                    ->label('Igreja')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Descrição')
                    ->limit(50)
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Ativa')
                    ->boolean()
                    ->sortable(),

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

                SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        '1' => 'Ativa',
                        '0' => 'Inativa',
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