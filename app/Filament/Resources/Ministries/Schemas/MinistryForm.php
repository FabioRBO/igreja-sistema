<?php

namespace App\Filament\Resources\Ministries\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MinistryForm
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
                    ->label('Nome do ministério')
                    ->required(),

                TextInput::make('leader_name')
                    ->label('Líder responsável'),

                Textarea::make('description')
                    ->label('Descrição')
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Ativo')
                    ->default(true),
            ]);
    }
}
