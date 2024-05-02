<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Number;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?int $navigationSort = 5; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Información del pedido')
                        ->schema([
                            Select::make('user_id')
                                ->label('Usuario')
                                ->relationship('user', 'name')
                                ->required()
                                ->searchable()
                                ->preload(),

                            Select::make('payment_method')
                                ->label('Método de pago')
                                ->options([
                                    'credit_card' => 'Tarjeta de crédito',
                                    'paypal' => 'PayPal',
                                    'cash' => 'Efectivo',
                                ])
                                ->required(),

                            Select::make('payment_status')
                                ->label('Estado del pago')
                                ->options([
                                    'pending' => 'Pendiente',
                                    'paid' => 'Pagado',
                                    'failed' => 'Fallido',
                                ])
                                ->default('pending')
                                ->required(),

                            ToggleButtons::make('status')
                                ->label('Estado del pedido')
                                ->inline()
                                ->default('new')
                                ->required()
                                ->options([
                                    'new' => 'Nuevo',
                                    'processing' => 'Procesando',
                                    'shipped' => 'Enviado',
                                    'delivered' => 'Entregado',
                                    'canceled' => 'Cancelado',
                                ])
                                ->colors([
                                    'new' => 'info',
                                    'processing' => 'warning',
                                    'shipped' => 'success',
                                    'delivered' => 'success',
                                    'canceled' => 'danger',
                                ])
                                ->icons([
                                    'new' => 'heroicon-m-sparkles',
                                    'processing' => 'heroicon-m-arrow-path',
                                    'shipped' => 'heroicon-m-truck',
                                    'delivered' => 'heroicon-m-check',
                                    'canceled' => 'heroicon-m-x-circle',
                                ]),

                            Select::make('currency')
                                ->label('Moneda')
                                ->options([
                                    'USD' => 'Dólar estadounidense',
                                    'EUR' => 'Euro',
                                    'GBP' => 'Libra esterlina',
                                    'JPY' => 'Yen japonés',
                                    'CNY' => 'Yuan chino',
                                ])
                                ->default('EUR')
                                ->required(),

                            Select::make('shipping_method')
                                ->label('Método de envío')
                                ->options([
                                    'ups' => 'UPS',
                                    'fedex' => 'FedEx',
                                    'dhl' => 'DHL',
                                    'correos' => 'Correos'
                                ]),

                            Textarea::make('notes')
                                ->label('Notas')
                                ->columnSpanFull()
                        ])->columns(2),

                    Section::make('Order Items')
                        ->label('Productos del pedido')
                        ->schema([
                            Repeater::make('items')
                                ->label('Productos')
                                ->relationship()
                                ->schema([
                                    Select::make('product_id')
                                        ->label('Producto')
                                        ->relationship('product', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->distinct()
                                        ->disableOptionsWhenSelectedInSiblingRepeaterItems() //Esta linea deshabilita las opciones seleccionadas en otros elementos del repetidor
                                        ->columnSpan(4)
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, $set) {
                                            $set('unit_amount', Product::find($state)->price ?? 0);
                                        })
                                        ->afterStateUpdated(function ($state, $set) {
                                            $set('total_amount', Product::find($state)->price ?? 0);
                                        })
                                        ,

                                    TextInput::make('quantity')
                                        ->label('Cantidad')
                                        ->numeric()
                                        ->required()
                                        ->default(1)
                                        ->minValue(1)
                                        ->columnSpan(2)
                                        ->reactive()//Esta linea hace que el campo sea dependiente de otro campo
                                        ->afterStateUpdated(fn ($state, Set $set, Get $get) => $set('total_amount', $state*$get('unit_amount'))), //Esta linea actualiza el campo total_amount cuando el campo quantity cambia
                                        
                                    TextInput::make('unit_amount')
                                        ->label('Precio unitario')
                                        ->numeric()
                                        ->required()
                                        ->disabled()
                                        ->dehydrated() //Esta linea evita que el campo sea enviado al servidor
                                        ->columnSpan(3),

                                    TextInput::make('total_amount')
                                        ->label('Precio total')
                                        ->numeric()
                                        ->required()
                                        ->dehydrated()
                                        ->columnSpan(3),

                                ])->columns(12),
                                        Placeholder::make('grand_total_placeholder')
                                            ->label('Total a pagar')
                                            ->content(function (Get $get, Set $set) {
                                                $total = 0;
                                                if(!$repeaters = $get('items')) {
                                                    return $total;
                                                }
                                                

                                                foreach($repeaters as $key => $repeater) {
                                                    $total += $get(
                                                        "items.{$key}.total_amount"
                                                    );
                                                }
                                                $set('grand_total', $total);
                                                return Number::currency($total, 'EUR');
                                            }), //Esta funcion calcula el total a pagar

                                            Hidden::make('grand_total')
                                                ->default(0) //Esta linea establece el valor por defecto del campo grand_total
                                                
                                                
                        ])

                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Usuario')
                    ->searchable()
                    ->sortable(),

                    TextColumn::make('grand_total')
                    ->label('Total')
                    ->numeric()
                    ->money('EUR'),

                    TextColumn::make('payment_method')
                    ->label('Método de pago')
                    ->searchable()
                    ->sortable(),

                    TextColumn::make('payment_status')
                    ->label('Estado del pago')
                    ->searchable()
                    ->sortable(),

                    TextColumn::make('currency')
                    ->label('Moneda')
                    ->searchable()
                    ->sortable(),

                    TextColumn::make('shipping_method')
                    ->label('Método de envío')
                    ->searchable()
                    ->sortable(),

                    SelectColumn::make('status')
                    ->label('Estado del pedido')
                    ->options([
                        'new' => 'Nuevo',
                        'processing' => 'Procesando',
                        'shipped' => 'Enviado',
                        'delivered' => 'Entregado',
                        'canceled' => 'Cancelado',
                    ])
                    ->searchable()
                    ->sortable(),

                    TextColumn::make('updated_at')
                    ->label('Fecha de creación')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                    TextColumn::make('default_at')
                    ->label('Fecha de creación')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),


            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AddressRelationManager::class
        ];
    }

    //Esta funcion devuelve el badge de la navegacion
    public static function getNavegationBadge(): ?string
    {
        return static::getModel()::count();
    }

    //Esta funcion cambia el color del badge de la navegacion
    public static function getNavegationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 10 ? 'success' : 'danger';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
