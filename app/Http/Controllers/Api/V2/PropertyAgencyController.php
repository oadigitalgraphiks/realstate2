<?php

namespace App\Http\Controllers\Api\V2;

use Cache;
use App\Models\User;
use App\Models\Shop;
use App\Models\PropertyTeam;
use App\Http\Resources\V2\PropertyAgencyDetailCollection;
use App\Http\Resources\V2\PropertyAgencyCollection;

class PropertyAgencyController extends Controller
{

    public function CreateProperty(Request $request)
    {

        // 'id' => $data->id,
        // 'name' => $data->getTranslation('name'),
        // 'slug' => $data->slug,
        // 'description' =>$data->getTranslation('description'),
        // 'meta_title' => $data->meta_title,
        // 'meta_description' => $data->meta_description,
        // 'longitude' => $data->longitude,
        // 'latitude' => $data->latitude,
        // 'reference' => $data->ref,
        // 'sqft' => $unit_conversion,
        // 'purpose' => $data->purpose,
        // 'type' => $data->type,
        // 'bed' => $data->bed,
        // 'bath' => $data->bath,	 
        // 'tour_type' => $data->tour_type,
        // 'furnish_type' => $data->furnish_type,
        // 'amenities' => $am,
        // 'conditions' => $con,
        // 'tags' => explode(',', $data->tags),
        // 'vendor' => $data->user,
        // 'thumbnail_image' => asset('public/uploads/properties/'.rand(1,40).'.jpg'),
        // 'photos' => $gallary,
        // 'country' => $data->country,
        // 'state' => $data->state,
        // 'city' => $data->city,
        // 'area' => $data->area,
        // 'nested_area' => $data->nested_area,
        // 'price' => number_format($data->unit_price,2),
        // 'currency_symbol' => currency_symbol(),
        // 'plans' => $data->plans,
        // 'related' =>  new RelatedPropertyCollection($relatedPro),
        // 'links' => [
        //     'details' => route('products.show', $data->id),
        // ]

        // $validator = Validator::make($request->all(),[
        //     'name' => 'required|string',
        //     'slug' => 'required|string|email|unique:users,email',
        //     'description' => 'required|string|unique:users,phone',
        //     'longitude' => $data->longitude,
        //     'latitude' => $data->latitude,
        //     'reference' => $data->ref,
            // 'sqft' => $unit_conversion,
            // 'purpose' => $data->purpose,
            // 'type' => $data->type,
            // 'bed' => $data->bed,
            // 'bath' => $data->bath,	 
            // 'tour_type' => $data->tour_type,
            // 'furnish_type' => $data->furnish_type,
            // 'amenities' => $am,
            // 'conditions' => $con,
            // 'tags' => explode(',', $data->tags),


            
            'password' => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:6',
            'remember_me' => 'boolean',
            'type' => 'required|string',
            'terms' => 'required|string',
            'notification' => 'required|string',
         ]);

        //  if($validator->fails()){
        //     return response()->json([
        //      'message' => 'Validation Failed',
        //      'errors' => $validator->messages(),
        //     ],401);
        //  } 


               
        
        return true; 
    }




    public function index()
    {
        $shops = Shop::all();
        return new PropertyAgencyCollection($shops); 
    }

    public function featured()
    {
        $shops = Shop::where('featured',1)->get();
        return new PropertyAgencyCollection($shops); 
    }

    public function get($slug){
       $shops = Shop::where('slug',$slug)->get();
        if($shops){
     
            return new PropertyAgencyDetailCollection($shops);
        }
    }


    public function team($slug){
        
        $team = PropertyTeam::where('slug',$slug)->first();
        if($team){
         return response()->json($team);
        }

        return response()->json([
            'message' => 'Not Found'
        ],401);
        
     }



 
}