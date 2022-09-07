<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyNestedArea extends Model
{
    protected $table = "property_nested_areas";
    protected $guarded = [];

    
    public function area()
    {
        return $this->belongsTo(PropertyArea::class,'parent','id');
    }

    public function products(){

    	return $this->hasMany(Product::class, 'nested_area_id');
    }

     // results in a "problem", se examples below
     public function publish() {
        return $this->products()->where('published', 1);
    }
    
    
}