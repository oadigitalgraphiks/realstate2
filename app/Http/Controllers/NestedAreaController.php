<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyNestedArea;
use App\Models\PropertyArea;
use App;

class NestedAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_area = $request->sort_area;
        $area_queries = PropertyNestedArea::with('area.city.state.country');
        if($request->sort_area) {
            $area_queries->where('name', 'like', "%$sort_area%");
        }
        $nested_areas = $area_queries->paginate(15);

        return view('backend.location.nested_areas.index', compact('nested_areas', 'sort_area'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = PropertyArea::all();
        return view('backend.location.nested_areas.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nested_area = new PropertyNestedArea;
        $nested_area->name = $request->name;
        $nested_area->parent = $request->area_id;
        $nested_area->save();

        flash(translate('Country has been inserted successfully'))->success();
        return redirect()->route('property_nested_areas.index');
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
        $nested_area = PropertyNestedArea::find($id);
        $areas = PropertyArea::all();
        return view('backend.location.nested_areas.edit', compact('nested_area', 'areas'));
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
        $nested_area = PropertyNestedArea::findOrFail($id);
        $nested_area->name = $request->name;
        $nested_area->parent = $request->area_id;

        $nested_area->save();
        flash(translate('Property Nested Area has been Updated successfully'))->success();
        return redirect()->route('property_nested_areas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property_nested_area = PropertyNestedArea::findOrFail($id);

        $property_nested_area->delete();

        flash(translate('Property Nested Area has been deleted successfully'))->success();
        return redirect()->route('property_nested_areas.index');
    }

    public function updateStatus(Request $request){
        $area = PropertyNestedArea::findOrFail($request->id);
        $area->status = $request->status;
        if($area->save()){
            return 1;
        }
        return 0;
    }
}
