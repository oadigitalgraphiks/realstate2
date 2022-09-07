<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyTypeTranslation extends Model
{
    protected $fillable = ['name', 'lang', 'property_type_id'];

    public function property_type(){
    	return $this->belongsTo(PropertyType::class);
    }
}
