<?php

namespace App\Filament\Resources\Clinics\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;

class ClinicForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Основная информация и статистика')
                            ->description('Описание клиники, фото и показатели')
                            ->icon('heroicon-o-building-office')
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Фотография клиники')
                                    ->image()
                                    ->directory('clinics')
                                    ->required()
                                    ->columnSpanFull(),

                                RichEditor::make('description')
                                    ->label('Описание клиники')
                                    ->required()
                                    ->columnSpanFull(),

                                TextInput::make('count_study')
                                    ->label('Обучений в год')
                                    ->placeholder('10')
                                    ->numeric()
                                    ->required(),

                                TextInput::make('count_projects')
                                    ->label('Реализованных проектов')
                                    ->placeholder('20')
                                    ->numeric()
                                    ->required(),

                                TextInput::make('count_reviews')
                                    ->label('Положительных отзывов (%)')
                                    ->placeholder('90')
                                    ->numeric()
                                    ->required(),
                            ])
                            ->columns(3),

                        Section::make('Отделения и направления')
                            ->description('Список отделений клиники и направлений в них')
                            ->icon('heroicon-o-rectangle-stack')
                            ->schema([
                                Repeater::make('departments')
                                    ->label('Отделения')
                                    ->relationship('departments')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Название отделения')
                                            ->placeholder('Поликлиническое отделение')
                                            ->required()
                                            ->columnSpanFull(),

                                        RichEditor::make('description')
                                            ->label('Описание отделения')
                                            ->columnSpanFull(),

                                        Repeater::make('directions')
                                            ->label('Направления отделения')
                                            ->relationship('directions')
                                            ->schema([
                                                TextInput::make('name')
                                                    ->label('Название направления')
                                                    ->placeholder('Оториноларингология')
                                                    ->required()
                                                    ->columnSpanFull(),
                                            ])
                                            ->collapsible()
                                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                                            ->addActionLabel('Добавить направление')
                                            ->columnSpanFull(),
                                    ])
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                                    ->addActionLabel('Добавить отделение')
                                    ->defaultItems(1)
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
