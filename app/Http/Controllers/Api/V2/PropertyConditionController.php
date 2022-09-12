<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\PropertyConditionCollection;
use App\Models\PropertyCondition;
use Cache;

class PropertyConditionController extends Controller
{

    public function index( )
    {
        return new PropertyConditionCollection(PropertyCondition::paginate(10));
        
        // return Cache::remember("app.categories-$parent_id", 86400, function() use ($parent_id){
        //     return new CategoryCollection(Category::where('parent_id', $parent_id)->get());
        // });
    }

    
  
}