<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Основная информация')
                            ->description('Название, описание и дата проведения проекта')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Название проекта')
                                    ->placeholder('Например: Молодежный медицинский форум')
                                    ->required()
                                    ->maxLength(255),

                                DatePicker::make('date')
                                    ->label('Дата проведения')
                                    ->required()
                                    ->native(false)
                                    ->displayFormat('d.m.Y'),

                                Textarea::make('short_desc')
                                    ->label('Краткое описание для карточки')
                                    ->placeholder('Короткий текст, который отображается в анонсах')
                                    ->rows(2)
                                    ->required()
                                    ->columnSpanFull(),

                                Textarea::make('description')
                                    ->label('Полное описание')
                                    ->placeholder('Детальное описание проекта...')
                                    ->rows(4)
                                    ->required()
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),

                        Section::make('Метрики и показатели')
                            ->description('Ключевые цифры проекта для блока статистики')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                TextInput::make('count_season')
                                    ->label('Кол-во сезонов')
                                    ->numeric()
                                    ->default(1)
                                    ->required(),

                                TextInput::make('count_members')
                                    ->label('Кол-во участников')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),

                                TextInput::make('count_expert')
                                    ->label('Кол-во экспертов')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),

                                TextInput::make('count_parterns')
                                    ->label('Кол-во партнеров')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                            ])
                            ->columns(4),

                        Section::make('Форматы работы')
                            ->description('Варианты участия и форматы взаимодействия')
                            ->icon('heroicon-o-briefcase')
                            ->schema([
                                Repeater::make('formatWorks')
                                    ->label('Форматы')
                                    ->relationship('formatWorks')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Название формата')
                                            ->placeholder('Например: Воршопы и мастер-классы')
                                            ->required(),

                                        TextInput::make('description')
                                            ->label('Описание формата')
                                            ->required(),

                                        FileUpload::make('image')
                                            ->label('Иллюстрация формата')
                                            ->disk('public')
                                            ->directory('format_work')
                                            ->image()
                                            ->required()
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2)
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                                    ->addActionLabel('Добавить формат работы')
                                    ->defaultItems(0),
                            ]),

                        Section::make('Этапы проекта')
                            ->description('Последовательность шагов реализации')
                            ->icon('heroicon-o-list-bullet')
                            ->schema([
                                Repeater::make('projectStages')
                                    ->label('Этапы')
                                    ->relationship('projectStages')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Название этапа')
                                            ->placeholder('Например: Отборочный тур')
                                            ->required(),
                                    ])
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                                    ->addActionLabel('Добавить этап проекта')
                                    ->defaultItems(0),
                            ]),

                        Section::make('Партнеры проекта')
                            ->description('Организации и компании, поддерживающие проект')
                            ->icon('heroicon-o-user-group')
                            ->schema([
                                Repeater::make('partners')
                                    ->label('Партнеры')
                                    ->relationship('partners')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Имя / Название партнера')
                                            ->placeholder('Например: Минздрав РФ')
                                            ->required(),

                                        TextInput::make('description')
                                            ->label('Описание / Роль')
                                            ->placeholder('Генеральный партнер')
                                            ->required(),
                                    ])
                                    ->columns(2)
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => 
                                        isset($state['name']) 
                                            ? "{$state['name']}" . (isset($state['description']) ? " ({$state['description']})" : '') 
                                            : null
                                    )
                                    ->addActionLabel('Добавить партнера')
                                    ->defaultItems(0),
                            ]),

                        Section::make('Фотогалерея')
                            ->description('Изображения и фотоотчеты по проекту')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Repeater::make('images')
                                    ->label('Фотографии')
                                    ->relationship('images')
                                    ->schema([
                                        FileUpload::make('image')
                                            ->label('Картинка')
                                            ->disk('public')
                                            ->directory('image_work')
                                            ->image()
                                            ->required(),
                                    ])
                                    ->grid(3)
                                    ->collapsible()
                                    ->addActionLabel('Добавить фото')
                                    ->defaultItems(0),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}