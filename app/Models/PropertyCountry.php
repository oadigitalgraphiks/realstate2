<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyCountry extends Model
{

    protected $table = "property_countries";

    //
    public function products(){
    	return $this->hasMany(Product::class, 'country_id');
    }

    public function publish() {
        return $this->products()->where('published', 1);
    }

    public function states(){
    	return $this->hasMany(PropertyState::class, 'country_id');
    }
}
