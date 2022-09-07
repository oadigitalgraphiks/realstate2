<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class PropertyBath extends Model
{
    protected $table = "property_baths";

    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $property_bath_translation = $this->property_bath_translations->where('lang', $lang)->first();
        return $property_bath_translation != null ? $property_bath_translation->$field : $this->$field;
    }
    
    public function property_bath_translations(){
        return $this->hasMany(PropertyBathTranslation::class);
    }

}