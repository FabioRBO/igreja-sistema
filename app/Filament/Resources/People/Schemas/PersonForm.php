<?php

namespace App\Filament\Resources\People\Schemas;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

use Filament\Schemas\Schema;

class PersonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->components([
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
        ]);
    }
}
