<?php

namespace App\Filament\Widgets\Dashboard;

use App\Models\Candidate;
use App\Models\Orders;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class CandidatesCount extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Card::make('Candidates', Candidate::count()),
            Card::make('Working Candidates', Candidate::where('is_working', true)->count()),
            Card::make('Active Orders', Orders::count()),
        ];
    }
}
