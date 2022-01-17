<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlavourResource\Pages;
use App\Filament\Resources\FlavourResource\RelationManagers;
use App\Models\Flavour;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class FlavourResource extends Resource
{

    use Translatable;

    protected static ?string $model = Flavour::class;

    protected static ?string $navigationIcon = 'heroicon-o-database';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')->required(),
                        Textarea::make('description')
                            ->rows(10)
                            ->cols(20),
                        // Forms\Components\BelongsToManyMultiSelect::make('pairings')->relationship('pairings', 'name'),
                        SpatieMediaLibraryFileUpload::make('featured_image')->collection('featured_images'),
                    ])
                    ->columns(1)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable(),
                SpatieMediaLibraryImageColumn::make('featured_image')->collection('featured_images')->conversion('thumbnail'),
                TextColumn::make('created_at')->dateTime()
            ])
            ->filters([
                //
            ])->defaultSort('name');
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
            'index' => Pages\ListFlavours::route('/'),
            'create' => Pages\CreateFlavour::route('/create'),
            'edit' => Pages\EditFlavour::route('/{record}/edit'),
        ];
    }

    public static function getTranslatableLocales(): array
    {
        return ['en', 'da'];
    }
}
