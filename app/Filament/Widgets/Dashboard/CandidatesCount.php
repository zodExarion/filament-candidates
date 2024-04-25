<?php

namespace App\Filament\Widgets\Dashboard;

use App\Models\Candidates;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class CandidatesCount extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Card::make('Candidates', Candidates::count()),
            Card::make('Working Candidates', Candidates::where('is_working', true)->count()),
        ];
    }
}
