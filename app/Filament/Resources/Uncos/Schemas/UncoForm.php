<?php

namespace App\Filament\Resources\Uncos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UncoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Основной контент')
                            ->description('Заголовок, дата и полный текст новости')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Название новости')
                                    ->placeholder('Введите заголовок новости...')
                                    ->required()
                                    ->maxLength(255),

                                DatePicker::make('data')
                                    ->label('Дата публикации')
                                    ->required()
                                    ->native(false)
                                    ->displayFormat('d.m.Y')
                                    ->default(now()),

                                RichEditor::make('description')
                                    ->label('Описание новости')
                                    ->placeholder('Подробный текст новости...')
                                    ->required()
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(2),

                Group::make()
                    ->schema([
                        Section::make('Медиа')
                            ->description('Обложка новости')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Картинка')
                                    ->disk('public')
                                    ->directory('news')
                                    ->image()
                                    ->imageEditor()
                                    ->required(),
                            ]),
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }
}