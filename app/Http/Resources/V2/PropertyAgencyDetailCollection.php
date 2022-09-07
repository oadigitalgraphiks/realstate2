<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PropertyAgencyDetailCollection extends ResourceCollection
{
    public function toArray($request)
    {
        
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'slug' => $data->slug,
                    'logo' => api_asset($data->logo),
                    'description' => $data->meta_description,
                    'images' => get_images_path($data->sliders),
                    'address' => $data->address,
                    'total_agents' => null,
                    'services_areas' => null,
                    'property_types' => 'Apartments',
                    'properties_for' => 'Rent', 
                    'user_id' => intval($data->user_id),
                    'teams' => $data->teams,
                    'facebook' => $data->facebook,
                    'google' => $data->google,
                    'twitter' => $data->twitter,
                    'true_rating' => (double) $data->user->seller->rating,
                    'rating' => (double) $data->user->seller->rating
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

    protected function convertPhotos($data){
        $result = array();
        foreach ($data as $key => $item) {
            array_push($result, api_asset($item));
        }
        return $result;
    }
}
