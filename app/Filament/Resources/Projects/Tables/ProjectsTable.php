<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Проект')
                    ->icon('heroicon-o-folder')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->short_desc ? \Illuminate\Support\Str::limit($record->short_desc, 50) : null),

                TextColumn::make('date')
                    ->label('Дата')
                    ->date('d.m.Y')
                    ->icon('heroicon-o-calendar')
                    ->sortable(),

                TextColumn::make('count_members')
                    ->label('Участники')
                    ->badge()
                    ->color('info')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('count_expert')
                    ->label('Эксперты')
                    ->badge()
                    ->color('warning')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('count_parterns')
                    ->label('Партнеры')
                    ->badge()
                    ->color('success')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}