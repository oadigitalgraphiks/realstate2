<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyTourTypeTranslation extends Model
{
    protected $fillable = ['name', 'lang', 'property_tour_type_id'];

    public function property_tour_type(){
    	return $this->belongsTo(PropertyTourType::class);
    }
}
