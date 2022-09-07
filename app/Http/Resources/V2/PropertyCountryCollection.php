<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Illuminate\Support\Str;
use App\Models\Product;

class PropertyCountryCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {

               return [
                    'count' => count($data->publish),
                    'id' => $data->id,
                    'title' => $data->name,
                    'slug' => $data->slug,
                    'code' => $data->code,
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