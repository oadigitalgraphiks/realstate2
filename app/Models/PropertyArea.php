<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyArea extends Model
{
    protected $table = "property_areas";
    protected $guarded = [];

    
    public function city()
    {
        return $this->belongsTo(PropertyCity::class,'city_id','id');
    }

    public function nested()
    {
        return $this->hasMany(PropertyNestedArea::class,'parent_id','id');
    }

    public function products(){
    	return $this->hasMany(Product::class, 'area_id');
    }

    public function publish() {
        return $this->products()->where('published', 1);
    }
    
    
}