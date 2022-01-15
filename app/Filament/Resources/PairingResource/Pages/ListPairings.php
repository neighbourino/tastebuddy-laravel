<?php

namespace App\Filament\Resources\PairingResource\Pages;

use App\Filament\Resources\PairingResource;
use Filament\Resources\Pages\ListRecords;

class ListPairings extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = PairingResource::class;
}
