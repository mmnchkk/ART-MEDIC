<?php
namespace App\Filament\Resources\Services\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    
                    // Основная информация
                    Section::make('Основная информация')
                        ->schema([
                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->required()
                                ->searchable()
                                ->preload()
                                ->label('Категория услуги')
                                ->columnSpanFull(),

                            TextInput::make('name')
                                ->label('Название услуги')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),

                            RichEditor::make('description')
                                ->label('Описание услуги')
                                ->required()
                                ->columnSpanFull(),

                            Textarea::make('preparation')
                                ->label('Подготовка к процедуре')
                                ->columnSpanFull(),

                            Textarea::make('method')
                                ->label('Способ проведения')
                                ->columnSpanFull(),
                        ]),

                    // Проблемы
                    Section::make('Проблемы, которые решает услуга')
                        ->schema([
                            Repeater::make('problems')
                                ->label('Проблемы')
                                ->relationship('problems')
                                ->schema([
                                    TextInput::make('name')
                                        ->label('Название проблемы')
                                        ->required(),
                                ])
                                ->addActionLabel('Добавить проблему')
                                ->columnSpanFull()
                        ]),

                    // Виды услуги
                    Section::make('Виды услуги')
                        ->schema([
                            Repeater::make('types')
                                ->label('Виды')
                                ->relationship('types')
                                ->schema([
                                    TextInput::make('description')
                                        ->label('Описание типа')
                                        ->required(),
                                    FileUpload::make('image')
                                        ->label('Изображение')
                                        ->image()
                                        ->directory('services/types'),
                                ])->columns(2)
                                ->addActionLabel('Добавить вид услуги')
                                ->columnSpanFull()
                        ]),

                    // Результаты До/После
                    Section::make('Результаты (До / После)')
                        ->schema([
                            Repeater::make('results')
                                ->label('Результаты')
                                ->relationship('results')
                                ->schema([
                                    FileUpload::make('image')
                                        ->label('Фото результата')
                                        ->image()
                                        ->directory('services/results')
                                        ->required(),
                                ])
                                ->addActionLabel('Добавить результат')
                                ->columnSpanFull()
                        ]),

                    // Цены и номенклатура (Прайс)
                    Section::make('Прайс и номенклатура')
                        ->schema([
                            Repeater::make('prices')
                                ->label('Цены услуг')
                                ->relationship('prices')
                                ->schema([
                                    Select::make('complexity_id')
                                        ->relationship('complexity', 'first_complexities')
                                        ->nullable()
                                        ->label('Сложность'),
                                    TextInput::make('code')
                                        ->label('Код Номенклатуры мед. услуг')
                                        ->required(),
                                    TextInput::make('code_mis')
                                        ->label('Код МИС')
                                        ->required(),
                                    TextInput::make('name')
                                        ->label('Наименование по прайсу')
                                        ->required(),
                                    TextInput::make('duration')
                                        ->label('Продолжительность (мин)')
                                        ->required(),
                                    TextInput::make('price')
                                        ->label('Цена (руб)')
                                        ->required()
                                        ->numeric(),
                                ])->columns(2)
                                ->addActionLabel('Добавить позицию прайса')
                                ->columnSpanFull()
                        ]),

                    // Врачи
                    Section::make('Специалисты')
                        ->schema([
                            Select::make('specialists')
                                ->relationship('specialists', 'lastname')
                                ->multiple()
                                ->preload()
                                ->searchable()
                                ->label('Врачи, выполняющие услугу')
                                ->columnSpanFull(),
                        ]),

                ])->columnSpanFull(),
            ]);
    }
}
