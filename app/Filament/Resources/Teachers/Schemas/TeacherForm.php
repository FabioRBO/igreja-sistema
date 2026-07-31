<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('church_id')
                    ->label('Igreja')
                    ->relationship('church', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('person_id')
                    ->label('Pessoa')
                    ->relationship('person', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('education')
                    ->label('Formação')
                    ->maxLength(255),

                TextInput::make('specialty')
                    ->label('Especialidade')
                    ->maxLength(255),

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