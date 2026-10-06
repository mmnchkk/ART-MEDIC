<?php

namespace App\Filament\Resources\Specialists\Tables;

use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
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

                TextColumn::make('full_name')
                    ->label('ФИО')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('specialization')
                    ->label('Специализация')
                    ->searchable(),

                TextColumn::make('experience')
                    ->label('Стаж'),

                TextColumn::make('services_count')
                    ->counts('services')
                    ->label('Услуг'),
            ])
            ->filters([
                //
            ]);
    }
}