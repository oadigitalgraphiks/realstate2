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