<?php

namespace App\Filament\Widgets;

use App\Models\Deal;
use App\Models\Room;
use App\Models\Task;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getColumns(): int
    {
        return  3;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Tasks', Task::count())->icon('heroicon-o-rectangle-stack'),
            Stat::make('Users', User::count())->icon('heroicon-o-users'),
        ];
    }
}
