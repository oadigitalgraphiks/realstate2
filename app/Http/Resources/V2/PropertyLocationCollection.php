<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\PropertyType;
use App\Models\PropertyPurpose;
use App\Models\Product;




// $products = Product::where('country_id',299)->get();

class PropertyLocationCollection extends ResourceCollection
{
    public function toArray($request)
    {

        $typeIdz = [];
        $purpose = PropertyPurpose::where('slug',$request->purpose)->first()->id;

        if($request->has('type') && $request->type != ''){
            $type = PropertyType::where('slug',$request->type)->first();
            if($type){
                if($type->parent_id == 0){
                    foreach ($type->children()->get() as $value) {  
                        array_push($typeIdz,$value->id);
                    }
                }else{
                    array_push($typeIdz,$type->id);
                }
            }
        }
        
    
        return [
               'data' => $this->collection->map(function($data) use($typeIdz,$purpose) {
       
                return [
                        'count' => count( count($typeIdz) > 0 ? $data->products->whereIn('type_id',$typeIdz)->where('purpose_id',$purpose) : $data->products->where('purpose_id',$purpose) ),
                        'id' => $data->id,
                        'title' => $data->name,
                        'slug' => $data->orignal_slug,
                       ];
            })
        ];
    }

    public function with($request)
    {
    
        return [
            'success' => true,
            'status' => 200
        ];
    }
}