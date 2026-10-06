<?php

namespace App\Filament\Resources\Uncos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UncosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Обложка')
                    ->disk('public')
                    ->square(),

                TextColumn::make('title')
                    ->label('Название новости')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('data')
                    ->label('Дата')
                    ->date('d.m.Y')
                    ->icon('heroicon-o-calendar')
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Описание')
                    ->html()
                    ->limit(60)
                    ->wrap()
                    ->toggleable(),
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