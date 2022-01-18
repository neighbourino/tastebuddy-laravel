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

        $primaryFlavour = Flavour::find($flavourPairing->primary_flavour_id);
        $secondaryFlavour = Flavour::find($flavourPairing->secondary_flavour_id);

        $flavourPairing->name_translated = $primaryFlavour->getTranslation('name', $locale) . ' + ' . $secondaryFlavour->getTranslation('name', $locale);
        $flavourPairing->description_translated = $flavourPairing->getTranslation('description', $locale);


        $primaryFlavour->name_translated = $primaryFlavour->getTranslation('name', $locale);
        $primaryFlavour->description_translated = $primaryFlavour->getTranslation('description', $locale);
        $flavourPairing->primary_flavour = $primaryFlavour;


        $secondaryFlavour->name_translated = $secondaryFlavour->getTranslation('name', $locale);
        $secondaryFlavour->description_translated = $secondaryFlavour->getTranslation('description', $locale);
        $flavourPairing->secondary_flavour = $secondaryFlavour;


        return $flavourPairing;
    }
}
