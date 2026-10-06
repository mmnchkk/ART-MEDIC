<?php

namespace App\Filament\Resources\Uncos\Pages;

use App\Filament\Resources\Uncos\UncoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUnco extends EditRecord
{
    protected static string $resource = UncoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
