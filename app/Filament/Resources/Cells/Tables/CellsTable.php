<?php

namespace App\Filament\Resources\Cells\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CellsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Célula')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('church.name')
                    ->label('Igreja')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('meeting_place')
                    ->label('Local')
                    ->searchable(),

                TextColumn::make('meeting_day')
                    ->label('Dia')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'segunda' => 'Segunda-feira',
                        'terca' => 'Terça-feira',
                        'quarta' => 'Quarta-feira',
                        'quinta' => 'Quinta-feira',
                        'sexta' => 'Sexta-feira',
                        'sabado' => 'Sábado',
                        'domingo' => 'Domingo',
                        default => $state ?? '',
                    }),

                TextColumn::make('meeting_time')
                    ->label('Horário')
                    ->time('H:i'),

                IconColumn::make('is_active')
                    ->label('Ativa')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Cadastrada em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Atualizada em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
