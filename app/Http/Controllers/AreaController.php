<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyArea;
use App\Models\PropertyCity;
use App\Models\PropertyCountry;
use App;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_area = $request->sort_area;
        $area_queries = PropertyArea::with('city.state.country');
        if($request->sort_area) {
            $area_queries->where('name', 'like', "%$sort_area%");
        }
        $areas = $area_queries->paginate(15);

        return view('backend.location.areas.index', compact('areas', 'sort_area'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = PropertyCity::all();
        return view('backend.location.areas.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $area = new PropertyArea;
        $area->name = $request->name;
        $area->city_id = $request->city_id;
        $area->save();

        flash(translate('Country has been inserted successfully'))->success();
        return redirect()->route('property_areas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = PropertyArea::find($id);
        $cities = PropertyCity::all();
        return view('backend.location.areas.edit', compact('area', 'cities'));
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
        $area = PropertyArea::findOrFail($id);
        $area->name = $request->name;
        $area->city_id = $request->city_id;

        $area->save();
        flash(translate('Property Area has been Updated successfully'))->success();
        return redirect()->route('property_areas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property_area = PropertyArea::findOrFail($id);

        $property_area->delete();

        flash(translate('Property Area has been deleted successfully'))->success();
        return redirect()->route('property_areas.index');
    }

    public function updateStatus(Request $request){
        $area = PropertyArea::findOrFail($request->id);
        $area->status = $request->status;
        if($area->save()){
            return 1;
        }
        return 0;
    }
}
