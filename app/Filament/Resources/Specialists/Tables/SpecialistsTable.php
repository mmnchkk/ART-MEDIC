<?php

namespace App\Filament\Resources\Specialists\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SpecialistsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Фото')
                    ->circular(),

                TextColumn::make('lastname')
                    ->label('Фамилия')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Имя')
                    ->searchable(),

                TextColumn::make('middle_name')
                    ->label('Отчество')
                    ->searchable(),

                TextColumn::make('experience')
                    ->label('Опыт (лет)')
                    ->sortable(),

                TextColumn::make('count_operations')
                    ->label('Операций')
                    ->sortable(),

                TextColumn::make('percentage_reviews')
                    ->label('% отзывов')
                    ->badge()
                    ->color('success'),
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
