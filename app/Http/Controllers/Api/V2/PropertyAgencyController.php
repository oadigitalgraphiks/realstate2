<?php

namespace App\Http\Controllers\Api\V2;

use Cache;
use App\Models\User;
use App\Models\Shop;
use App\Models\PropertyTeam;
use App\Http\Resources\V2\PropertyAgencyDetailCollection;
use App\Http\Resources\V2\PropertyAgencyCollection;
use Validator;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\V2\PropertyDetailCollection;

class PropertyAgencyController extends Controller
{

    public function createProperty(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|string',
            'slug' => 'required|string',
            'meta_description' => 'required|string',
            'price' => 'required|integer',
            'reference' => 'required|string',
            'sqft' =>  'required|integer',
            'purpose' => 'required|integer|exists:property_purposes,id',
            'purpose_child' => 'required|integer|exists:property_purposes,id',
            'type' => 'required|integer|exists:property_types,id',
            'meta_title' => 'string',
            'description' => 'string',
            'longitude' => 'string',
            'latitude' => 'string',
            'bed' => 'integer|exists:property_beds,id',
            'bath' => 'integer|exists:property_baths,id',	 
            'tour_type' => 'integer|exists:property_tour_types,id',	
            'furnish_type' => 'integer|exists:property_furnish_types,id',	
            'amenities' => 'string',
            'conditions' => 'string',
            'tags' => 'string',
            'thumbnail_image' => 'string',
            'photos' => 'string',
            'country' => 'integer|exists:property_areas,id',
            'state' => 'integer|exists:property_states,id',
            'city' => 'integer|exists:property_cities,id',
            'area' =>  'integer|exists:property_areas,id',	
            'nested_area' =>  'integer|exists:property_nested_areas,id',	
         ]);

         if($validator->fails()){
            return response()->json([
             'message' => 'Validation Failed',
             'errors' => $validator->messages(),
            ],401);
         }

         $user = $request->user();

         $data = [
            'name' => $request->title,
            'slug' => $request->slug,
            'meta_title' => $request->title,
            'meta_description' => $request->meta_description,
            'unit_price' => $request->price,
            'ref' => $request->reference,
            'search_sqft' => $request->sqft,
            'purpose_id' => $request->purpose,
            'purpose_child_id' => $request->purpose_child,
            'type_id' => $request->type,
            'user_id' => $user->id,
            'colors' => '[]',
            'choice_options' => '[]',
         ];

         if($request->has('description')){
            $data['description'] = $request->description;
         }

         if($request->has('longitude')){
            $data['longitude'] = $request->longitude;
         }

         if($request->has('latitude')){
            $data['latitude'] = $request->latitude;
         }

         if($request->has('bed')){
            $data['bed_id'] = $request->bed;
         }

         if($request->has('bath')){
            $data['bath_id'] = $request->bed;
         }

         if($request->has('tour_type')){
            $data['tour_type_id'] = $request->tour_type;
         }

         if($request->has('furnish_type')){
            $data['furnish_type_id'] = $request->furnish_type;
         }

         if($request->has('amenities')){
            $data['amenities'] = $request->amenities;
         }

         if($request->has('conditions')){
            $data['conditions'] = $request->conditions;
         }

         if($request->has('tags')){
            $data['tags'] = $request->tags;
         }

         if($request->has('thumbnail_image')){
            $data['thumbnail_image'] = $request->thumbnail_image;
         }

         if($request->has('photos')){
            $data['photos'] = $request->photos;
         }

         if($request->has('country')){
            $data['country_id'] = $request->country;
         }

         if($request->has('state')){
            $data['state_id'] = $request->state;
         }

         if($request->has('city')){
            $data['city_id'] = $request->city;
         }

         if($request->has('area')){
            $data['area_id'] = $request->area;
         }

         if($request->has('nested_area')){
            $data['nested_area_id'] = $request->nested_area;
         }
         
         $product = Product::create($data);
         return new PropertyDetailCollection(Product::where('id', $product->id)->get());

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