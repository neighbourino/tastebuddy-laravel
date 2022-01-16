<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Pairing extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [];

    public $translatable = ['name', 'description'];

    public function primary_flavour() {
        return $this->belongsTo(Flavour::class,'primary_flavour_id');
    }

    public function secondary_flavour() {
        return $this->belongsTo(Flavour::class, 'secondary_flavour_id');
    }

    public function getNameAttribute($value)
    {

        $locale = (app()->getLocale()) ? app()->getLocale() : 'en';

        return
            (Flavour::find($this->primary_flavour_id)->getTranslation('name', $locale))
            . ' + ' .
            (Flavour::find($this->secondary_flavour_id)->getTranslation('name', $locale));
    }

    public function flavours() {

        return $this->belongsToMany(Flavour::class);
    }
}
