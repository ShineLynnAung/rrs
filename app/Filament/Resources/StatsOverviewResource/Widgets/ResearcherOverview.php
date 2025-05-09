<?php

namespace App\Filament\Resources\StatsOverviewResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ResearcherOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
           
           Stat::make('Admin', User::role('admin')->count())
                ->icon('heroicon-o-user-circle')
                ->color('success'),
        ];
        
 // Stat::make('Total Researchers', \App\Models\Researcher::count())
            //     ->icon('heroicon-o-users'),

    }
}
