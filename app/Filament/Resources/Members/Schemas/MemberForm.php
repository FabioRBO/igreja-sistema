<?php

namespace App\Filament\Resources\Members\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MemberForm
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

                TextInput::make('registration_number')
                    ->label('Número de membro'),

                DatePicker::make('admission_date')
                    ->label('Data de entrada')
                    ->displayFormat('d/m/Y'),

                Select::make('admission_type')
                    ->label('Forma de entrada')
                    ->options([
                        'batismo' => 'Batismo',
                        'transferencia' => 'Transferência',
                        'reconciliacao' => 'Reconciliação',
                        'aclamacao' => 'Aclamação',
                        'outro' => 'Outro',
                    ]),

                Select::make('status')
                    ->label('Situação')
                    ->options([
                        'ativo' => 'Ativo',
                        'inativo' => 'Inativo',
                        'transferido' => 'Transferido',
                        'afastado' => 'Afastado',
                        'falecido' => 'Falecido',
                    ])
                    ->default('ativo')
                    ->required(),

                DatePicker::make('departure_date')
                    ->label('Data de saída')
                    ->displayFormat('d/m/Y'),

                Textarea::make('notes')
                    ->label('Observações')
                    ->columnSpanFull(),
            ]);
    }
}
