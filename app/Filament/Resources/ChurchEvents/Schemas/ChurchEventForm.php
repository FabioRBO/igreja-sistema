<?php

namespace App\Filament\Resources\ChurchEvents\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ChurchEventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Culto / Evento')
                    ->schema([
                        Select::make('church_id')
                            ->label('Igreja')
                            ->relationship('church', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('event_type_id')
                            ->label('Tipo')
                            ->relationship('eventType', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('title')
                            ->label('Título')
                            ->placeholder('Ex.: Culto da Família')
                            ->required()
                            ->columnSpanFull(),

                        DatePicker::make('event_date')
                            ->label('Data')
                            ->native(false)
                            ->required(),

                        TimePicker::make('start_time')
                            ->label('Início')
                            ->seconds(false),

                        TimePicker::make('end_time')
                            ->label('Término')
                            ->seconds(false),

                        TextInput::make('location')
                            ->label('Local'),

                        Select::make('preachers')
                            ->label('Pregadores')
                            ->relationship('preachers', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Descrição')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Mídia / Site')
                    ->schema([
                        TextInput::make('youtube_url')
                            ->label('Vídeo / Transmissão do YouTube')
                            ->url()
                            ->placeholder('https://youtube.com/watch?v=...'),

                        FileUpload::make('banner')
                            ->label('Banner')
                            ->image()
                            ->directory('church-events'),

                        Toggle::make('publish_on_site')
                            ->label('Publicar no site')
                            ->default(false),

                        Toggle::make('is_active')
                            ->label('Ativo')
                            ->default(true),

                        Textarea::make('notes')
                            ->label('Observações internas')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}