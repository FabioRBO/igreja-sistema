<?php

namespace App\Filament\Resources\CellParticipants\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CellParticipantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('cell_id')
                    ->label('Célula')
                    ->relationship('cell', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('person_id')
                    ->label('Pessoa')
                    ->relationship('person', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                DatePicker::make('joined_at')
                    ->label('Data de entrada'),

                Toggle::make('is_leader')
                    ->label('Líder')
                    ->default(false),

                Toggle::make('is_active')
                    ->label('Ativo')
                    ->default(true),

                Textarea::make('notes')
                    ->label('Observações')
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }
}