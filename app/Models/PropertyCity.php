<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyCity extends Model
{
    protected $table = "property_cities";
    protected $guarded = [];

    
    public function state()
    {
        return $this->belongsTo(PropertyState::class,'state_id','id');
    }

    public function area()
    {
        return $this->hasMany(PropertyArea::class,'city_id','id');
    }

    public function products(){
    	return $this->hasMany(Product::class, 'city_id');
    }

    public function publish() {
        return $this->products()->where('published', 1);
    }
    
}