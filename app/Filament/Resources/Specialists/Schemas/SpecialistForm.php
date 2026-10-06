<?php

namespace App\Filament\Resources\Specialists\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SpecialistForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Основная информация')
                            ->schema([
                                TextInput::make('lastname')
                                    ->label('Фамилия')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('name')
                                    ->label('Имя')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('middle_name')
                                    ->label('Отчество')
                                    ->maxLength(255),

                                Textarea::make('description')
                                    ->label('Описание / О себе')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ])
                            ->columns(3),

                        Section::make('Статистика и Опыт')
                            ->schema([
                                TextInput::make('experience')
                                    ->label('Стаж работы')
                                    ->placeholder('Например: 10 лет')
                                    ->maxLength(255),

                                TextInput::make('count_operations')
                                    ->label('Количество операций')
                                    ->numeric()
                                    ->placeholder('Например: 1500'),

                                TextInput::make('percentage_reviews')
                                    ->label('Процент положительных отзывов')
                                    ->numeric()
                                    ->suffix('%')
                                    ->placeholder('Например: 98'),
                            ])
                            ->columns(3),

                        Section::make('Услуги')
                            ->schema([
                                Select::make('services')
                                    ->label('Оказываемые услуги')
                                    ->relationship('services', 'name')
                                    ->multiple()
                                    ->searchable()
                                    ->preload(),
                            ]),

                        Section::make('Квалификация и Образование')
                            ->schema([
                                Repeater::make('specialities')
                                    ->relationship('specialities')
                                    ->label('Специальности')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Название специальности')
                                            ->required(),
                                    ])
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),

                                Repeater::make('directions')
                                    ->relationship('directions')
                                    ->label('Направления')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Название направления')
                                            ->required(),
                                    ])
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),

                                Repeater::make('education')
                                    ->relationship('educations')
                                    ->label('Образование')
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('Учебное заведение / Курс')
                                            ->required(),
                                        TextInput::make('year')
                                            ->label('Год окончания'),
                                    ])
                                    ->columns(2)
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => isset($state['title']) ? ($state['title'] . ($state['year'] ? " ({$state['year']})" : '')) : null),

                                Repeater::make('accreditations')
                                    ->relationship('accreditations')
                                    ->label('Аккредитации')
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('Название аккредитации')
                                            ->required(),
                                    ])
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Фотография')
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Фото специалиста')
                                    ->image()
                                    ->directory('specialists')
                                    ->imageEditor()
                                    ->avatar(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}