<?php

namespace App\Filament\Resources\ServiceCategorySectionAlls\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;

class ServiceCategorySectionAllForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Корневой раздел')
                        ->schema([
                            TextInput::make('name')
                                ->label('Название')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),

                            FileUpload::make('image')
                                ->label('Изображение')
                                ->disk('public')
                                ->directory('categories/section-alls')
                                ->columnSpanFull(),

                            Textarea::make('description')
                                ->label('Описание')
                                ->columnSpanFull(),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
