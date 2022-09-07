<?php

namespace App\Http\Controllers\Api\V2;

use Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\PropertyContactForm;
use Validator;

class PropertyContactFormController extends Controller
{
   
    /*
     * Display a listing of the resource.
     */
    public function property_contact_forms_create(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|string|email',
            "phone" => 'string',
            'message' => 'string',
            "keep_info" => 'required|string',
            "property_id" => 'required|integer|exists:products,id',
            "agent_id" => 'required|integer|exists:users,id',
         ]);

         if($validator->fails()){
            return response()->json([
             'message' => 'Validation Failed',
             'errors' => $validator->messages(),
            ],401);
         } 

        $data = PropertyContactForm::create([
            'name' => $request->name,
            'email' => $request->email,
            "phone" => $request->phone,
            'message' => $request->message,
            "keep_info" => $request->keep_info,
            "property_id" =>  $request->property_id,
            "agent_id" => $request->agent_id,
        ]);

        return response()->json($data,200);
    }

   /**
     * Display a listing of the resource.
     */
    public function property_contact_forms($id)
    {

        $data = PropertyContactForm::where('agent_id',$id)->with(['property','agent'])->get();

        return response()->json($data,200);
    }



 
}