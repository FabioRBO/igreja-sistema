<?php

namespace App\Filament\Resources\Preachers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PreacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do pregador')
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
                            ->helperText('Opcional para pregadores convidados.'),

                        TextInput::make('name')
                            ->label('Nome')
                            ->required(),

                        TextInput::make('ministry')
                            ->label('Igreja / Ministério'),

                        TextInput::make('phone')
                            ->label('Telefone')
                            ->tel(),

                        TextInput::make('whatsapp')
                            ->label('WhatsApp')
                            ->tel(),

                        TextInput::make('email')
                            ->label('E-mail')
                            ->email(),

                        TextInput::make('instagram')
                            ->label('Instagram')
                            ->placeholder('@usuario'),

                        FileUpload::make('photo')
                            ->label('Foto')
                            ->image()
                            ->directory('preachers'),

                        Toggle::make('is_active')
                            ->label('Ativo')
                            ->default(true),

                        Textarea::make('biography')
                            ->label('Biografia')
                            ->rows(4)
                            ->columnSpanFull(),

                        Textarea::make('notes')
                            ->label('Observações')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}