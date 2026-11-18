<?php

namespace App\Filament\Resources\ServiceCategories\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (string $operation, ?string $state, Set $set, Get $get, ?Model $record) {
                                    if ($operation === 'create') {
                                        $set('slug', Str::slug((string) $state));
                                        return;
                                    }
                                    $currentSlug = $get('slug');
                                    $oldName = $record?->name;
                                    if (blank($currentSlug) || $currentSlug === Str::slug((string) $oldName)) {
                                        $set('slug', Str::slug((string) $state));
                                    }
                                })
                                ->columnSpanFull(),

                            TextInput::make('slug')
                                ->label('Slug (URL)')
                                ->required()
                                ->maxLength(255)
                                ->unique(ignoreRecord: true)
                                ->columnSpanFull(),

                            Textarea::make('description')
                                ->label('SEO Описание')
                                ->rows(3)
                                ->nullable()
                                ->columnSpanFull(),

                            TextInput::make('keywords')
                                ->label('Ключевые слова (SEO)')
                                ->maxLength(255)
                                ->nullable()
                                ->columnSpanFull(),
                        ])->columns(2),
                ])->columnSpanFull(),
            ]);
    }
}
