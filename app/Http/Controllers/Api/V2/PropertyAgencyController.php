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
            'purpose' => 'required|integer',
            'type' => 'required|integer',
            'meta_title' => 'string',
            'description' => 'string',
            'longitude' => 'string',
            'latitude' => 'string',
            'bed' => 'integer',
            'bath' => 'integer',	 
            'tour_type' => 'integer',
            'furnish_type' => 'integer',
            'amenities' => 'string',
            'conditions' => 'string',
            'tags' => 'string',
            'thumbnail_image' => 'string',
            'photos' => 'string',
            'country' => 'integer',
            'state' => 'integer',
            'city' => 'integer',
            'area' =>  'integer',
            'nested_area' =>  'integer',   
         ]);


         if($validator->fails()){
            return response()->json([
             'message' => 'Validation Failed',
             'errors' => $validator->messages(),
            ],401);
         }


         $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'meta_title' => $request->title,
            'meta_description' => $request->meta_description,
            'price' => $request->price,
            'reference' => $request->reference,
            'sqft' => $request->sqft,
            'purpose' => $request->purpose,
            'type' => $request->type,
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
            $data['bed'] = $request->bed;
         }

         if($request->has('bath')){
            $data['bath'] = $request->bed;
         }

         if($request->has('tour_type')){
            $data['tour_type'] = $request->tour_type;
         }

         if($request->has('furnish_type')){
            $data['furnish_type'] = $request->furnish_type;
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
            $data['country'] = $request->country;
         }

         if($request->has('state')){
            $data['state'] = $request->state;
         }

         if($request->has('city')){
            $data['city'] = $request->city;
         }

         if($request->has('area')){
            $data['area'] = $request->area;
         }

         if($request->has('nested_area')){
            $data['nested_area'] = $request->nested_area;
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