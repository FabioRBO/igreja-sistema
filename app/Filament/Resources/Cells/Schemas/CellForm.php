<?php

namespace App\Filament\Resources\Cells\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CellForm
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
                ->label('Nome da célula')
                ->required(),

            FileUpload::make('logo')
                ->label('Logotipo')
                ->image()
                ->directory('celulas/logos')
                ->imageEditor(),

            TextInput::make('meeting_place')
                ->label('Local da reunião'),

            TextInput::make('address')
                ->label('Endereço'),

            Select::make('meeting_day')
                ->label('Dia da reunião')
                ->options([
                    'segunda' => 'Segunda-feira',
                    'terca' => 'Terça-feira',
                    'quarta' => 'Quarta-feira',
                    'quinta' => 'Quinta-feira',
                    'sexta' => 'Sexta-feira',
                    'sabado' => 'Sábado',
                    'domingo' => 'Domingo',
                ]),

            TimePicker::make('meeting_time')
                ->label('Horário')
                ->seconds(false),

            Toggle::make('is_active')
                ->label('Ativa')
                ->default(true),

            Textarea::make('notes')
                ->label('Observações')
                ->columnSpanFull(),
        ]);
    }
}
