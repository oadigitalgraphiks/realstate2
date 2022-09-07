<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyAmenityTranslation extends Model
{
    protected $fillable = ['name', 'lang', 'property_amenity_id'];

    public function property_amenity(){
    	return $this->belongsTo(PropertyAmenity::class);
    }
}
