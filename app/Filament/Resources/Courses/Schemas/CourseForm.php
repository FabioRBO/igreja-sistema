<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CourseForm
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
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),

                Select::make('type')
                    ->label('Tipo')
                    ->options([
                        'seminario' => 'Seminário',
                        'escola_biblica' => 'Escola Bíblica',
                        'curso_livre' => 'Curso Livre',
                        'discipulado' => 'Discipulado',
                        'formacao' => 'Formação',
                    ])
                    ->required(),

                Toggle::make('is_active')
                    ->label('Ativo')
                    ->default(true),

                Textarea::make('notes')
                    ->label('Observações')
                    ->rows(4)
                    ->columnSpanFull(),

            ]);
    }
}