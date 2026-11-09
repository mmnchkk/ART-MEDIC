<?php

namespace App\Filament\Resources\ServiceCategorySections\Pages;

use App\Filament\Resources\ServiceCategorySections\ServiceCategorySectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServiceCategorySections extends ListRecords
{
    protected static string $resource = ServiceCategorySectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
