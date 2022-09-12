<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class PropertyUnit extends Model
{
    protected $table = "property_units";
    
    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $property_unit_translation = $this->property_unit_translations->where('lang', $lang)->first();
        return $property_unit_translation != null ? $property_unit_translation->$field : $this->$field;
    }

    public function property_unit_translations(){
    	return $this->hasMany(PropertyUnitTranslation::class);
    }
    
}
