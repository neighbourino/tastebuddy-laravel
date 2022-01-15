<?php

namespace App\Filament\Resources\FlavourResource\Pages;

use App\Filament\Resources\FlavourResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFlavour extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = FlavourResource::class;
}
