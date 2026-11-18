<?php

namespace App\Filament\Resources\Promotions\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

                            FileUpload::make('image')
                                ->label('Изображение акции')
                                ->disk('public')
                                ->directory('promotions')
                                ->required()
                                ->columnSpanFull(),

                            RichEditor::make('description')
                                ->label('Описание акции')
                                ->required()
                                ->columnSpanFull(),

                            TextInput::make('keywords')
                                ->label('Ключевые слова (SEO)')
                                ->maxLength(255)
                                ->nullable()
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
