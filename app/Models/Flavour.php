<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Flavour extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    protected $guarded = [];

    public $translatable = ['name', 'description'];

    /*public function pairings() {

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
    }*/

    /*public function pairings()
    {
        return $this->belongsToMany(Pairing::class);
    }*/

    /*public function pairings()
    {
        return $this->belongsToMany(Flavour::class, 'pairings', 'primary_flavour_id', 'secondary_flavour_id');
    }*/

    public function pairings() {

        $flavourId = $this->id;
        $data = Pairing::where('primary_flavour_id', $this->id)->orWhere('secondary_flavour_id', $this->id)->get();

        $data = $data->map(function($item) use ($flavourId){


            $locale = (app()->getLocale()) ? app()->getLocale() : 'en';

            $primaryFlavour = Flavour::find($item->primary_flavour_id);
            $secondaryFlavour = Flavour::find($item->secondary_flavour_id);

            $item->name = $primaryFlavour->getTranslation('name', $locale) . ' + ' . $secondaryFlavour->getTranslation('name', $locale);

            $item->name_translated = $primaryFlavour->getTranslation('name', $locale) . ' + ' . $secondaryFlavour->getTranslation('name', $locale);


            $item->description_translated = (Pairing::find($item->id)->getTranslation('description', $locale));

            $item->primary_featured_image = '';
            $item->primary_thumbnail = '';

            $primaryFlavourImage = $primaryFlavour->getMedia('featured_images')->first();
            if ($primaryFlavourImage){
                $item->primary_featured_image = $primaryFlavourImage->getFullUrl();
                $item->primary_thumbnail = $primaryFlavourImage->getUrl('thumbnail');
            }

            $item->secondary_featured_image = '';
            $item->secondary_thumbnail = '';

            $secondaryFlavourImage = $secondaryFlavour->getMedia('featured_images')->first();
            if ($secondaryFlavourImage){
                $item->secondary_featured_image = $secondaryFlavourImage->getFullUrl();
                $item->secondary_thumbnail = $secondaryFlavourImage->getUrl('thumbnail');
            }

            return $item;
        });

        return $data;
    }


    public function registerMediaCollections() : void
    {
        //$this->addMediaCollection('thumbnail')->singleFile();
        //$this->addMediaCollection('flavours')->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->width(250)
            ->height(250)
            ->sharpen(10);
    }
}
