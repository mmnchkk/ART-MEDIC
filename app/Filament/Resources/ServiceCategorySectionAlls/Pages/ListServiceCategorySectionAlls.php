<?php

namespace App\Filament\Resources\ServiceCategorySectionAlls\Pages;

use App\Filament\Resources\ServiceCategorySectionAlls\ServiceCategorySectionAllResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServiceCategorySectionAlls extends ListRecords
{
    protected static string $resource = ServiceCategorySectionAllResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
