<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Models\PropertyAmenity;


class RelatedPropertyCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {

        
                $amenities = explode(',',$data->amenities);
                $am = is_array($amenities) ? PropertyAmenity::whereIn('id',$amenities)->get()->toArray() : null;
                $unit_conversion = $data->property_unit != null ? $data->unit_value * $data->property_unit->conversion : null ;
                   
                return [
                    'id' => $data->id,
                    'name' => $data->getTranslation('name'),
                    'slug' => $data->slug,
                    'reference' => $data->ref,
                    'sqft' => $unit_conversion,
                    'furnish_type' => $data->furnish_type,
                    'purpose' => $data->purpose,
                	'type' => $data->type,
                    'bed' => $data->bed,
                	'bath' => $data->bath,	 
                    'amenities' => $am,
                    'vendor' => $data->user,
                    'thumbnail_image' => uploaded_asset($data->thumbnail_img),
                    'country' => ['id' => 299, 'title' => 'United Arab Emirates'],
                    'state' => $data->state,
                    'city' => $data->city,
                    'area' => $data->area,
                    'nested_area' => $data->nested_area,
                    'price' => number_format($data->unit_price,2),
                    'currency_symbol' => currency_symbol(),
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
