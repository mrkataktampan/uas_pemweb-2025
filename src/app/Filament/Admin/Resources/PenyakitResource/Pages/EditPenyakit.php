<?php

namespace App\Filament\Admin\Resources\PenyakitResource\Pages;

use App\Filament\Admin\Resources\PenyakitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenyakit extends EditRecord
{
    protected static string $resource = PenyakitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
