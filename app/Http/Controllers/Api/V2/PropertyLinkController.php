<?php

namespace App\Http\Controllers\Api\V2;

use Illuminate\Http\Request;
use Cache;
use App\Models\PropertyPurpose;
use App\Models\PropertyType;
use App\Models\PropertyCountry;
use App\Models\PropertyCity;
use App\Models\PropertyState;
use App\Models\PropertyArea;
use App\Models\Product;
use App\Models\PropertyBed;
use App\Models\PropertyNestedArea;



class PropertyLinkController extends Controller
{

     // Country Default///
    ////////////////////
    ///////////////////
    ///////////////////

    public function country_default(Request $request)
    {
        
        if($request->has('country') && $request->has('purpose')){

            $country = PropertyCountry::where('slug',$request->country)->first();
            $purposes = PropertyPurpose::where('slug',$request->purpose)->first();
            
            if($purposes && $country){
              
                $name = "Short Term Residential Rentals in ".$country->name; 
                $links = [];
                if($purposes->name == 'to-rent'){

                    foreach ($purposes->children()->get() as  $purpose){
                            
                            $title = 'Property For '.$purpose->name.' '.$purpose->parent()->first()->name.' In '.$country->name;
                            $query = Product::where('purpose_id',$purposes->id)->where('purpose_child_id',$purpose->id)->where('country_id',$country->id)->get();
                            array_push($links,[
                                'title' =>$title,
                                'link' => [
                                    'purpose' => $purposes->slug,
                                    'purpose_child' => $purpose->slug,
                                    'country' => $country->slug,
                                ],
                                'count' => count($query)
                            ]);
                    }
                
                $random = $purposes->children()->inRandomOrder()->first();
                $title = 'Cheap Property For '.$random->name.' '.$purposes->name.' In '.$country->name;
                array_push($links,[
                    'title' => $title,
                    'link' => [
                        'purpose' => $purposes->slug,
                        'purpose_child' => 'monthly',
                        'country' => $country->slug,
                        'sort_key' => 'price_low_to_high',
                    ],
                ]);

            }

                return response()->json([
                    $name => $links
                ]);

            }

        }


        return response()->json([
            "message" => "invalid URL"
        ],401);
    }





    // Country Change ///
    ////////////////////
    ///////////////////
    ///////////////////
    public function country_change(Request $request)
    {
        if($request->has('country') && $request->has('type') && $request->has('purpose')){

            $country = PropertyCountry::where('slug',$request->country)->first();
            $purposes = PropertyPurpose::where('slug',$request->purpose)->first();
            $type = PropertyType::where('slug',$request->type)->first();
            if($purposes && $type && $country){


                //Appartment Types
                $type_title = $type->name.' Types';
                $links = [];
                if($type->parent_id == 17){

                    foreach (PropertyBed::all() as  $bed) {
                        $name = $bed->name == 'Studio' ? $bed->name : $bed->name.' Bedrom';
                        $title = $name.' '.$type->name.' For '.$purposes->name.' In '.$country->name;
                        $query = Product::where('type_id',$type->id)->where('purpose_id',$purposes->id)->where('bed_id',$bed->id)->where('country_id',$country->id)->get();

                        array_push($links,[
                            'title' =>$title,
                            'link' => [
                                'type' => $type->slug,
                                'purpose' => $purposes->slug,
                                'bed' => $bed->slug,
                                'country' => $country->slug,
                            ],
                            'count' => count($query),
                        ]);
                    }
                }


                // Short Terms Apartment Rentals in UAE
                $rentals_name = 'Short Term '.$type->name.' '.$purposes->name.' in '.$country->name;
                $rentals = [];

                    foreach ($purposes->children()->get() as  $purpose) {
                        $title = $type->name.' For '.$purpose->name.' '.$purpose->parent()->first()->name.' In '.$country->name;
                        $query = Product::where('type_id',$type->id)->where('purpose_id',$purposes->id)->where('purpose_child_id',$purpose->id)->where('country_id',$country->id)->get();
                        array_push($rentals,[
                            'title' =>$title,
                            'link' => [
                                'type' => $type->slug,
                                'purpose' => $purposes->slug,
                                'purpose_child' => $purpose->slug,
                                'country' => $country->slug,
                            ],
                            'count' => count($query)
                        ]);
                    }

                    //Rent in Uae
                    $title = $type->name.' For '.$purposes->name.' In '.$country->name;
                    $query = Product::where('type_id',$type->id)->where('purpose_id',$purposes->id)->where('country_id',$country->id)->get();
                    array_push($rentals,[
                        'title' =>$title,
                        'link' => [
                            'type' => $type->slug,
                            'purpose' => $purposes->slug,
                            'country' => $country->slug,
                        ],
                        'count' => count($query)
                    ]);


                    //Cheapest 
                    $title = 'Cheap '.$type->name.' For '.$purposes->name.' In '.$country->name;
                    array_push($rentals,[
                        'title' =>$title,
                        'link' => [
                            'type' => $type->slug,
                            'purpose' => $purposes->slug,
                            'country' => $country->slug,
                            'sort_key' => 'price_low_to_high',
                        ],   
                    ]);
                    
                

                return response()->json([
                    $type_title => $links,
                    $rentals_name => $rentals, 
                ]);
            }

        }

        return response()->json([
            "message" => "invalid URL"
        ],401);

    }




