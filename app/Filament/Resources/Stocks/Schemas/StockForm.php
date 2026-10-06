<?php

namespace App\Filament\Resources\Stocks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StockForm
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
                                    ->label('Название акции')
                                    ->placeholder('Например: Скидка 20% на первую процедуру')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                RichEditor::make('description')
                                    ->label('Описание акции')
                                    ->placeholder('Подробные условия проведения акции...')
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'bulletList',
                                        'orderedList',
                                        'link',
                                    ])
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Связи и параметры')
                            ->schema([
                                Select::make('service_id')
                                    ->label('Услуга')
                                    ->relationship('service', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                DatePicker::make('date')
                                    ->label('Дата окончания')
                                    ->native(false)
                                    ->displayFormat('d.m.Y'),

                                FileUpload::make('image')
                                    ->label('Баннер / Изображение')
                                    ->image()
                                    ->directory('stocks')
                                    ->imageEditor()
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}