<?php

namespace App\Filament\Resources\Baptisms\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BaptismForm
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

                DatePicker::make('baptism_date')
                    ->label('Data do batismo')
                    ->required(),

                TextInput::make('location')
                    ->label('Local')
                    ->maxLength(255),

                TextInput::make('officiant')
                    ->label('Celebrante')
                    ->maxLength(255),

                TextInput::make('certificate_number')
                    ->label('Número do certificado')
                    ->maxLength(100),

                Textarea::make('notes')
                    ->label('Observações')
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }
}