    // State Links
    // ///////////
    /////////////
    /////////////
    ////////////
    public function state_links(Request $request)
    {

        if($request->has('state') && $request->has('country') && $request->has('type') && $request->has('purpose')){

            $country = PropertyCountry::where('slug',$request->country)->first();
            $state = PropertyState::where('orignal_slug',$request->state)->first();
            $purposes = PropertyPurpose::where('slug',$request->purpose)->first();
            $type = PropertyType::where('slug',$request->type)->first();

            if($purposes && $type && $country && $state){

                //Appartment Types
                $type_title = $type->name.' Types';
                $links = [];
                if($type->parent_id == 17){

                    foreach (PropertyBed::all() as  $bed) {
                        $name = $bed->name == 'Studio' ? $bed->name : $bed->name.' Bedrom';
                        $title = $name.' '.$type->name.' For '.$purposes->name.' In '.$state->name;
                        $query = Product::where('type_id',$type->id)->where('purpose_id',$purposes->id)->where('bed_id',$bed->id)->where('country_id',$state->id)->where('state_id',$state->id)->get();

                        array_push($links,[
                            'title' =>$title,
                            'link' => [
                                'type' => $type->slug,
                                'purpose' => $purposes->slug,
                                'bed' => $bed->slug,
                                'country' => $country->slug,
                                'state' => $state->orignal_slug,
                            ],
                            'count' => count($query),
                        ]);
                    }
                }


                //Near Dubai 
                $near_name = 'Near '.$state->name;
                $nears = [];
                
                foreach ($country->states()->get() as  $item) {
                    $title = $type->name.' For '.$purposes->name.' In '.$item->name;

                    $query = Product::where('type_id',$type->id)->where('purpose_id',$purposes->id)->where('country_id',$country->id)->where('state_id',$item->id)->get();
                    
                    array_push($nears,[
                        'title' =>$title,
                        'link' => [
                            'type' => $type->slug,
                            'purpose' => $purposes->slug,
                            'country' => $country->slug,
                            'state' => $item->orignal_slug,
                        ],
                        'count' => count($query)
                    ]);
                }



                // Short Terms Apartment Rentals in UAE
                $rentals_name = 'Short Term '.$type->name.' '.$purposes->name.' in '.$state->name;
                $rentals = [];
                
                foreach ($purposes->children()->get() as  $purpose) {
                    $title = $type->name.' For '.$purpose->name.' '.$purpose->parent()->first()->name.' In '.$state->name;

                    $query = Product::where('type_id',$type->id)->where('purpose_id',$purposes->id)->where('purpose_child_id',$purpose->id)->where('country_id',$country->id)->where('state_id',$state->id)->get();
                    
                    array_push($rentals,[
                        'title' =>$title,
                        'link' => [
                            'type' => $type->slug,
                            'purpose' => $purposes->slug,
                            'purpose_child' => $purpose->slug,
                            'country' => $country->slug,
                            'state' => $state->orignal_slug,
                        ],
                        'count' => count($query)
                    ]);
                }


                //Rent in Uae
                $title = $type->name.' For '.$purposes->name.' In '.$state->orignal_slug;
                $query = Product::where('type_id',$type->id)->where('purpose_id',$purposes->id)->where('country_id',$country->id)->where('state_id',$state->id)->get();
                array_push($rentals,[
                    'title' =>$title,
                    'link' => [
                        'type' => $type->slug,
                        'purpose' => $purposes->slug,
                        'country' => $country->slug,
                        'state' => $state->orignal_slug,
                    ],
                    'count' => count($query)
                ]);



                //Cheapest 
                $title = 'Cheap '.$type->name.' For '.$purposes->name.' In '.$state->orignal_slug;
                array_push($rentals,[
                    'title' =>$title,
                    'link' => [
                        'type' => $type->slug,
                        'purpose' => $purposes->slug,
                        'country' => $country->slug,
                        'state' => $state->orignal_slug,
                        'sort_key' => 'price_low_to_high',
                    ],   
                ]);    
                
                return response()->json([
                    $type_title => $links,
                    $near_name => $nears,
                    $rentals_name => $rentals, 
                ]);


            }

        }


        return response()->json([
            "message" => "invalid URL"
        ],401);

    }




