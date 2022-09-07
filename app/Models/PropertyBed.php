<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App;

class PropertyBed extends Model
{
    protected $table = "property_beds";
    
    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $property_bed_translation = $this->property_bed_translations->where('lang', $lang)->first();
        return $property_bed_translation != null ? $property_bed_translation->$field : $this->$field;
    }

    public function property_bed_translations(){
    	return $this->hasMany(PropertyBedTranslation::class);
    }
    
    
}
