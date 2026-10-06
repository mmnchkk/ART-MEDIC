<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Schemas\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Основная информация')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Название услуги')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                RichEditor::make('description')
                                    ->label('Описание')
                                    ->columnSpanFull(),

                                Textarea::make('preparation')
                                    ->label('Подготовка к процедуре')
                                    ->rows(3)
                                    ->columnSpanFull(),

                                Textarea::make('method')
                                    ->label('Методика проведения')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ]),

                        Section::make('Цены и Категории')
                            ->schema([
                                Repeater::make('prices')
                                    ->relationship('prices')
                                    ->label('Цены')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Наименование/Тип цены')
                                            ->placeholder('Например: Первичный прием')
                                            ->required(),
                                        TextInput::make('price')
                                            ->label('Цена')
                                            ->numeric()
                                            ->prefix('₽')
                                            ->required(),
                                    ])
                                    ->columns(2)
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => isset($state['title']) ? "{$state['title']} — " . ($state['price'] ?? 0) . " ₽" : null),

                                Repeater::make('categories')
                                    ->relationship('categories')
                                    ->label('Категории')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Название категории')
                                            ->required(),
                                    ])
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),

                                Repeater::make('types')
                                    ->relationship('types')
                                    ->label('Типы услуги')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Название типа')
                                            ->required(),
                                    ])
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                            ]),

                        Section::make('Дополнительная информация')
                            ->schema([
                                Repeater::make('results')
                                    ->relationship('results')
                                    ->label('Результаты процедуры')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Результат')
                                            ->required(),
                                    ])
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),

                                Repeater::make('problems')
                                    ->relationship('problems')
                                    ->label('Решаемые проблемы')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Проблема')
                                            ->required(),
                                    ])
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Связанные специалисты и акции')
                            ->schema([
                                Select::make('specialists')
                                    ->label('Специалисты')
                                    ->relationship('specialists')
                                    ->getOptionLabelFromRecordUsing(fn ($record) => trim("{$record->lastname} {$record->name} {$record->middle_name}"))
                                    ->multiple()
                                    ->searchable()
                                    ->preload(),

                                Select::make('stocks')
                                    ->label('Акции')
                                    ->relationship('stocks', 'name')
                                    ->multiple()
                                    ->searchable()
                                    ->preload(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}