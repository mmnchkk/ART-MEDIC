<?php

namespace App\Filament\Resources\Uncos\Pages;

use App\Filament\Resources\Uncos\UncoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUncos extends ListRecords
{
    protected static string $resource = UncoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
