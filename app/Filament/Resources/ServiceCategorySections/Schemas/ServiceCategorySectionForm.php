<?php

namespace App\Filament\Resources\ServiceCategorySections\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;

class ServiceCategorySectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Раздел категории')
                        ->schema([
                            Select::make('section_all_id')
                                ->relationship('sectionAll', 'name')
                                ->required()
                                ->searchable()
                                ->preload()
                                ->label('Корневой раздел')
                                ->columnSpanFull(),

                            TextInput::make('name')
                                ->label('Название раздела')
                                ->required()
                                ->maxLength(255),

                            FileUpload::make('image')
                                ->label('Изображение')
                                ->disk('public')
                                ->directory('categories/sections'),

                            Textarea::make('description')
                                ->label('Описание')
                                ->columnSpanFull(),
                        ])->columns(2),
                ])->columnSpanFull(),
            ]);
    }
}
