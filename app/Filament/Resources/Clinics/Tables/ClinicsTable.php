<?php

namespace App\Filament\Resources\Clinics\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClinicsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Фото')
                    ->circular(),

                TextColumn::make('count_study')
                    ->label('Обучения')
                    ->badge()
                    ->color('info'),

                TextColumn::make('count_projects')
                    ->label('Проекты')
                    ->badge()
                    ->color('primary'),

                TextColumn::make('count_reviews')
                    ->label('Отзывы (%)')
                    ->badge()
                    ->color('success'),

                TextColumn::make('departments_count')
                    ->counts('departments')
                    ->label('Отделений')
                    ->badge()
                    ->color('warning'),
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
