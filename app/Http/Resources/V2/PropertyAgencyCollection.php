<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\ResourceCollection;
use \App\Models\Product;

class PropertyAgencyCollection extends ResourceCollection
{
    public function toArray($request)
    {


        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'user_id' => intval($data->user_id) ,
                    'name' => $data->name,
                    'slug' => $data->slug,
                    'logo' => api_asset($data->logo),
                    'type' => $data->type,      
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
