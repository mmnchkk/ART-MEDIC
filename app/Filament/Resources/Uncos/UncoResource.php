<?php

namespace App\Filament\Resources\Uncos;

use App\Filament\Resources\Uncos\Pages\CreateUnco;
use App\Filament\Resources\Uncos\Pages\EditUnco;
use App\Filament\Resources\Uncos\Pages\ListUncos;
use App\Filament\Resources\Uncos\Schemas\UncoForm;
use App\Filament\Resources\Uncos\Tables\UncosTable;
use App\Models\Unco;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UncoResource extends Resource
{
    protected static ?string $model = Unco::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;

    protected static ?string $navigationLabel = 'Новости';
    protected static ?string $modelLabel = 'Новость';
    protected static ?string $pluralModelLabel = 'Новости';

    public static function form(Schema $schema): Schema
    {
        return UncoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UncosTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUncos::route('/'),
            'create' => CreateUnco::route('/create'),
            'edit' => EditUnco::route('/{record}/edit'),
        ];
    }
}