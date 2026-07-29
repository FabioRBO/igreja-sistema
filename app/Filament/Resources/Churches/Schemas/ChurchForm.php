<?php

namespace App\Filament\Resources\Churches\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ChurchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            Select::make('parent_id')
                ->label('Igreja sede')
                ->relationship('parent', 'name')
                ->searchable()
                ->preload()
                ->nullable(),

            TextInput::make('name')
                ->label('Nome da igreja')
                ->required(),

            TextInput::make('legal_name')
                ->label('Razão social'),

            TextInput::make('document')
                ->label('CNPJ'),

            TextInput::make('phone')
                ->label('Telefone')
                ->tel(),

            TextInput::make('whatsapp')
                ->label('WhatsApp')
                ->tel(),

            TextInput::make('email')
                ->label('E-mail')
                ->email(),

            TextInput::make('zip_code')
                ->label('CEP'),

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

            TextInput::make('state')
                ->label('Estado')
                ->maxLength(2),

            Toggle::make('is_headquarters')
                ->label('É a igreja sede?')
                ->default(false),

            Toggle::make('is_active')
                ->label('Ativa')
                ->default(true),

            Textarea::make('notes')
                ->label('Observações')
                ->columnSpanFull(),
        ]);
    }
}
