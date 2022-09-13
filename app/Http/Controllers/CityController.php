<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyCity;
use App\Models\PropertyCountry;
use App\Models\CityTranslation;
use App\Models\PropertyState;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_city = $request->sort_city;
        $sort_state = $request->sort_state;
        $cities_queries = PropertyCity::with('state.country');
        if($request->sort_city) {
            $cities_queries->where('name', 'like', "%$sort_city%");
        }
        if($request->sort_state) {
            $cities_queries->where('state_id', $request->sort_state);
        }
        $cities = $cities_queries->orderBy('id', 'desc')->paginate(15);
        $states = PropertyState::all();

        return view('backend.location.cities.index', compact('cities', 'states', 'sort_city', 'sort_state'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city = new PropertyCity;

        $city->name = $request->name;
        $city->state_id = $request->state_id;

        $city->save();

        flash(translate('City has been inserted successfully'))->success();

        return redirect()->route('property_cities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit(Request $request, $id)
     {
         $lang  = $request->lang;
         $city  = PropertyCity::findOrFail($id);
         $states = PropertyState::all();
         return view('backend.location.cities.edit', compact('city', 'lang', 'states'));
     }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $city = PropertyCity::findOrFail($id);
        
        $city->name = $request->name;

        $city->state_id = $request->state_id;

        $city->save();

        flash(translate('City has been updated successfully'))->success();
        return redirect()->route('property_cities.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = PropertyCity::findOrFail($id);

        PropertyCity::destroy($id);

        flash(translate('City has been deleted successfully'))->success();
        return redirect()->route('property_cities.index');
    }

    public function updateStatus(Request $request){
        $city = PropertyCity::findOrFail($request->id);
        $city->status = $request->status;
        $city->save();

        return 1;
    }
}