    // City Links
    // ///////////
    /////////////
    /////////////
    ////////////
    public function city_links(Request $request)
    {


     if($request->has('city') && $request->has('state') && $request->has('country') && $request->has('type') && $request->has('purpose')){

            $country = PropertyCountry::where('slug',$request->country)->first();
            $state = PropertyState::where('orignal_slug',$request->state)->first();
            $city = PropertyCity::where('orignal_slug',$request->city)->first();
            $purposes = PropertyPurpose::where('slug',$request->purpose)->first();
            $type = PropertyType::where('slug',$request->type)->first();

            if($purposes && $type && $country && $state && $city){

                //Appartment Types
                $type_title = $type->name.' Types';
                $links = [];
                if($type->parent_id == 17){

                    foreach (PropertyBed::all() as  $bed) {
                        $name = $bed->name == 'Studio' ? $bed->name : $bed->name.' Bedrom';
                        $title = $name.' '.$type->name.' For '.$purposes->name.' In '.$city->name;
                       
                        $query = Product::where('type_id',$type->id)
                        ->where('purpose_id',$purposes->id)
                        ->where('bed_id',$bed->id)
                        ->where('country_id',$country->id)
                        ->where('state_id',$state->id)
                        ->where('city_id',$city->id)
                        ->get();

                        array_push($links,[
                            'title' =>$title,
                            'link' => [
                                'type' => $type->slug,
                                'purpose' => $purposes->slug,
                                'bed' => $bed->slug,
                                'country' => $country->slug,
                                'state' => $state->orignal_slug,
                                'city' => $city->orignal_slug,
                            ],
                            'count' => count($query),
                        ]);
                    }
                }



                //Near Dubai 
                $near_name = 'Near '.$city->name;
                $nears = [];
                
                foreach ($state->city()->get() as  $item) {
                    $title = $type->name.' For '.$purposes->name.' In '.$item->name;

                    $query = Product::where('type_id',$type->id)
                    ->where('purpose_id',$purposes->id)
                    ->where('country_id',$country->id)
                    ->where('state_id',$state->id)
                    ->where('city_id',$item->id)
                    ->get();
                    
                    array_push($nears,[
                        'title' =>$title,
                        'link' => [
                            'type' => $type->slug,
                            'purpose' => $purposes->slug,
                            'country' => $country->slug,
                            'state' => $state->orignal_slug,
                            'city' => $item->orignal_slug,
                        ],
                        'count' => count($query)
                    ]);
                }



                // Short Terms Apartment Rentals in UAE
                $rentals_name = 'Short Term '.$type->name.' '.$purposes->name.' in '.$city->name;
                $rentals = [];
                
                foreach ($purposes->children()->get() as  $purpose) {
                    $title = $type->name.' For '.$purpose->name.' '.$purpose->parent()->first()->name.' In '.$city->name;

                    $query = Product::where('type_id',$type->id)
                    ->where('purpose_id',$purposes->id)
                    ->where('purpose_child_id',$purpose->id)
                    ->where('country_id',$country->id)
                    ->where('state_id',$state->id)
                    ->where('city_id',$city->id)
                    ->get();
                    
                    array_push($rentals,[
                        'title' =>$title,
                        'link' => [
                            'type' => $type->slug,
                            'purpose' => $purposes->slug,
                            'purpose_child' => $purpose->slug,
                            'country' => $country->slug,
                            'state' => $state->orignal_slug,
                            'city' => $city->orignal_slug,
                        ],
                        'count' => count($query)
                    ]);
                }


                //Rent in Uae
                $title = $type->name.' For '.$purposes->name.' In '.$city->orignal_slug;
                $query = Product::where('type_id',$type->id)
                ->where('purpose_id',$purposes->id)
                ->where('country_id',$country->id)
                ->where('state_id',$state->id)
                ->where('city_id',$city->id)
                ->get();

                array_push($rentals,[
                    'title' =>$title,
                    'link' => [
                        'type' => $type->slug,
                        'purpose' => $purposes->slug,
                        'country' => $country->slug,
                        'state' => $state->orignal_slug,
                        'city' => $city->orignal_slug,
                    ],
                    'count' => count($query)
                ]);



                //Cheapest 
                $title = 'Cheap '.$type->name.' For '.$purposes->name.' In '.$city->orignal_slug;
                array_push($rentals,[
                    'title' =>$title,
                    'link' => [
                        'type' => $type->slug,
                        'purpose' => $purposes->slug,
                        'country' => $country->slug,
                        'state' => $state->orignal_slug,
                        'city' => $city->orignal_slug,
                        'sort_key' => 'price_low_to_high',
                    ],   
                ]);    
                
                return response()->json([
                    $type_title => $links,
                    $near_name => $nears,
                    $rentals_name => $rentals, 
                ]);

            }

        }


        return response()->json([
            "message" => "invalid URL"
        ],401);

    }


