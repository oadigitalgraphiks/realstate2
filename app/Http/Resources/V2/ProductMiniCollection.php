<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Models\PropertyAmenity;
use App\Models\PropertyCondition;
use App\Models\Country;
use App\Models\Product;
use App\Http\Resources\V2\RelatedPropertyCollection;

class ProductMiniCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {

                $photo_paths = get_images_path($data->photos);
                $photos = [];
                $gallary = [];

                if (!empty($photo_paths)) {
                    for ($i = 0; $i < count($photo_paths); $i++) {
                        if ($photo_paths[$i] != "" ) {
                            $item = array();
                            $item['variant'] = "";
                            $item['path'] = uploaded_asset($photo_paths[$i]);

                            array_push($gallary,$item['path']);
                        }

                    }
                }

                $amenities = explode(',',$data->amenities);
                $conditions = explode(',',$data->conditions);
                $am = is_array($amenities) ? PropertyAmenity::whereIn('id',$amenities)->get()->toArray() : null;
                $con = is_array($conditions) ? PropertyCondition::whereIn('id',$conditions)->get()->toArray() : null;
                $unit_conversion = $data->property_unit != null ? $data->unit_value * $data->property_unit->conversion : null ;
                   
                $relatedPro = Product::where('name', 'like', '%'.$data->title.'%')->limit(4)->get();
                
                // dd($relatedPro);

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
                    'furnish_type' => $data->furnish_type,
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
                    'thumbnail_image' => uploaded_asset($data->thumbnail_img),
                    'photos' => $gallary,
                    'has_discount' => home_base_price($data, false) != home_discounted_base_price($data, false),
                    'stroked_price' => home_base_price($data),
                    'main_price' => home_discounted_base_price($data),
                    'rating' => (double) $data->rating,
                    'sales' => (integer) $data->num_of_sale,
                    'country' => ['id' => 299, 'title' => 'United Arab Emirates'],
                    'state' => $data->state,
                    'city' => $data->city,
                    'area' => $data->area,
                    'nested_area' => $data->nested_area,
                    'price' => number_format($data->unit_price,2),
                    'currency_symbol' => currency_symbol(),
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
