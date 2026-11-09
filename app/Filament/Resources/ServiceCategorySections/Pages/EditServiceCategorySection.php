<?php

namespace App\Filament\Resources\ServiceCategorySections\Pages;

use App\Filament\Resources\ServiceCategorySections\ServiceCategorySectionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditServiceCategorySection extends EditRecord
{
    protected static string $resource = ServiceCategorySectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