    // Area Links
    ////////////
    ////////////
    ////////////
    ////////////
    ///////////

    public function area_links(Request $request)
    {

        if($request->has('area') && $request->has('city') && $request->has('state') && $request->has('country') && $request->has('type') && $request->has('purpose')){

            $country = PropertyCountry::where('slug',$request->country)->first();
            $state = PropertyState::where('orignal_slug',$request->state)->first();
            $city = PropertyCity::where('orignal_slug',$request->city)->first();
            $area = PropertyArea::where('orignal_slug',$request->area)->first();
            $purposes = PropertyPurpose::where('slug',$request->purpose)->first();
            $type = PropertyType::where('slug',$request->type)->first();

            if($purposes && $type && $country && $state && $city && $area){

                //Appartment Types
                $type_title = $type->name.' Types';
                $links = [];
                if($type->parent_id == 17){

                    foreach (PropertyBed::all() as  $bed) {
                        $name = $bed->name == 'Studio' ? $bed->name : $bed->name.' Bedrom';
                        $title = $name.' '.$type->name.' For '.$purposes->name.' In '.$area->name;
                       
                        $query = Product::where('type_id',$type->id)
                        ->where('purpose_id',$purposes->id)
                        ->where('bed_id',$bed->id)
                        ->where('country_id',$country->id)
                        ->where('state_id',$state->id)
                        ->where('city_id',$city->id)
                        ->where('area_id',$area->id)
                        ->get();

                        array_push($links,[
                            'title' =>$title,
                            'link' => [
                                'type' => $type->slug,
                                'purpose' => $purposes->slug,
                                'bed' => $bed->slug,
                                'country' => $country->slug,
                                'state' => $state->orignal_slug,
                                'city' => $city->orignal_slug,
                                'area' => $area->orignal_slug,
                            ],
                            'count' => count($query),
                        ]);
                    }
                }




                //Near Dubai 
                $near_name = 'Near '.$area->name;
                $nears = [];
                
                foreach ($city->area()->get() as  $item) {
                    $title = $type->name.' For '.$purposes->name.' In '.$item->name;

                    $query = Product::where('type_id',$type->id)
                    ->where('purpose_id',$purposes->id)
                    ->where('country_id',$country->id)
                    ->where('state_id',$state->id)
                    ->where('city_id',$city->id)
                    ->where('area_id',$item->id)
                    ->get();
                    
                    array_push($nears,[
                        'title' =>$title,
                        'link' => [
                            'type' => $type->slug,
                            'purpose' => $purposes->slug,
                            'country' => $country->slug,
                            'state' => $state->orignal_slug,
                            'city' => $city->orignal_slug,
                            'area' => $item->orignal_slug,
                        ],
                        'count' => count($query)
                    ]);
                }



                // Short Terms Apartment Rentals in UAE
                $rentals_name = 'Short Term '.$type->name.' '.$purposes->name.' in '.$area->name;
                $rentals = [];
                
                foreach ($purposes->children()->get() as  $purpose) {
                   
                    $title = $type->name.' For '.$purpose->name.' '.$purpose->parent()->first()->name.' In '.$area->name;
                   
                    $query = Product::where('type_id',$type->id)
                    ->where('purpose_id',$purposes->id)
                    ->where('purpose_child_id',$purpose->id)
                    ->where('country_id',$country->id)
                    ->where('state_id',$state->id)
                    ->where('city_id',$city->id)
                    ->where('area_id',$area->id)
                    ->get();
                    array_push($rentals,[
                        'title' =>$title,
                        'link' => [
                            'type' => $type->slug,
                            'purpose' => $purposes->slug,
                            'purpose_child' => $purpose->slug,
                            'country' => $country->slug,
                            'state' => $state->orignal_slug,
                            'city' => $city->orignal_slug,
                            'area' => $area->orignal_slug,
                        ],
                        'count' => count($query)
                    ]);
                }


                //Rent in Uae
                $title = $type->name.' For '.$purposes->name.' In '.$area->name;
                $query = Product::where('type_id',$type->id)
                ->where('purpose_id',$purposes->id)
                ->where('country_id',$country->id)
                ->where('state_id',$state->id)
                ->where('city_id',$city->id)
                ->where('area_id',$area->id)
                ->get();

                array_push($rentals,[
                    'title' =>$title,
                    'link' => [
                        'type' => $type->slug,
                        'purpose' => $purposes->slug,
                        'country' => $country->slug,
                        'state' => $state->orignal_slug,
                        'city' => $city->orignal_slug,
                        'area' => $area->orignal_slug,
                    ],
                    'count' => count($query)
                ]);

                //Cheapest 
                $title = 'Cheap '.$type->name.' For '.$purposes->name.' In '.$area->name;
                array_push($rentals,[
                    'title' =>$title,
                    'link' => [
                        'type' => $type->slug,
                        'purpose' => $purposes->slug,
                        'country' => $country->slug,
                        'state' => $state->orignal_slug,
                        'city' => $city->orignal_slug,
                        'area' => $area->orignal_slug,
                        'sort_key' => 'price_low_to_high',
                    ],   
                ]);    
                
                return response()->json([
                    $type_title => $links,
                    $near_name => $nears,
                    $rentals_name => $rentals, 
                ]);

            }

        }


        return response()->json([
            "message" => "invalid URL"
        ],401);



        
    }


