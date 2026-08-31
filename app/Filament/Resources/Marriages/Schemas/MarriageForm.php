<?php

namespace App\Filament\Resources\Marriages\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MarriageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do Casamento')
                    ->schema([
                        Select::make('church_id')
                            ->label('Igreja')
                            ->relationship('church', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('person_one_id')
                            ->label('Pessoa 1')
                            ->relationship('personOne', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('person_two_id')
                            ->label('Pessoa 2')
                            ->relationship('personTwo', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->different('person_one_id'),

                        DatePicker::make('marriage_date')
                            ->label('Data do casamento')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Ativo')
                            ->default(true),

                        Textarea::make('notes')
                            ->label('Observações')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}