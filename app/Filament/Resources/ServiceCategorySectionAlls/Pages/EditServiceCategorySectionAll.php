<?php

namespace App\Filament\Resources\ServiceCategorySectionAlls\Pages;

use App\Filament\Resources\ServiceCategorySectionAlls\ServiceCategorySectionAllResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditServiceCategorySectionAll extends EditRecord
{
    protected static string $resource = ServiceCategorySectionAllResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