    public function nested_area_links(Request $request)
    {

        if($request->has('nested_area') && $request->has('area') && $request->has('city') && $request->has('state') && $request->has('country') && $request->has('type') && $request->has('purpose')){

            $country = PropertyCountry::where('slug',$request->country)->first();
            $state = PropertyState::where('orignal_slug',$request->state)->first();
            $city = PropertyCity::where('orignal_slug',$request->city)->first();
            $area = PropertyArea::where('orignal_slug',$request->area)->first();
            $nested_area = PropertyNestedArea::where('orignal_slug',$request->nested_area)->first();
            $purposes = PropertyPurpose::where('slug',$request->purpose)->first();
            $type = PropertyType::where('slug',$request->type)->first();

            if($purposes && $type && $country && $state && $city && $area && $nested_area){

                //Appartment Types
                $type_title = $type->name.' Types';
                $links = [];
                if($type->parent_id == 17){

                    foreach (PropertyBed::all() as  $bed) {
                        $name = $bed->name == 'Studio' ? $bed->name : $bed->name.' Bedrom';
                        $title = $name.' '.$type->name.' For '.$purposes->name.' In '.$nested_area->name;
                       
                        $query = Product::where('type_id',$type->id)
                        ->where('purpose_id',$purposes->id)
                        ->where('bed_id',$bed->id)
                        ->where('country_id',$country->id)
                        ->where('state_id',$state->id)
                        ->where('city_id',$city->id)
                        ->where('area_id',$area->id)
                        ->where('nested_area_id',$nested_area->id)
                        ->get();

                        array_push($links,[
                            'title' =>$title,
                            'link' => [
                                'type' => $type->slug,
                                'purpose' => $purposes->slug,
                                'bed' => $bed->slug,
                                'country' => $country->slug,
                                'state' => $state->orignal_slug,
                                'city' => $city->orignal_slug,
                                'area' => $area->orignal_slug,
                                'nested_area' => $nested_area->orignal_slug,
                            ],
                            'count' => count($query),
                        ]);
                    }
                }




                //Near Dubai 
                $near_name = 'Near '.$nested_area->name;
                $nears = [];
                
                foreach ($city->area()->get() as  $item) {
                    $title = $type->name.' For '.$purposes->name.' In '.$item->name;

                    $query = Product::where('type_id',$type->id)
                    ->where('purpose_id',$purposes->id)
                    ->where('country_id',$country->id)
                    ->where('state_id',$state->id)
                    ->where('city_id',$city->id)
                    ->where('area_id',$area->id)
                    ->where('nested_area_id',$item->id)
                    ->get();
                    
                    array_push($nears,[
                        'title' =>$title,
                        'link' => [
                            'type' => $type->slug,
                            'purpose' => $purposes->slug,
                            'country' => $country->slug,
                            'state' => $state->orignal_slug,
                            'city' => $city->orignal_slug,
                            'area' => $area->orignal_slug,
                            'nested_area' => $item->orignal_slug,
                        ],
                        'count' => count($query)
                    ]);
                }



                // Short Terms Apartment Rentals in UAE
                $rentals_name = 'Short Term '.$type->name.' '.$purposes->name.' in '.$nested_area->name;
                $rentals = [];
                
                foreach ($purposes->children()->get() as  $purpose) {

                    $title = $type->name.' For '.$purpose->name.' '.$purpose->parent()->first()->name.' In '.$nested_area->name;

                    $query = Product::where('type_id',$type->id)
                    ->where('purpose_id',$purposes->id)
                    ->where('purpose_child_id',$purpose->id)
                    ->where('country_id',$country->id)
                    ->where('state_id',$state->id)
                    ->where('city_id',$city->id)
                    ->where('area_id',$area->id)
                    ->where('nested_area_id',$nested_area->id)
                    ->get();
                    array_push($rentals,[
                        'title' =>$title,
                        'link' => [
                            'type' => $type->slug,
                            'purpose' => $purposes->slug,
                            'purpose_child' => $purpose->slug,
                            'country' => $country->slug,
                            'state' => $state->orignal_slug,
                            'city' => $city->orignal_slug,
                            'area' => $area->orignal_slug,
                            'nested_area' => $nested_area->orignal_slug,
                        ],
                        'count' => count($query)
                    ]);
                }




                //Rent in Uae
                $title = $type->name.' For '.$purposes->name.' In '.$nested_area->name;
                $query = Product::where('type_id',$type->id)
                ->where('purpose_id',$purposes->id)
                ->where('country_id',$country->id)
                ->where('state_id',$state->id)
                ->where('city_id',$city->id)
                ->where('area_id',$area->id)
                ->where('nested_area_id',$nested_area->id)
                ->get();
                array_push($rentals,[
                    'title' =>$title,
                    'link' => [
                        'type' => $type->slug,
                        'purpose' => $purposes->slug,
                        'country' => $country->slug,
                        'state' => $state->orignal_slug,
                        'city' => $city->orignal_slug,
                        'area' => $area->orignal_slug,
                        'nested_area' => $nested_area->orignal_slug,
                    ],
                    'count' => count($query)
                ]);



                //Cheapest 
                $title = 'Cheap '.$type->name.' For '.$purposes->name.' In '.$nested_area->name;
                array_push($rentals,[
                    'title' =>$title,
                    'link' => [
                        'type' => $type->slug,
                        'purpose' => $purposes->slug,
                        'country' => $country->slug,
                        'state' => $state->orignal_slug,
                        'city' => $city->orignal_slug,
                        'area' => $area->orignal_slug,
                        'nested_area' => $nested_area->orignal_slug,
                        'sort_key' => 'price_low_to_high',
                    ],   
                ]);    
                return response()->json([
                    $type_title => $links,
                    $near_name => $nears,
                    $rentals_name => $rentals, 
                ]);


            }

        }


        return response()->json([
            "message" => "invalid URL"
        ],401);



        
    }


