<?php

namespace App\Filament\Resources\PairingResource\Pages;

use App\Filament\Resources\PairingResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePairing extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = PairingResource::class;
}
