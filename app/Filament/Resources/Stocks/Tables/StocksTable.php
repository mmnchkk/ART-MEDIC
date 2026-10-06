<?php

namespace App\Filament\Resources\Stocks\Tables;

use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StocksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Баннер')
                    ->square(),

                TextColumn::make('title')
                    ->label('Название акции')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('service.name')
                    ->label('Услуга')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—'),

                TextColumn::make('date')
                    ->label('Дата окончания')
                    ->date('d.m.Y')
                    ->sortable()
                    ->placeholder('—'),

                TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ]);
    }
}