<?php

namespace App\Filament\Resources\Reviews\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Информация об авторе и оценка')
                            ->description('Данные пациента, дата отзыва и поставленный рейтинг')
                            ->icon('heroicon-o-user')
                            ->schema([
                                TextInput::make('last_name')
                                    ->label('Фамилия')
                                    ->placeholder('Иванов'),

                                TextInput::make('first_name')
                                    ->label('Имя')
                                    ->placeholder('Иван')
                                    ->required(),

                                TextInput::make('middle_name')
                                    ->label('Отчество')
                                    ->placeholder('Иванович'),

                                TextInput::make('rating')
                                    ->label('Рейтинг (от 1 до 5)')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(5)
                                    ->default(5)
                                    ->required(),

                                DatePicker::make('date')
                                    ->label('Дата отзыва')
                                    ->required()
                                    ->native(false)
                                    ->displayFormat('d.m.Y'),
                            ])
                            ->columns(3),

                        Section::make('Содержание отзыва')
                            ->description('Детальная история приема и впечатления пациента')
                            ->icon('heroicon-o-chat-bubble-bottom-center-text')
                            ->schema([
                                Textarea::make('desc_story')
                                    ->label('История пациента')
                                    ->placeholder('Подробный рассказ пациента о посещении клиники...')
                                    ->rows(4)
                                    ->required()
                                    ->columnSpanFull(),

                                Textarea::make('desc_like')
                                    ->label('Понравилось')
                                    ->placeholder('Что именно понравилось пациенту больше всего...')
                                    ->rows(3)
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}