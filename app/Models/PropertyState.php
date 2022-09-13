<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyState extends Model
{
    protected $table = "property_states";
    
    protected $guarded = [];

    public function city()
    {
        return $this->hasMany(PropertyCity::class,'state_id','id');
    }

    public function country(){
        return $this->belongsTo(PropertyCountry::class, 'country_id', 'id');
    }


    public function products(){
    	return $this->hasMany(Product::class, 'state_id');
    }

    public function publish() {
        return $this->products()->where('published', 1);
    }
    
    
}
