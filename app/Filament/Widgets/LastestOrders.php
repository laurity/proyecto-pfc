<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LastestOrders extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;
    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5) // Mostramos solo los 5 primeros pedidos
            ->defaultSort('created_at', 'desc') // Ordenamos los pedidos por fecha de creación
            ->columns([
                TextColumn::make('id')
                ->searchable()
                ->label('Pedido ID'),

                TextColumn::make('user.name')
                ->searchable()
                ->label('Usuario'),

                TextColumn::make('grand_total')
                ->label('Precio Total')
                ->money('EUR'),


            TextColumn::make('status')
                ->badge()
                // Esta linea es la que permite que el color del badge cambie según el estado del pedido
                ->color(fn (string $state):string => match($state) {
                    'new' => 'info',
                    'processing' => 'warning',
                    'shipped' => 'success',
                    'delivered' => 'success',
                    'cancelled' => 'danger',
                })
                ->label('Estado')
                ->icon(fn (string $state):string => match($state) {
                    'new' => 'heroicon-m-sparkles',
                    'processing' => 'heroicon-m-arrow-path',
                    'shipped' => 'heroicon-m-truck',
                    'delivered' => 'heroicon-m-check-badge',
                    'cancelled' => 'heroicon-m-x-circle',
                })
                ->sortable(),

                TextColumn::make('payment_method')
                ->label('Método de pago')
                ->sortable()
                ->searchable(),

                TextColumn::make('payment_status')
                ->label('Estado del pago')
                ->sortable()
                ->badge() 
                ->searchable(),

                TextColumn::make('created_at')
                ->label('Fecha de creación')
                ->dateTime()
                ->sortable(),

                TextColumn::make('updated_at')
                ->label('Fecha de actualización')
                ->dateTime()
                ->sortable(),
            ])

            ->actions([
                Action::make('Ver Pedido')
                ->icon('heroicon-m-eye')
                ->url(fn (Order $record): string => OrderResource::getUrl('view', ['record' => $record]))
            ]);
    }
}
