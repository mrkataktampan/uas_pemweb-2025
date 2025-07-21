<?php

namespace App\Filament\Admin\Resources\HerbalResource\Pages;

use App\Filament\Admin\Resources\HerbalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHerbals extends ListRecords
{
    protected static string $resource = HerbalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
