<?php

namespace App\Filament\Resources\DocumentTypes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DocumentTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Категория документов')
                            ->description('Укажите название группы и загрузите прикрепляемые файлы')
                            ->icon('heroicon-o-folder-open')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Вид документа / Категория')
                                    ->placeholder('Например: Лицензии, Уставные документы, Прайс-листы')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                Repeater::make('documents')
                                    ->label('Список документов')
                                    ->relationship('documents')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Название документа')
                                            ->placeholder('Например: Выписка из ЕГРЮЛ')
                                            ->required()
                                            ->columnSpanFull(),

                                        FileUpload::make('document')
                                            ->label('Файл документа')
                                            ->disk('public')
                                            ->directory('documents')
                                            ->acceptedFileTypes(['application/pdf', 'image/*', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                                            ->downloadable()
                                            ->openable()
                                            ->required()
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2)
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                                    ->addActionLabel('Добавить документ')
                                    ->defaultItems(1),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}