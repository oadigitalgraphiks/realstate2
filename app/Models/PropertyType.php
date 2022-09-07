<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class PropertyType extends Model
{
    protected $table = "property_types";
    
    public function children()
    {
        return $this->hasMany(PropertyType::class, 'parent_id');
    }

    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $property_type_translation = $this->property_type_translations->where('lang', $lang)->first();
        return $property_type_translation != null ? $property_type_translation->$field : $this->$field;
    }

    public function property_type_translations(){
    	return $this->hasMany(PropertyTypeTranslation::class);
    }

    public function property_types()
    {
        return $this->hasMany(PropertyType::class, 'parent_id');
    }

    public function childrenProperties()
    {
        return $this->hasMany(PropertyType::class, 'parent_id')->with('property_types');
    }

    public function parent()
    {
        return $this->belongsTo(PropertyType::class, 'parent_id');
    
    }

      
}