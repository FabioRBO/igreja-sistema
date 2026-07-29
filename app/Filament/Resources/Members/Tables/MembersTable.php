<?php

namespace App\Filament\Resources\Members\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('person.name')
                ->label('Membro')
                ->searchable()
                ->sortable(),

            TextColumn::make('church.name')
                ->label('Igreja')
                ->searchable()
                ->sortable(),

            TextColumn::make('registration_number')
                ->label('Matrícula')
                ->searchable(),

            TextColumn::make('admission_date')
                ->label('Data de entrada')
                ->date('d/m/Y')
                ->sortable(),

            TextColumn::make('admission_type')
                ->label('Forma de entrada')
                ->formatStateUsing(fn (?string $state): string => match ($state) {
                    'batismo' => 'Batismo',
                    'transferencia' => 'Transferência',
                    'reconciliacao' => 'Reconciliação',
                    'aclamacao' => 'Aclamação',
                    'outro' => 'Outro',
                    default => $state ?? '',
                }),

            TextColumn::make('status')
                ->label('Situação')
                ->badge()
                ->formatStateUsing(fn (?string $state): string => ucfirst($state ?? '')),

            TextColumn::make('created_at')
                ->label('Cadastrado em')
                ->dateTime('d/m/Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('updated_at')
                ->label('Atualizado em')
                ->dateTime('d/m/Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ]);
    }
}
