<?php

namespace App\Filament\Resources\Contacts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('adress')
                    ->label('Адрес')
                    ->icon('heroicon-o-map-pin')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('schedule')
                    ->label('Расписание')
                    ->icon('heroicon-o-clock')
                    ->searchable(),

                TextColumn::make('sms')
                    ->label('SMS')
                    ->searchable(),

                TextColumn::make('phones_count')
                    ->counts('phones')
                    ->label('Телефонов')
                    ->badge()
                    ->color('primary'),

                TextColumn::make('mails_count')
                    ->counts('mails')
                    ->label('E-mail')
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