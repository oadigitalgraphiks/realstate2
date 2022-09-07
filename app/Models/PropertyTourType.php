<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class PropertyTourType extends Model
{
    protected $table = "property_tour_types";

    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $property_tour_types_translation = $this->property_tour_types_translation->where('lang', $lang)->first();
        return $property_tour_types_translation != null ? $property_tour_types_translation->$field : $this->$field;
    }
    
    public function property_tour_types_translation(){
        return $this->hasMany(PropertyTourTypeTranslation::class);
    }
    
    
    
    
}
