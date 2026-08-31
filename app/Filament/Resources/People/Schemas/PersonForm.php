<?php

namespace App\Filament\Resources\People\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class PersonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Visitante')
                    ->schema([
                        Toggle::make('is_visitor')
                            ->label('Visitante')
                            ->live(),

                        DatePicker::make('visit_date')
                            ->label('Data da visita')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->visible(
                                fn (Get $get): bool =>
                                    (bool) $get('is_visitor')
                            ),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Dados da Pessoa')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->required(),

                        TextInput::make('cpf')
                            ->label('CPF'),

                        DatePicker::make('birth_date')
                            ->label('Data de nascimento'),

                        Select::make('gender')
                            ->label('Sexo')
                            ->options([
                                'M' => 'Masculino',
                                'F' => 'Feminino',
                            ]),

                        TextInput::make('phone')
                            ->label('Telefone')
                            ->tel(),

                        TextInput::make('whatsapp')
                            ->label('WhatsApp')
                            ->tel(),

                        TextInput::make('email')
                            ->label('E-mail')
                            ->email(),

                        Select::make('family_id')
                            ->label('Família')
                            ->relationship('family', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),

                        Textarea::make('notes')
                            ->label('Observações')
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Endereço')
                    ->schema([
                        Select::make('address_type')
                            ->label('Tipo de logradouro')
                            ->options([
                                'Rua' => 'Rua',
                                'Avenida' => 'Avenida',
                                'Travessa' => 'Travessa',
                                'Estrada' => 'Estrada',
                                'Rodovia' => 'Rodovia',
                                'Alameda' => 'Alameda',
                                'Praça' => 'Praça',
                                'Largo' => 'Largo',
                                'Viela' => 'Viela',
                                'Outro' => 'Outro',
                            ])
                            ->searchable(),

                        TextInput::make('street')
                            ->label('Logradouro'),

                        TextInput::make('number')
                            ->label('Número'),

                        TextInput::make('complement')
                            ->label('Complemento'),

                        TextInput::make('district')
                            ->label('Bairro'),

                        TextInput::make('city')
                            ->label('Cidade'),

                        Select::make('state')
                            ->label('UF')
                            ->options([
                                'AC' => 'AC',
                                'AL' => 'AL',
                                'AP' => 'AP',
                                'AM' => 'AM',
                                'BA' => 'BA',
                                'CE' => 'CE',
                                'DF' => 'DF',
                                'ES' => 'ES',
                                'GO' => 'GO',
                                'MA' => 'MA',
                                'MT' => 'MT',
                                'MS' => 'MS',
                                'MG' => 'MG',
                                'PA' => 'PA',
                                'PB' => 'PB',
                                'PR' => 'PR',
                                'PE' => 'PE',
                                'PI' => 'PI',
                                'RJ' => 'RJ',
                                'RN' => 'RN',
                                'RS' => 'RS',
                                'RO' => 'RO',
                                'RR' => 'RR',
                                'SC' => 'SC',
                                'SP' => 'SP',
                                'SE' => 'SE',
                                'TO' => 'TO',
                            ])
                            ->searchable(),

                        TextInput::make('zip_code')
                            ->label('CEP')
                            ->mask('99999-999'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}