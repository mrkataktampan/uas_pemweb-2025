<?php

namespace App\Filament;

use Filament\Panel;
use Filament\PanelProvider;
use App\Filament\Admin\Resources\UserResource;
use App\Filament\Admin\Resources\HerbalResource;
use App\Filament\Admin\Resources\PenyakitResource;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->login()
            ->resources([
                UserResource::class,
                HerbalResource::class,
                PenyakitResource::class,
            ])
            ->pages([
                // Tambahkan halaman khusus jika ada
            ])
            ->middleware([
                // Tambahkan middleware jika ada
            ]);
    }
}
