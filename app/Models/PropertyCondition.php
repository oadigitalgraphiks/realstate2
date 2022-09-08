<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App;

class PropertyCondition extends Model
{
    
    protected $table = "property_conditions";   

    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $property_condition_translation = $this->property_condition_translations->where('lang', $lang)->first();
        return $property_condition_translation != null ? $property_condition_translation->$field : $this->$field;
    }

    public function property_condition_translations(){
    	return $this->hasMany(PropertyConditionTranslation::class);
    }
}


