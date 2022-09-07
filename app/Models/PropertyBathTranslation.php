<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyBathTranslation extends Model
{
    protected $fillable = ['name', 'lang', 'property_bath_id'];

    public function property_bath(){
    	return $this->belongsTo(PropertyBath::class);
    }
}
