<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Flavour;
use Illuminate\Http\Request;

class ShowFlavourController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $flavour = Flavour::findOrFail($id);

        $locale = (app()->getLocale()) ? app()->getLocale() : 'en';

        $flavour->name_translated = $flavour->getTranslation('name', $locale);

        $flavour->description_translated = $flavour->getTranslation('description', $locale);

        $flavour->pairings = $flavour->pairings();

        return $flavour;
    }
}
