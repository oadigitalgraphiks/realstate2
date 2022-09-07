<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class PropertyAmenity extends Model
{
    protected $table = "property_amenities";

    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $property_amenities_translation = $this->property_amenities_translation->where('lang', $lang)->first();
        return $property_amenities_translation != null ? $property_amenities_translation->$field : $this->$field;
    }
    
    public function property_amenities_translation(){
        return $this->hasMany(PropertyAmenityTranslation::class);
    }
    
    
    
}
