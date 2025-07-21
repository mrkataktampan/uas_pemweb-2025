<?php

namespace App\Filament\Admin\Resources\HerbalResource\Pages;

use App\Filament\Admin\Resources\HerbalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHerbal extends EditRecord
{
    protected static string $resource = HerbalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
