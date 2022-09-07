<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\PropertyAmenityCollection;
use App\Models\PropertyAmenity;
use Cache;


class PropertyAmenityController extends Controller
{

    public function index($parent_id = 0)
    {
        
        return new PropertyAmenityCollection(PropertyAmenity::paginate(10));
        // return Cache::remember("app.categories-$parent_id", 86400, function() use ($parent_id){
        //     return new CategoryCollection(Category::where('parent_id', $parent_id)->get());
        // });
    }

    
   

   
}
