<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PairingResource\Pages;
use App\Filament\Resources\PairingResource\RelationManagers;
use App\Models\Pairing;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Resources\Concerns\Translatable;

class PairingResource extends Resource
{

    use Translatable;

    protected static ?string $model = Pairing::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                //Forms\Components\TextInput::make('name')->disabled(),
                BelongsToSelect::make('primary_flavour_id')->relationship('primary_flavour', 'name'),
                BelongsToSelect::make('secondary_flavour_id')->relationship('secondary_flavour', 'name'),
                        Forms\Components\Textarea::make('description')
                            ->rows(10)
                            ->cols(20),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()
            ])
            ->filters([
                //
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
            'index' => Pages\ListPairings::route('/'),
            'create' => Pages\CreatePairing::route('/create'),
            'edit' => Pages\EditPairing::route('/{record}/edit'),
        ];
    }

    public static function getTranslatableLocales(): array
    {
        return ['en', 'da'];
    }
}
