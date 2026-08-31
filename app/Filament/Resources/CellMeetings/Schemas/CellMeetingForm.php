<?php

namespace App\Filament\Resources\CellMeetings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CellMeetingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Dados da Reunião')
                    ->schema([

                        Select::make('church_id')
                            ->label('Igreja')
                            ->relationship('church', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('cell_id')
                            ->label('Célula')
                            ->relationship('cell', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        DatePicker::make('meeting_date')
                            ->label('Data da reunião')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->required(),

                        Textarea::make('notes')
                            ->label('Observações')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),


                Section::make('Integrantes presentes')
                    ->description('Informe as pessoas que participaram desta reunião.')
                    ->schema([

                        Repeater::make('attendances')
                            ->label('Participantes')
                            ->relationship('attendances')
                            ->schema([

                                Select::make('person_id')
                                    ->label('Pessoa')
                                    ->relationship('person', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems(),

                                Toggle::make('is_present')
                                    ->label('Presente')
                                    ->default(true),

                            ])
                            ->columns(2)
                            ->addActionLabel('Adicionar integrante')
                            ->reorderable(false)
                            ->columnSpanFull(),

                    ])
                    ->columnSpanFull(),

            ]);
    }
}