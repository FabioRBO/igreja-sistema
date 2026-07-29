<?php

namespace App\Filament\Resources\People\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PeopleTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('name')
                ->label('Nome')
                ->searchable()
                ->sortable(),

            TextColumn::make('cpf')
                ->label('CPF')
                ->searchable(),

            TextColumn::make('phone')
                ->label('Telefone'),

            TextColumn::make('email')
                ->label('E-mail')
                ->searchable(),

            TextColumn::make('created_at')
                ->label('Cadastro')
                ->date('d/m/Y')
                ->sortable()
                ->toggleable(),

            TextColumn::make('updated_at')
                ->label('Atualizado')
                ->date('d/m/Y')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            
        ]);
    }
}
