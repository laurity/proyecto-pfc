<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AddressRelationManager extends RelationManager
{
    protected static string $relationship = 'address';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('first_name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),

                    TextInput::make('last_name')
                    ->label('Apellidos')
                    ->required()
                    ->maxLength(255),

                    TextInput::make('phone')
                    ->label('Teléfono')
                    ->required()
                    ->tel()
                    ->maxLength(20),

                    TextInput::make('city')
                    ->label('Ciudad')
                    ->required()
                    ->maxLength(255),

                    TextInput::make('province')
                    ->label('Provincia')
                    ->required()
                    ->maxLength(255),

                    TextInput::make('postal_code')
                    ->label('Código Postal')
                    ->required()
                    ->numeric()
                    ->rule('digits:5'),



                Textarea::make('street_address')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('street_address')
            ->columns([
                TextColumn::make('fullname')
                ->label('Nombre Completo') ,

                TextColumn::make('phone')
                ->label('Teléfono'),

                TextColumn::make('city')
                ->label('Ciudad'),

                TextColumn::make('province')
                ->label('Provincia'),

                TextColumn::make('postal_code')
                ->label('Código Postal'),

                TextColumn::make('street_address')
                ->label('Dirección'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
