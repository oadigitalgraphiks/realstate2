<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class PropertyPurpose extends Model
{
    protected $table = "property_purposes";

    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $property_purpose_translation = $this->property_purpose_translations->where('lang', $lang)->first();
        return $property_purpose_translation != null ? $property_purpose_translation->$field : $this->$field;
    }

    public function property_purpose_translations(){
    	return $this->hasMany(PropertyPurposeTranslation::class);
    }

    public function property_purposes()
    {
        return $this->hasMany(PropertyPurpose::class, 'parent_id');
    }
   
    public function parent()
    {
        return $this->belongsTo(PropertyPurpose::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(PropertyPurpose::class, 'parent_id');
    }
    
}
