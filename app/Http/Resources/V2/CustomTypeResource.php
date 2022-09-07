<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\JsonResource;


class CustomTypeResource extends JsonResource
{
   /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->attribute->id,
            'title' => $this->attribute->type->name,
            'icon' => $this->attribute->type->icon,
            'value' =>  $this->attribute->name,
        ];
    }

}
