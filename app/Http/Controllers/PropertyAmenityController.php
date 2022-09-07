<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyAmenity;
use App\Models\PropertyAmenityTranslation;
use Illuminate\Support\Str;

class PropertyAmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $property_amenities = PropertyAmenity::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $property_amenities = $property_amenities->where('name', 'like', '%'.$sort_search.'%');
        }
        $property_amenities = $property_amenities->paginate(15);
        return view('backend.product.property_amenities.index', compact('property_amenities', 'sort_search'));
    }

    public function create()
    {
        $property_amenities = PropertyAmenity::all();

        return view('backend.product.property_amenities.create', compact('property_amenities'));
    }

    public function store(Request $request)
    {
        $property_amenity = new PropertyAmenity;
        $property_amenity->name = $request->name;

        $property_amenity->save();

        $property_amenity_translation = PropertyAmenityTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'property_amenity_id' => $property_amenity->id]);
        $property_amenity_translation->name = $request->name;
        $property_amenity_translation->save();

        flash(translate('Property Amenity has been inserted successfully'))->success();
        return redirect()->route('property_amenities.index');
    }

    public function destroy($id)
    {
        $property_amenities = PropertyAmenity::findOrFail($id);

        $property_amenities->delete();

        flash(translate('Property Amenity has been deleted successfully'))->success();
        return redirect()->route('property_amenities.index');
    }

    public function edit(Request $request, $id){

        $lang = $request->lang;
        $property_amenity = PropertyAmenity::findOrFail($id);
        return view('backend.product.property_amenities.edit', compact('lang', 'property_amenity'));
    }

    public function update(Request $request, $id){
        $property_amenity = PropertyAmenity::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $property_amenity->name = $request->name;
        }

        $property_amenity->save();


        $property_amenity_translation = PropertyAmenityTranslation::firstOrNew(['lang' => $request->lang, 'property_amenity_id' => $property_amenity->id]);
        $property_amenity_translation->name = $request->name;
        $property_amenity_translation->save();

        flash(translate('Property Type has been updated successfully'))->success();
        return redirect()->route('property_amenities.index');
    }

    public function updateFeatured(Request $request)
    {
        $property_amenity = PropertyAmenity::findOrFail($request->id);
        $property_amenity->featured = $request->status;
        $property_amenity->save();
        Cache::forget('featured_property_amenities');
        return 1;
    }
}
