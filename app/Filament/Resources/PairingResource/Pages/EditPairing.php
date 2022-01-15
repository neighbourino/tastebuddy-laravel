<?php

namespace App\Filament\Resources\PairingResource\Pages;

use App\Filament\Resources\PairingResource;
use Filament\Resources\Pages\EditRecord;

class EditPairing extends EditRecord
{

    use EditRecord\Concerns\Translatable;

    protected static string $resource = PairingResource::class;
}
