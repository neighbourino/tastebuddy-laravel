<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Flavour;
use Illuminate\Http\Request;

class IndexFlavoursController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $flavours = Flavour::query();

        if($request->has('query') && trim($request->get('query')) != '') {
            $flavours->where('name', 'LIKE', '%'.$request->get('query').'%');
        }

        $flavours = $flavours->get();

        $locale = (app()->getLocale()) ? app()->getLocale() : 'en';

        $data = $flavours->map(function($item){


            $locale = (app()->getLocale()) ? app()->getLocale() : 'en';

            $item->name_translated = $item->getTranslation('name', $locale);

            $item->description_translated = $item->getTranslation('description', $locale);

            $item->pairings = $item->pairings();

            $item->featured_image = '';
            $item->thumbnail = '';

            $item->primary_featured_image = '';
            $item->primary_thumbnail = '';

            $item->secondary_featured_image = '';
            $item->secondary_thumbnail = '';

            $image = $item->getMedia('featured_images')->first();

            if ($image){

                $item->featured_image = $image->getFullUrl();
                $item->thumbnail = $image->getUrl('thumbnail');
            }


            return $item;
        });

        $sorted = $data->sortBy('name');

        return $sorted->values();
    }
}
