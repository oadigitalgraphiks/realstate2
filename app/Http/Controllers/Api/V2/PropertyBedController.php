<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\PropertyBedCollection;
use App\Models\PropertyBed;
use Cache;

class PropertyBedController extends Controller
{

    public function index($parent_id = 0)
    {
        // if(request()->has('parent_id') && is_numeric (request()->get('parent_id'))){
        //   $parent_id = request()->get('parent_id');
        // }
        
        return new PropertyBedCollection(PropertyBed::paginate(10));
        
        // return Cache::remember("app.categories-$parent_id", 86400, function() use ($parent_id){
        //     return new CategoryCollection(Category::where('parent_id', $parent_id)->get());
        // });
    }

    
   

   
}
