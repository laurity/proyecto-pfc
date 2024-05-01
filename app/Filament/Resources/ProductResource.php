<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Información del producto')->schema([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(
                                function (string $operation, $state, Set $set) {
                                    if ($operation !== 'create') {
                                        return;
                                    }

                                    $set('slug', Str::slug($state));
                                }
                            ), //Esta linea permite que el slug se genere automaticamente

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Product::class, 'slug', ignoreRecord: true),

                        MarkdownEditor::make('description')
                            ->label('Descripción')
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('products')
                    ])->columns(2),

                    Section::make('Images')->schema([
                        FileUpload::make('images')
                            ->label('Imagenes')
                            ->multiple()
                            ->directory('products')
                            ->maxFiles(5)
                            ->reorderable() //Esta linea permite reordenar las imagenes
                           

                    ])
                ])->columnSpan(2),

                Group::make()->schema([
                    Section::make('Precio')->schema([
                        TextInput::make('price')
                            ->label('Precio')
                            ->required()
                            ->type('number')
                            ->step('0.01')
                            ->minValue('0.01')
                            ->prefix('EUR')
                    ]),

                    Section::make('Asociaciones')->schema([
                        Select::make('category_id')
                            ->label('Categoría')
                            ->searchable()
                            ->required()
                            ->preload() //Esta linea permite cargar todas las categorias
                            ->relationship('category', 'name'),

                        Select::make('brand_id')
                            ->label('Marca')
                            ->searchable()
                            ->required()
                            ->preload()
                            ->relationship('brand', 'name'),

                    ]),

                    Section::make('Estado')
                    ->schema([
                        Toggle::make('in_stock')
                            ->label('En stock')
                            ->required()
                            ->default(true),

                        Toggle::make('is_active')
                            ->label('Activo')
                            ->required()
                            ->default(true),

                        Toggle::make('is_featured')
                            ->label('Destacado')
                            ->required(),

                        Toggle::make('on_sale')
                            ->label('En oferta')
                            ->required()

                    ])

                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),

                TextColumn::make('category.name')
                    ->sortable()
                    ->label('Categoría'),

                TextColumn::make('brand.name')
                    ->sortable()
                    ->label('Marca'),

                TextColumn::make('price')
                    ->label('Precio')
                    ->sortable()
                    ->money('EUR'),

                IconColumn::make('is_featured')
                    ->label('Destacado')
                    ->boolean(),

                IconColumn::make('in_stock')
                    ->label('En stock')
                    ->boolean(),
                IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),

                IconColumn::make('on_sale')
                    ->label('En oferta')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Fecha de creación')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Fecha de actualización')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->label('Categoría'),

                SelectFilter::make('brand')
                    ->relationship('brand', 'name')
                    ->label('Marca'),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
