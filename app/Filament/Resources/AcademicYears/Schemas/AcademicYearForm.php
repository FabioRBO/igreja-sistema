<?php

namespace App\Filament\Resources\AcademicYears\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AcademicYearForm
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

                TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),

                DatePicker::make('start_date')
                    ->label('Data inicial')
                    ->required(),

                DatePicker::make('end_date')
                    ->label('Data final')
                    ->required(),

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