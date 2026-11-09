<?php

namespace App\Filament\Resources\ServiceCategorySectionAlls;

use App\Filament\Resources\ServiceCategorySectionAlls\Pages\CreateServiceCategorySectionAll;
use App\Filament\Resources\ServiceCategorySectionAlls\Pages\EditServiceCategorySectionAll;
use App\Filament\Resources\ServiceCategorySectionAlls\Pages\ListServiceCategorySectionAlls;
use App\Filament\Resources\ServiceCategorySectionAlls\Schemas\ServiceCategorySectionAllForm;
use App\Filament\Resources\ServiceCategorySectionAlls\Tables\ServiceCategorySectionAllTable;
use App\Models\ServiceCategorySectionAll;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ServiceCategorySectionAllResource extends Resource
{
    protected static ?string $model = ServiceCategorySectionAll::class;

    // Группировка и название в левом меню
    protected static string|UnitEnum|null $navigationGroup = 'Управление услугами';
    protected static ?string $navigationLabel = 'Услуги';
    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Услуга';
    protected static ?string $pluralModelLabel = 'Услуги';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFolder;

    public static function form(Schema $schema): Schema
    {
        return ServiceCategorySectionAllForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceCategorySectionAllTable::configure($table);
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
            'index' => ListServiceCategorySectionAlls::route('/'),
            'create' => CreateServiceCategorySectionAll::route('/create'),
            'edit' => EditServiceCategorySectionAll::route('/{record}/edit'),
        ];
    }
}
