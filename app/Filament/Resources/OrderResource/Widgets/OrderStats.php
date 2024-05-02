<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Nuevos Pedidos', Order::query()->where('status', 'new')->count()),
            Stat::make('Pedidos en proceso', Order::query()->where('status', 'processing')->count()),
            Stat::make('Pedidos enviados', Order::query()->where('status', 'shipped')->count()),
            Stat::make('Precio medio', Number::currency(Order::query()->avg('grand_total'), 'EUR')),
        ];
    }
}
