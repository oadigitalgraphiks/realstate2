<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyTourType;
use App\Models\PropertyTourTypeTranslation;
use Illuminate\Support\Str;

class PropertyTourTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $property_tour_types = PropertyTourType::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $property_tour_types = $property_tour_types->where('name', 'like', '%'.$sort_search.'%');
        }
        $property_tour_types = $property_tour_types->paginate(15);
        return view('backend.product.property_tour_types.index', compact('property_tour_types', 'sort_search'));
    }

    public function create()
    {
        $property_tour_types = PropertyTourType::all();

        return view('backend.product.property_tour_types.create', compact('property_tour_types'));
    }

    public function store(Request $request)
    {
        $property_tour_type = new PropertyTourType;
        $property_tour_type->name = $request->name;
        $property_tour_type->icon = $request->icon;
        $property_tour_type->meta_title = $request->meta_title;
        $property_tour_type->meta_description = $request->meta_description;

        if ($request->slug != null) {
            $property_tour_type->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        }
        else {
            $property_tour_type->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }

        $property_tour_type->save();

        $property_tour_type_translation = PropertyTourTypeTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'property_tour_type_id' => $property_tour_type->id]);
        $property_tour_type_translation->name = $request->name;
        $property_tour_type_translation->save();

        flash(translate('Property Purpose has been inserted successfully'))->success();
        return redirect()->route('property_tour_types.index');
    }

    public function destroy($id)
    {
        $property_tour_types = PropertyTourType::findOrFail($id);

        $property_tour_types->delete();

        flash(translate('Property Baths has been deleted successfully'))->success();
        return redirect()->route('property_tour_types.index');
    }

    public function edit(Request $request, $id){

        $lang = $request->lang;
        $property_tour_type = PropertyTourType::findOrFail($id);
        return view('backend.product.property_tour_types.edit', compact('lang', 'property_tour_type'));
    }

    public function update(Request $request, $id){
        $property_tour_type = PropertyTourType::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $property_tour_type->name = $request->name;
        }
        $property_tour_type->icon = $request->icon;
        $property_tour_type->meta_title = $request->meta_title;
        $property_tour_type->meta_description = $request->meta_description;
        if ($request->slug != null) {
            $property_tour_type->slug = strtolower($request->slug);
        }
        else {
            $property_tour_type->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }

        $property_tour_type->save();


        $property_tour_type_translation = PropertyTourTypeTranslation::firstOrNew(['lang' => $request->lang, 'property_tour_type_id' => $property_tour_type->id]);
        $property_tour_type_translation->name = $request->name;
        $property_tour_type_translation->save();

        flash(translate('Property Type has been updated successfully'))->success();
        return redirect()->route('property_tour_types.index');
    }

    public function updateFeatured(Request $request)
    {
        $property_tour_type = PropertyTourType::findOrFail($request->id);
        $property_tour_type->featured = $request->status;
        $property_tour_type->save();
        Cache::forget('featured_property_tour_types');
        return 1;
    }
}