    public function property_links($id)
    {
        $property = Product::find($id);
        if($property){

            $data= [];
            $type = $property->type;
            $purpose = $property->purpose;
            $country = $property->country;
            $state = $property->state;
            $city = $property->city;
            $area = $property->area;
            $nested_area = $property->nested_area;



            //Country
            if($country){
                $title = 'Properties For '.$purpose->name.' In '.$country->name;
                array_push($data,[
                    'title' =>$title,
                    'link' => [
                        'purpose' => $purpose->slug,
                        'country' => $country->slug,
                    ],
                ]);

                $title = $type->name.' For '.$purpose->name.' In '.$country->name;
                array_push($data,[
                    'title' =>$title,
                    'link' => [
                        'type' => $type->slug,
                        'purpose' => $purpose->slug,
                        'country' => $country->slug,
                    ],
                ]);
            }


            //State
            if($state){

                $title = 'Properties For '.$purpose->name.' In '.$state->name;
                array_push($data,[
                    'title' =>$title,
                    'link' => [
                        'purpose' => $purpose->slug,
                        'country' => $country->slug,
                        'state' => $state->orignal_slug,
                    ],
                ]);


                $title = $type->name.' For '.$purpose->name.' In '.$state->name;
                array_push($data,[
                    'title' =>$title,
                    'link' => [
                        'type' => $type->slug,
                        'purpose' => $purpose->slug,
                        'country' => $country->slug,
                        'state' => $state->orignal_slug,
                    ],
                ]);
            }

            //City
            if($city){
                
                $title = 'Properties For '.$purpose->name.' In '.$city->name;
                array_push($data,[
                    'title' =>$title,
                    'link' => [
                        'purpose' => $purpose->slug,
                        'country' => $country->slug,
                        'state' => $state->orignal_slug,
                        'city' => $city->orignal_slug,
                    ],
                ]);

                $title = $type->name.'For '.$purpose->name.' In '.$city->name;
                array_push($data,[
                    'title' =>$title,
                    'link' => [
                        'type' => $type->slug,
                        'purpose' => $purpose->slug,
                        'country' => $country->slug,
                        'state' => $state->orignal_slug,
                        'city' => $city->orignal_slug,
                    ],
                ]);
            }

            //Area
            if($property->area){

                $title = 'Properties For '.$purpose->name.' In '.$area->name;
                array_push($data,[
                    'title' =>$title,
                    'link' => [
                        'purpose' => $purpose->slug,
                        'country' => $country->slug,
                        'state' => $state->orignal_slug,
                        'city' => $city->orignal_slug,
                        'area' => $area->orignal_slug,
                    ],
                ]);

                $title = $type->name.' For '.$purpose->name.' In '.$area->name;
                array_push($data,[
                    'title' =>$title,
                    'link' => [
                        'type' => $type->slug,
                        'purpose' => $purpose->slug,
                        'country' => $country->slug,
                        'state' => $state->orignal_slug,
                        'city' => $city->orignal_slug,
                        'area' => $area->orignal_slug,
                    ],
                ]);
            }


            //Nested Areas
            if($nested_area){
                $title = 'Properties For '.$purpose->name.' In '.$nested_area->name;
                array_push($data,[
                    'title' =>$title,
                    'link' => [
                        'purpose' => $purpose->slug,
                        'country' => $country->slug,
                        'state' => $state->orignal_slug,
                        'city' => $city->orignal_slug,
                        'area' => $area->orignal_slug,
                        'nested_area' => $nested_area->orignal_slug,
                    ],
                ]);

                $title = $type->name.' For '.$purpose->name.' In '.$nested_area->name;
                array_push($data,[
                    'title' =>$title,
                    'link' => [
                        'type' => $type->slug,
                        'purpose' => $purpose->slug,
                        'country' => $country->slug,
                        'state' => $state->orignal_slug,
                        'city' => $city->orignal_slug,
                        'area' => $area->orignal_slug,
                        'nested_area' => $nested_area->orignal_slug,
                    ],
                ]);

            }


            foreach (PropertyBed::all() as $value) {
                
                $name = $value->name == 'Studio'? $value->name : $value->name.' Bedrom';
                $title = $name.' '.$type->name.' For '.$purpose->name.' In '.$state->name;
                
                array_push($data,[
                    'title' =>$title,
                    'link' => [
                        'type' => $type->slug,
                        'purpose' => $property->purpose->slug,
                        'country' => $property->country->slug,
                        'state' => $property->state->orignal_slug,
                        'bed' => $value->slug,
                    ],
                ]);
                
            }







           return response()->json($data);

        }
        


    }

































}