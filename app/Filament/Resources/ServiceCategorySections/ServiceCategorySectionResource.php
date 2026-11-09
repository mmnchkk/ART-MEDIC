<?php

namespace App\Filament\Resources\ServiceCategorySections;

use App\Filament\Resources\ServiceCategorySections\Pages\CreateServiceCategorySection;
use App\Filament\Resources\ServiceCategorySections\Pages\EditServiceCategorySection;
use App\Filament\Resources\ServiceCategorySections\Pages\ListServiceCategorySections;
use App\Filament\Resources\ServiceCategorySections\Schemas\ServiceCategorySectionForm;
use App\Filament\Resources\ServiceCategorySections\Tables\ServiceCategorySectionTable;
use App\Models\ServiceCategorySection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ServiceCategorySectionResource extends Resource
{
    protected static ?string $model = ServiceCategorySection::class;

    // Группировка в том же блоке
    protected static string|UnitEnum|null $navigationGroup = 'Управление услугами';
    protected static ?string $navigationLabel = 'Разделы услуг';
    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Раздел услуги';
    protected static ?string $pluralModelLabel = 'Разделы услуг';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ServiceCategorySectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceCategorySectionTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServiceCategorySections::route('/'),
            'create' => CreateServiceCategorySection::route('/create'),
            'edit' => EditServiceCategorySection::route('/{record}/edit'),
        ];
    }
}
