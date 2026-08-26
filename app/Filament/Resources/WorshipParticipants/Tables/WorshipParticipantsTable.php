<?php

namespace App\Filament\Resources\WorshipParticipants\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class WorshipParticipantsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('person.name')
                    ->label('Participante')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('role_type')
                    ->label('Atuação')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'vocal' => 'Vocal',
                        'instrumentalist' => 'Instrumentista',
                        'both' => 'Vocal e Instrumentista',
                        default => $state,
                    }),

                TextColumn::make('instruments')
                    ->label('Instrumentos')
                    ->formatStateUsing(function ($state): string {
                        if (blank($state)) {
                            return '—';
                        }

                        $instruments = is_array($state)
                            ? $state
                            : json_decode($state, true);

                        $labels = [
                            'violao' => 'Violão',
                            'guitarra' => 'Guitarra',
                            'baixo' => 'Baixo',
                            'teclado' => 'Teclado',
                            'bateria' => 'Bateria',
                            'sopro' => 'Sopro',
                            'outro' => 'Outro',
                        ];

                        return collect($instruments)
                            ->map(fn ($item) => $labels[$item] ?? $item)
                            ->implode(', ');
                    })
                    ->wrap(),

                TextColumn::make('availability')
                    ->label('Disponibilidade')
                    ->formatStateUsing(function ($state): string {
                        if (blank($state)) {
                            return '—';
                        }

                        $availability = is_array($state)
                            ? $state
                            : json_decode($state, true);

                        $labels = [
                            'wednesday' => 'Quarta',
                            'sunday_morning' => 'Dom. manhã',
                            'sunday_evening' => 'Dom. noite',
                        ];

                        return collect($availability)
                            ->map(fn ($item) => $labels[$item] ?? $item)
                            ->implode(', ');
                    })
                    ->wrap(),

                TextColumn::make('church.name')
                    ->label('Igreja')
                    ->searchable()
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Ativo')
                    ->boolean(),
            ])
            ->defaultSort('person.name')
            ->filters([
                SelectFilter::make('role_type')
                    ->label('Atuação')
                    ->options([
                        'vocal' => 'Vocal',
                        'instrumentalist' => 'Instrumentista',
                        'both' => 'Vocal e Instrumentista',
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