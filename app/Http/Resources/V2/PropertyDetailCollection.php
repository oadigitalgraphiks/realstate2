<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Models\PropertyAmenity;
use App\Models\PropertyCondition;
use App\Models\Country;
use App\Models\Product;
use App\Http\Resources\V2\RelatedPropertyCollection;

class PropertyDetailCollection extends ResourceCollection
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
                //             $item['path'] = uploaded_asset($photo_paths[$i]);
                //             array_push($gallary,$item['path']);
                //         }
                //     }
                // }

                $amenities = explode(',',$data->amenities);
                $conditions = explode(',',$data->conditions);
                $am = is_array($amenities) ? PropertyAmenity::whereIn('id',$amenities)->get()->toArray() : null;
                $con = is_array($conditions) ? PropertyCondition::whereIn('id',$conditions)->get()->toArray() : null;
                $unit_conversion = $data->property_unit != null ? $data->unit_value * $data->property_unit->conversion : null ;


                // related products
                $related_nested_area_products = [];

                if($data->nested_area){
                    $nested_area_products = Product::where('nested_area_id',$data->nested_area)->pluck('id')->toArray();
                    array_push($related_nested_area_products,$nested_area_products);
                }

                if($data->area){
                    $area_products = Product::where('area_id',$data->area_id)->pluck('id')->toArray();
                    array_push($related_nested_area_products,$area_products);
                }
                
                if($data->city){
                    $city_products = Product::where('city_id',$data->city_id)->pluck('id')->toArray();
                    array_push($related_nested_area_products,$city_products);
                }

               $location_merge = mergeArrayofArrays($related_nested_area_products);
               $location_merge = array_unique($location_merge);
               $relatedPro = Product::whereIn('id',$location_merge)->where('id','!=',$data->id)->get();
                // Related Products
            
                return [
                    'id' => $data->id,
                    'name' => $data->getTranslation('name'),
                    'slug' => $data->slug,
                    'description' =>$data->getTranslation('description'),
                    'meta_title' => $data->meta_title,
                    'meta_description' => $data->meta_description,
                    'longitude' => $data->longitude,
                    'latitude' => $data->latitude,
                    'reference' => $data->ref,
                    'sqft' => $unit_conversion,
                    'purpose' => $data->purpose,
                	'type' => $data->type,
                    'bed' => $data->bed,
                	'bath' => $data->bath,	 
                    'tour_type' => $data->tour_type,
                    'furnish_type' => $data->furnish_type,
                    'amenities' => $am,
                    'conditions' => $con,
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
                    'plans' => $data->plans,
                    'related' =>  new RelatedPropertyCollection($relatedPro),
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
