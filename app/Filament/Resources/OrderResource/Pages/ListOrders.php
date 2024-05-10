<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    //Aquí añadiremos los widgets que queremos que aparezcan 

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStats::class
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('Todos los pedidos'),
            'Nuevos pedidos' => Tab::make()->query(fn ($query) => $query->where('status', 'new')),
            'Pedidos en proceso' => Tab::make()->query(fn ($query) => $query->where('status', 'processing')),
            'Pedidos enviados' => Tab::make()->query(fn ($query) => $query->where('status', 'shipped')),
            'Pedidos entregados' => Tab::make()->query(fn ($query) => $query->where('status', 'delivered')),
            'Pedidos cancelados' => Tab::make()->query(fn ($query) => $query->where('status', 'canceled')),
        ];
    }
}
