<?php

namespace App\Filament\Resources\ServiceCategories\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class ServiceCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Категория услуг')
                        ->schema([
                            Select::make('section_id')
                                ->relationship('section', 'name')
                                ->required()
                                ->searchable()
                                ->preload()
                                ->label('Раздел подразделов'),
                                
                            TextInput::make('name')
                                ->label('Название категории')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),
                        ])->columns(2),
                ])->columnSpanFull(),
            ]);
    }
}
