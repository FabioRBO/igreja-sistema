<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do funcionário')
                    ->schema([
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

                        TextInput::make('position')
                            ->label('Cargo / Função')
                            ->required()
                            ->maxLength(255),

                        Select::make('employment_type')
                            ->label('Tipo de vínculo')
                            ->options([
                                'clt' => 'CLT',
                                'service_provider' => 'Prestador de serviço',
                                'self_employed' => 'Autônomo',
                                'paid_volunteer' => 'Voluntário remunerado',
                                'other' => 'Outro',
                            ])
                            ->required(),

                        DatePicker::make('admission_date')
                            ->label('Data de admissão')
                            ->native(false),

                        TextInput::make('base_amount')
                            ->label('Valor base')
                            ->numeric()
                            ->prefix('R$')
                            ->default(0)
                            ->required(),

                        Select::make('payment_frequency')
                            ->label('Periodicidade')
                            ->options([
                                'monthly' => 'Mensal',
                                'biweekly' => 'Quinzenal',
                                'weekly' => 'Semanal',
                                'per_service' => 'Por serviço',
                            ])
                            ->default('monthly')
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