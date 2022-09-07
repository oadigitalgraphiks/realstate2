<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyBed;
use App\Models\PropertyBedTranslation;
use Illuminate\Support\Str;

class PropertyBedController extends Controller
{

    /*
     * Display a listing of the resource
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $sort_search =null;
        $property_bed = PropertyBed::orderBy('id', 'desc');

        if($request->has('search')){
            $sort_search = $request->search;
            $property_bed = $property_bed->where('name', 'like', '%'.$sort_search.'%');
        }

        $property_bed = $property_bed->paginate(15);
        return view('backend.product.property_beds.index', compact('property_bed', 'sort_search'));
    }


    public function create()
    {
        
      return view('backend.product.property_beds.create');
    }

    public function store(Request $request)
    {

        // dd($request->all());

        $property_bed = new PropertyBed;
        $property_bed->name = $request->name;
        $property_bed->order_level = 0;
        if($request->order_level != null) {
            $property_bed->order_level = $request->order_level;
        }
        $property_bed->banner = $request->banner;
        $property_bed->small_banner = $request->small_banner;
        $property_bed->icon = $request->icon;
        $property_bed->meta_title = $request->meta_title;
        $property_bed->meta_description = $request->meta_description;

        if ($request->slug != null) {
            $property_bed->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        }
        else {
            $property_bed->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }
        if ($request->commision_rate != null) {
            $property_bed->commision_rate = $request->commision_rate;
        }

        $property_bed->save();

        $property_bed_translation = PropertyBedTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'property_bed_id' => $property_bed->id]);
        $property_bed_translation->name = $request->name;
        $property_bed_translation->save();

        flash(translate('Property Bed has been inserted successfully'))->success();
        return redirect()->route('product.property_bed');
    }

    public function destroy($id)
    {
        $property_bed = PropertyBed::findOrFail($id);

        $property_bed->delete();

        flash(translate('Property Bed has been deleted successfully'))->success();
        return redirect()->route('product.property_bed');
    }

    public function edit(Request $request, $id){

        $lang = $request->lang;
        $property_bed = PropertyBed::findOrFail($id);
        $property_beds = PropertyBed::orderBy('name','asc')->get();

        return view('backend.product.property_beds.edit', compact('lang', 'property_bed', 'property_beds'));
    }

    public function update(Request $request, $id){

        // dd($request->all());


        $property_bed = PropertyBed::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $property_bed->name = $request->name;
        }

        if($request->order_level != null) {
            $property_bed->order_level = $request->order_level;
        }

        $property_bed->banner = $request->banner;
        $property_bed->small_banner = $request->small_banner;
        $property_bed->icon = $request->icon;
        $property_bed->meta_title = $request->meta_title;
        $property_bed->meta_description = $request->meta_description;

        if ($request->slug != null) {
            $property_bed->slug = strtolower($request->slug);
        }
        else {
            $property_bed->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }

        $property_bed->save();

        $property_bed_translation = PropertyBedTranslation::firstOrNew(['lang' => $request->lang, 'property_bed_id' => $property_bed->id]);
        $property_bed_translation->name = $request->name;
        $property_bed_translation->save();

        flash(translate('Property Bed has been updated successfully'))->success();
        return redirect()->route('product.property_bed');
    }

    public function updateFeatured(Request $request)
    {
        $property_type = PropertyBed::findOrFail($request->id);
        $property_type->featured = $request->status;
        $property_type->save();
        Cache::forget('featured_product_beds');
        return 1;
    }
}
