<?php

namespace App\Filament\Resources\GardenResource\Pages;

use App\Filament\Resources\GardenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGarden extends EditRecord
{
    protected static string $resource = GardenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
