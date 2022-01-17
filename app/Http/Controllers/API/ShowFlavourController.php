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

        $flavour->featured_image = '';
        $flavour->thumbnail = '';
        $image = $flavour->getMedia('flavours')->first();

        if ($image){
            $flavour->featured_image = $image->getFullUrl();
            $flavour->thumbnail = $image->getUrl('thumbnail');
        }

        $flavour->primary_featured_image = '';
        $flavour->primary_thumbnail = '';

        $flavour->secondary_featured_image = '';
        $flavour->secondary_thumbnail = '';

        $flavour->pairings = $flavour->pairings();

        return $flavour;
    }
}
