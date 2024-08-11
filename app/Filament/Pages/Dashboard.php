<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected function getHeaderWidgets(): array
    {
        // Return an empty array to remove any header widgets like "Welcome"
        return [];
    }

    protected function getFooterWidgets(): array
    {
        // Return an empty array to remove any footer widgets
        return [];
    }
}
