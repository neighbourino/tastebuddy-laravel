<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Flavour;
use App\Models\Pairing;
use Illuminate\Http\Request;

class ShowFlavourPairingController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
       $flavourPairing = Pairing::findOrFail($id);

        $locale = (app()->getLocale()) ? app()->getLocale() : 'en';

        $flavourPairing->name_translated =
            (Flavour::find($flavourPairing->primary_flavour_id)->getTranslation('name', $locale))
            . ' + ' .
            (Flavour::find($flavourPairing->secondary_flavour_id)->getTranslation('name', $locale));

        $flavourPairing->description_translated = $flavourPairing->getTranslation('description', $locale);

        return $flavourPairing;
    }
}
