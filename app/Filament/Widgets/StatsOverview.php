<?php

namespace App\Filament\Widgets;

use App\Models\Loan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static bool $isLazy = true;
    protected function getStats(): array
    {
        return [
            Stat::make('Kredit', number_format(Loan::sum('POKOK_PINJAMAN')/1000,2)),
            Stat::make('Bounce rate', '21%'),
            Stat::make('Average time on page', '3:12'),
        ];
    }
}
