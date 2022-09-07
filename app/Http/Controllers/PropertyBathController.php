<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyBath;
use App\Models\PropertyBathTranslation;
use Illuminate\Support\Str;

class PropertyBathController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $property_baths = PropertyBath::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $property_baths = $property_baths->where('name', 'like', '%'.$sort_search.'%');
        }
        $property_baths = $property_baths->paginate(15);
        return view('backend.product.property_baths.index', compact('property_baths', 'sort_search'));
    }

    public function create()
    {
        $property_baths = PropertyBath::all();

        return view('backend.product.property_baths.create', compact('property_baths'));
    }

    public function store(Request $request)
    {
        $property_bath = new PropertyBath;
        $property_bath->name = $request->name;
        $property_bath->order_level = 0;
        if($request->order_level != null) {
            $property_bath->order_level = $request->order_level;
        }
        $property_bath->banner = $request->banner;
        $property_bath->small_banner = $request->small_banner;
        $property_bath->icon = $request->icon;
        $property_bath->meta_title = $request->meta_title;
        $property_bath->meta_description = $request->meta_description;

        if ($request->slug != null) {
            $property_bath->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        }
        else {
            $property_bath->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }

        $property_bath->save();

        $property_bath_translation = PropertyBathTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'property_bath_id' => $property_bath->id]);
        $property_bath_translation->name = $request->name;
        $property_bath_translation->save();

        flash(translate('Property Purpose has been inserted successfully'))->success();
        return redirect()->route('property_baths.index');
    }

    public function destroy($id)
    {
        $property_baths = PropertyBath::findOrFail($id);

        $property_baths->delete();

        flash(translate('Property Baths has been deleted successfully'))->success();
        return redirect()->route('property_baths.index');
    }

    public function edit(Request $request, $id){

        $lang = $request->lang;
        $property_bath = PropertyBath::findOrFail($id);
        return view('backend.product.property_baths.edit', compact('lang', 'property_bath'));
    }

    public function update(Request $request, $id){
        $property_bath = PropertyBath::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $property_bath->name = $request->name;
        }
        if($request->order_level != null) {
            $property_bath->order_level = $request->order_level;
        }
        $property_bath->banner = $request->banner;
        $property_bath->small_banner = $request->small_banner;
        $property_bath->icon = $request->icon;
        $property_bath->meta_title = $request->meta_title;
        $property_bath->meta_description = $request->meta_description;

        $previous_level = $property_bath->level;
        if ($request->slug != null) {
            $property_bath->slug = strtolower($request->slug);
        }
        else {
            $property_bath->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }

        $property_bath->save();


        $property_bath_translation = PropertyBathTranslation::firstOrNew(['lang' => $request->lang, 'property_bath_id' => $property_bath->id]);
        $property_bath_translation->name = $request->name;
        $property_bath_translation->save();

        flash(translate('Property Type has been updated successfully'))->success();
        return redirect()->route('property_baths.index');
    }

    public function updateFeatured(Request $request)
    {
        $property_bath = PropertyBath::findOrFail($request->id);
        $property_bath->featured = $request->status;
        $property_bath->save();
        Cache::forget('featured_property_baths');
        return 1;
    }
}
