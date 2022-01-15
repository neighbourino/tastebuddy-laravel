<?php

namespace App\Filament\Resources\FlavourResource\Pages;

use App\Filament\Resources\FlavourResource;
use Filament\Resources\Pages\EditRecord;

class EditFlavour extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = FlavourResource::class;
}
