<?php

namespace App\Filament\Resources\Promotions\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;

class PromotionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Информация об акции')
                        ->schema([
                            TextInput::make('name')
                                ->label('Название акции')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),

                            FileUpload::make('image')
                                ->label('Изображение акции')
                                ->image()
                                ->directory('promotions')
                                ->required()
                                ->columnSpanFull(),

                            RichEditor::make('description')
                                ->label('Описание акции')
                                ->required()
                                ->columnSpanFull(),

                            DatePicker::make('date')
                                ->label('Дата')
                                ->required()
                                ->columnSpanFull(),
                        ])->columns(2),

                    Section::make('Связанные услуги')
                        ->schema([
                            Select::make('services')
                                ->relationship('services', 'name')
                                ->multiple()
                                ->preload()
                                ->searchable()
                                ->label('Услуги, участвующие в акции')
                                ->columnSpanFull(),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
