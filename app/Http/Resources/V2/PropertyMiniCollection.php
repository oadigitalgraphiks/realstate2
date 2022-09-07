<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Models\PropertyAmenity;
use App\Models\PropertyCondition;
use App\Models\Country;
use App\Models\Product;
use App\Http\Resources\V2\RelatedPropertyCollection;

class PropertyMiniCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {

                // $photo_paths = get_images_path($data->photos);
                $gallary = [];
                array_push($gallary,asset('public/uploads/properties/'.rand(1,40).'.jpg'));
                array_push($gallary,asset('public/uploads/properties/'.rand(1,40).'.jpg'));
                array_push($gallary,asset('public/uploads/properties/'.rand(1,40).'.jpg'));
                array_push($gallary,asset('public/uploads/properties/'.rand(1,40).'.jpg'));
                array_push($gallary,asset('public/uploads/properties/'.rand(1,40).'.jpg'));
                // if (!empty($photo_paths)) {
                //     for ($i = 0; $i < count($photo_paths); $i++) {
                //         if ($photo_paths[$i] != "" ) {
                //             $item = array();
                //             $item['variant'] = "";
                //             $item['path'] = uploaded_asset($photo_paths[$i]);
                //             array_push($gallary,$item['path']);
                //         }
                //     }
                // }

                $unit_conversion = $data->property_unit != null ? $data->unit_value * $data->property_unit->conversion : null ;
                   
                return [
                    'id' => $data->id,
                    'name' => $data->getTranslation('name'),
                    'slug' => $data->slug,
                    'meta_description' => $data->meta_description,
                    'longitude' => $data->longitude,
                    'latitude' => $data->latitude,
                    'reference' => $data->ref,
                    'sqft' => $unit_conversion,
                    'furnish_type' => $data->furnish_type,
                    'purpose' => $data->purpose,
                    'purpose_child' => $data->purpose_child,
                	'type' => $data->type,
                    'bed' => $data->bed,
                	'bath' => $data->bath,	 
                    'tour_type' => $data->tour_type,
                    'tags' => explode(',', $data->tags),
                    'vendor' => $data->user,
                    'thumbnail_image' => asset('public/uploads/properties/'.rand(1,40).'.jpg'),
                    'photos' => $gallary,
                    'country' => $data->country,
                    'state' => $data->state,
                    'city' => $data->city,
                    'area' => $data->area,
                    'nested_area' => $data->nested_area,
                    'price' => number_format($data->unit_price,2),
                    'currency_symbol' => currency_symbol(),
                    'links' => [
                        'details' => route('products.show', $data->id),
                    ]
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
