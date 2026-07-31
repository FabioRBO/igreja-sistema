<?php

namespace App\Filament\Resources\SubjectOfferings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class SubjectOfferingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

            TextColumn::make('course.name')
                ->label('Curso')
                ->searchable()
                ->sortable(),

            TextColumn::make('subject.name')
                ->label('Matéria')
                ->searchable()
                ->sortable(),

            TextColumn::make('teacher.person.name')
                ->label('Professor')
                ->searchable()
                ->sortable(),

            TextColumn::make('academicYear.name')
                ->label('Período')
                ->sortable(),

            TextColumn::make('class_name')
                ->label('Turma')
                ->sortable(),

            TextColumn::make('modality')
                ->label('Modalidade')
                ->badge(),

            IconColumn::make('is_active')
                ->label('Ativa')
                ->boolean(),

            TextColumn::make('updated_at')
                ->label('Atualizado')
                ->since()
                ->toggleable(),

        ]);
    }
}
