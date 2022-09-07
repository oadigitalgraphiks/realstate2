<?php

namespace App\Http\Controllers\Api\V2;

use Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\PropertyReport;
use Validator;

class PropertyReportController extends Controller
{
   
    /*
     * Display a listing of the resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|string|email',
            'message' => 'string',
            "property_id" => 'required|integer|exists:products,id',
            "agent_id" => 'required|integer|exists:users,id',
         ]);

         if($validator->fails()){
            return response()->json([
             'message' => 'Validation Failed',
             'errors' => $validator->messages(),
            ],401);
         } 

        $data = PropertyReport::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            "property_id" =>  $request->property_id,
            "agent_id" => $request->agent_id,
        ]);

        return response()->json($data,200);
    }

    /*
     * Display a listing of the resource.
     */
    public function get($id)
    {
        $data = PropertyReport::where('property_id',$id)->with(['property','agent'])->get();
        return response()->json($data,200);
    }



 
}