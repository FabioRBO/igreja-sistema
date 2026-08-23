<?php

namespace App\Filament\Resources\AssistedPeople\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AssistedPersonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do assistido')
                    ->description('Informações da pessoa que recebe assistência da igreja.')
                    ->schema([
                        Select::make('church_id')
                            ->label('Igreja')
                            ->relationship('church', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('person_id')
                            ->label('Pessoa cadastrada')
                            ->relationship('person', 'name')
                            ->searchable()
                            ->preload()
                            ->helperText('Opcional. Utilize caso a pessoa já esteja cadastrada no sistema.'),

                        TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->label('Telefone')
                            ->tel()
                            ->maxLength(30),

                        TextInput::make('address')
                            ->label('Endereço')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('family_situation')
                            ->label('Situação familiar')
                            ->rows(4)
                            ->columnSpanFull(),

                        Textarea::make('notes')
                            ->label('Observações')
                            ->rows(4)
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('Ativo')
                            ->default(true),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}