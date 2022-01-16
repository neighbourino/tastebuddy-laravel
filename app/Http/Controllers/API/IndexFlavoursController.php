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

        if($request->has('query')) {
            $flavours->where('name', 'LIKE', '%'.$request->get('query').'%');
        }

        $flavours = $flavours->get();

        $locale = (app()->getLocale()) ? app()->getLocale() : 'en';

        $data = $flavours->map(function($item){


            $locale = (app()->getLocale()) ? app()->getLocale() : 'en';

            $item->name_translated = $item->getTranslation('name', $locale);

            $item->description_translated = $item->getTranslation('description', $locale);

            $item->pairings = $item->pairings();



            return $item;
        });

        return $data;
    }
}
