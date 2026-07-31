<?php

namespace App\Filament\Resources\Grades\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class GradeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('uuid')
                    ->default(fn (): string => (string) Str::uuid()),

                Section::make('Lançamento da nota')
                    ->columns(2)
                    ->schema([
                        Select::make('church_id')
                            ->label('Igreja')
                            ->relationship('church', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('assessment_id')
                            ->label('Avaliação')
                            ->relationship('assessment', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('enrollment_id')
                            ->label('Matrícula')
                            ->relationship('enrollment', 'id')
                            ->getOptionLabelFromRecordUsing(
                                fn ($record): string => 'Matrícula #' . $record->id
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('score')
                            ->label('Nota')
                            ->numeric()
                            ->minValue(0)
                            ->required(),

                        Textarea::make('notes')
                            ->label('Observações')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
