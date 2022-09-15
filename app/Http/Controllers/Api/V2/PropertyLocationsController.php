<?php

namespace App\Http\Controllers\Api\V2;


use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use Cache;
use App\Models\PropertyArea;
use App\Models\PropertyCity;
use App\Models\PropertyNestedArea;
use App\Models\PropertyState;
use App\Models\PropertyType;
use App\Models\PropertyPurpose;

use Illuminate\Support\Str;
use App\Http\Resources\V2\PropertyLocationCollection;
use App\Http\Resources\V2\PropertyCountryCollection;
use App\Models\PropertyCountry;
use App\Models\Product;
use App\Models\PropertyContactForm;
use Validator;
use DB;

class PropertyLocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = PropertyState::with(['city.area'])->get();
        // return response()->json($data);        
        // $this->areas();
        // $this->nested_areas();

    }

    
     /**
     * Display a listing of the resource.
     */
    public function all_country(Request $request)
    {
        $data = PropertyCountry::all();
        return new PropertyCountryCollection($data);
    }

      /**
     * Display a listing of the resource.
     */
    public function all_states()
    {
        $data = PropertyState::all();
        return response()->json($data);
    }

       /**
     * Display a listing of the resource.
     */
    public function all_cities()
    {
        $data = PropertyCity::all();
        return response()->json($data);
    }

        /**
     * Display a listing of the resource.
     */
    public function all_areas()
    {
        $data = PropertyArea::all();
        return response()->json($data);
    }

          /**
     * Display a listing of the resource.
     */
    public function all_nested_areas()
    {
        $data = PropertyNestedArea::all();
        return response()->json($data);
    }

             /**
     * Display a listing of the resource.
     */
    public function property_register_options()
    {
        
        $optionsParent = DB::table('property_signup_options')->where('parent',0)->get()->toArray();
        $optionsChalid = DB::table('property_signup_options')->where('parent','!=',0)->get()->toArray();
        
        return response()->json([
            "parent" =>$optionsParent,
            "child" => $optionsChalid,
        ]);
    }

    






    /**
     * Display a listing of the resource.
     */
    public function get_state(Request $request,$slug)
    {
        $count = PropertyCountry::where('slug',$slug)->first();

     

        if($count){
            if($request->has('purpose')){
                    $data = PropertyState::where('country_id',229)->get();
                    return new PropertyLocationCollection($data);
            }
        }

        return response()->json(['errors' => 'Invalid Id'],400);
    }

    
    /*
     * Display a listing of the resource.
     */
    public function get_city(Request $request, $state)
    {   
        $state = PropertyState::where('orignal_slug',$state)->first();
        if($state){
            if($request->has('purpose')){
              $data = PropertyCity::where('state_id',$state->id)->get(); 
              return new PropertyLocationCollection($data);
            }
        }
        return response()->json(['errors' => 'Invalid Id'],400);
    }

    
    /*
     * Display a listing of the resource.
     */
    public function get_areas(Request $request, $city)
    {
            $city = PropertyCity::where('orignal_slug',$city)->first();  
            if($city){
                if($request->has('purpose')){
                  $data = PropertyArea::where('city_id',$city->id)->get();
                  return new PropertyLocationCollection($data);
                }
            }       
            return response()->json(['errors' => 'Invalid Id'],400);
    }

       /*
     * Display a listing of the resource.
     */
    public function get_nested_areas(Request $request,$slug)
    {
            $area = PropertyArea::where('orignal_slug',$slug)->first();  
            if($area){
                if($request->has('purpose')){
                  $data = PropertyNestedArea::where('parent',$area->id)->get();
                  return new PropertyLocationCollection($data);
                }
            }

            return response()->json(['errors' => 'Invalid Id'],400);
    }


    

    /*
     * Display a listing of the resource.
     */
    public function area_view(Request $request,$area)
    {
        $area = PropertyArea::where('id',$area)->first(); 
        if($area){
            if($request->has('purpose')){
              $data = PropertyNestedArea::where('parent',$area->id)->get();
              return new PropertyLocationCollection($data);  
            } 
        }

        return response()->json(['errors' => 'Invalid Id'],400);
    }

   


    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cities()
    {

        $states = PropertyState::all();
        foreach ($states as  $state) {

            $response = Http::get('https://www.bayut.com/api/internalLinks/?purpose=for-rent&location=%2F'.$state->slug);    
            $data = $response->json();
            foreach($data['childLocations'] as $value) {
                $city = PropertyCity::where('slug',$value['location']['slug'])->first();
                if($city == null){
                    PropertyCity::create([
                        'state_id' => $state->id,
                        "name" => $value['location']['name'],
                        "orignal_slug" => Str::slug($value['location']['name']),
                        "slug" => $value['location']['slug'],
                    ]);
                }
            }
        }


    }   


    /*
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function areas()
    {
        ini_set('max_execution_time', 300);
        $cities = PropertyCity::all();
        foreach ($cities as  $city) {

            $slug = str_replace('/','%2F',$city->slug);
            $response = Http::get('https://www.bayut.com/api/internalLinks/?purpose=for-rent&location='.$slug);

            $data = $response->json();
            if(isset($data['childLocations'])){
                foreach($data['childLocations'] as $value) {
                    $area = PropertyArea::where('slug',$value['location']['slug'])->first();
                    if($area == null){
                        PropertyArea::create([
                            'city_id' => $city->id,
                            'name' => $value['location']['name'],
                            'slug' => $value['location']['slug'],
                            "orignal_slug" => Str::slug($value['location']['name']),
                            'parent' =>0,
                        ]);
                    }
                }
            }

            

        }
    }  


        /*
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function nested_areas()
    {

        ini_set('max_execution_time',1000);

        $state = PropertyState::find(249);
        $ids = $state->city->pluck('id')->toArray();
        $areas = PropertyArea::WhereIn('city_id',$ids)->get();

        // dd($areas);
    
            
        foreach ($areas as $area){

            $slug = str_replace('/','%2F',$area->slug);
            
            $response = Http::get('https://www.bayut.com/api/internalLinks/?purpose=for-rent&location='.$slug);
            // dd($response->json());

            $data = $response->json();
            if(isset($data['childLocations'])){
                foreach($data['childLocations'] as $value) {

                    $arr = DB::table('property_nested_areas')->where('slug',$value['location']['slug'])->first();
                    if($arr == null){
                        DB::table('property_nested_areas')->insert([
                            'city_id' => $area->city_id,
                            'name' => $value['location']['name'],
                            'slug' => $value['location']['slug'],
                            "orignal_slug" => Str::slug($value['location']['name']),
                            'parent' => $area->id,
                        ]);
                        
                        // PropertyArea::create([
                        //     'city_id' => $area->city_id,
                        //     'name' => $value['location']['name'],
                        //     'slug' => $value['location']['slug'],
                        //     "orignal_slug" => Str::slug($value['location']['name']),
                        //     'parent' => $area->id,
                        // ]);

                    }
                }
            }

            
        }
    }  


 
}