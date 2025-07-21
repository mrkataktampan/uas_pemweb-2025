<?php

namespace App\Filament\Admin\Resources\PenyakitResource\Pages;

use App\Filament\Admin\Resources\PenyakitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenyakits extends ListRecords
{
    protected static string $resource = PenyakitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
