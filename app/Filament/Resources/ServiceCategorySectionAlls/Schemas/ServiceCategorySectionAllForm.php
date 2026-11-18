<?php

namespace App\Filament\Resources\ServiceCategorySectionAlls\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
                                ->label('Изображение')
                                ->disk('public')
                                ->directory('categories/section-alls')
                                ->columnSpanFull(),

                            Textarea::make('description')
                                ->label('Описание')
                                ->columnSpanFull(),

                            TextInput::make('keywords')
                                ->label('Ключевые слова (SEO)')
                                ->maxLength(255)
                                ->nullable()
                                ->columnSpanFull(),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
