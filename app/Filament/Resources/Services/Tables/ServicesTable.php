<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Название услуги')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('prices_count')
                    ->counts('prices')
                    ->label('Вариантов цен'),

                TextColumn::make('specialists_count')
                    ->counts('specialists')
                    ->label('Специалистов'),

                TextColumn::make('stocks_count')
                    ->counts('stocks')
                    ->label('Акций'),

                TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ]);
    }
}