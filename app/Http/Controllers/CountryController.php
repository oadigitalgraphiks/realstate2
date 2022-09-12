<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyCountry;
use App;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_country = $request->sort_country;
        $country_queries = PropertyCountry::orderBy('status', 'desc');
        if($request->sort_country) {
            $country_queries->where('name', 'like', "%$sort_country%");
        }
        $countries = $country_queries->paginate(15);

        return view('backend.location.countries.index', compact('countries', 'sort_country'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = PropertyCountry::all();
        return view('backend.location.countries.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = new PropertyCountry;
        $country->name = $request->name;
        $country->code = $request->code;
        $country->status = 1;
        $country->save();

        flash(translate('Country has been inserted successfully'))->success();
        return redirect()->route('property_countries.index');
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
        $country = PropertyCountry::findOrFail($id);
        return view('backend.location.countries.edit', compact('country'));

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
        $country = PropertyCountry::findOrFail($id);
        $country->name = $request->name;
        $country->code = $request->code;

        $country->save();
        flash(translate('Property Country has been Updated successfully'))->success();
        return redirect()->route('property_countries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $property_country = PropertyCountry::findOrFail($id);

        $property_country->delete();

        flash(translate('Property Country has been deleted successfully'))->success();
        return redirect()->route('property_countries.index');
    }

    public function updateStatus(Request $request){
        $country = PropertyCountry::findOrFail($request->id);
        $country->status = $request->status;
        if($country->save()){
            return 1;
        }
        return 0;
    }
}
