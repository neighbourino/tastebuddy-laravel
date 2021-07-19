<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;

class Flavour extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name', 'description'];

    public function pairings() {

        $flavourId = $this->id;
        $data = Pairing::where('primary_flavour_id', $this->id)->orWhere('secondary_flavour_id', $this->id)->get();

        $data = $data->map(function($item) use ($flavourId){


            $locale = (app()->getLocale()) ? app()->getLocale() : 'en';

            $item->name =
                (Flavour::find($item->primary_flavour_id)->getTranslation('name', $locale))
                . ' + ' .
                (Flavour::find($item->secondary_flavour_id)->getTranslation('name', $locale));

            #$item->description_translated = (Pairing::find($flavourId)->getTranslation('description', $locale));


            return $item;
        });



        return $data;
    }

}
