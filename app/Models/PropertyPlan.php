<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyPlan extends Model
{
    protected $table = "property_plans";
    
    public function property(){
        $this->belongsTo(Product::class, 'property_id', 'id');
    }
    
}
