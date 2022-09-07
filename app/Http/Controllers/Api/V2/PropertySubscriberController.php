<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\PropertyTourTypeCollection;
use App\Models\Message;
use App\Models\Subscriber;
use Cache;

class PropertySubscriberController extends Controller
{

    public function index()
    {
        return response()->json(Subscriber::all());
    }

    public function create($email)
    {

        $subs = Subscriber::where('email',$email)->get();
        if(count($subs) > 0 ){
            return response()->json([
                "message" => "already Subscribed"
            ],401);
        }

        Subscriber::create(['email' => $email]);
        return response()->json([
            "message" => "Subscribed"
        ],200);

    }


    public function destroy($id)
    {
        $email = Subscriber::where('id',$id)->get();
        if(count($email) == 0 ){
            return response()->json([
                "message" => "Not Found"
            ],401);
        }

        Subscriber::destroy($id);
        return response()->json([
            "message" => "Unsubscribed"
        ],200);   

    }

    
     
}
