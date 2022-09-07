<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyPurpose;
use App\Models\PropertyPurposeTranslation;
use Illuminate\Support\Str;

class PropertyPurposeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $property_purposes = PropertyPurpose::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $property_purposes = $property_purposes->where('name', 'like', '%'.$sort_search.'%');
        }
        $property_purposes = $property_purposes->paginate(15);
        return view('backend.product.property_purposes.index', compact('property_purposes', 'sort_search'));
    }

    public function create()
    {
        $property_purposes = PropertyPurpose::where('parent_id', 0)
            ->with('children')
            ->get();

        return view('backend.product.property_purposes.create', compact('property_purposes'));
    }

    public function store(Request $request)
    {
        $property_purpose = new PropertyPurpose;
        $property_purpose->name = $request->name;

        $property_purpose->order_level = 0;
        if($request->order_level != null) {
            $property_purpose->order_level = $request->order_level;
        }

        $property_purpose->banner = $request->banner;
        $property_purpose->small_banner = $request->small_banner;
        $property_purpose->icon = $request->icon;
        $property_purpose->meta_title = $request->meta_title;
        $property_purpose->meta_description = $request->meta_description;

        if ($request->parent_id != "0") {
            $property_purpose->parent_id = $request->parent_id;

            $parent = PropertyPurpose::find($request->parent_id);
            $property_purpose->level = $parent->level + 1 ;
        }

        if ($request->slug != null) {
            $property_purpose->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        }
        else {
            $property_purpose->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }

        $property_purpose->save();

        $property_purpose_translation = PropertyPurposeTranslation::firstOrNew([
            'lang' => env('DEFAULT_LANGUAGE'), 
            'property_purpose_id' => $property_purpose->id
        ]);

        $property_purpose_translation->name = $request->name;
        $property_purpose_translation->save();

        flash(translate('Property Purpose has been inserted successfully'))->success();
        return redirect()->route('property_purposes.index');
    }

    public function destroy($id)
    {
        $property_purposes = PropertyPurpose::findOrFail($id);
        $property_purposes->delete();

        flash(translate('Property Purpose has been deleted successfully'))->success();
        return redirect()->route('property_purposes.index');

    }

    public function edit(Request $request, $id){

        $lang = $request->lang;
        $property_purpose = PropertyPurpose::findOrFail($id);
        $property_purposes = PropertyPurpose::where('parent_id', 0)
            ->with('children')
            ->orderBy('name','asc')
            ->get();

        return view('backend.product.property_purposes.edit', compact('lang', 'property_purpose', 'property_purposes'));
    }

    public function update(Request $request, $id){
        $property_purpose = PropertyPurpose::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $property_purpose->name = $request->name;
        }
        if($request->order_level != null) {
            $property_purpose->order_level = $request->order_level;
        }
        $property_purpose->banner = $request->banner;
        $property_purpose->small_banner = $request->small_banner;
        $property_purpose->icon = $request->icon;
        $property_purpose->meta_title = $request->meta_title;
        $property_purpose->meta_description = $request->meta_description;

        $previous_level = $property_purpose->level;

        if ($request->parent_id != "0") {
            $property_purpose->parent_id = $request->parent_id;

            $parent = PropertyPurpose::find($request->parent_id);
            $property_purpose->level = $parent->level + 1 ;
        }
        else{
            $property_purpose->parent_id = 0;
            $property_purpose->level = 0;
        }
        if ($request->slug != null) {
            $property_purpose->slug = strtolower($request->slug);
        }
        else {
            $property_purpose->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }

        $property_purpose->save();
        $property_purpose_translation = PropertyPurposeTranslation::firstOrNew(['lang' => $request->lang, 'property_purpose_id' => $property_purpose->id]);
        $property_purpose_translation->name = $request->name;
        $property_purpose_translation->save();

        flash(translate('Property Type has been updated successfully'))->success();
        return redirect()->route('property_purposes.index');
    }

    public function updateFeatured(Request $request)
    {
        $property_purpose = PropertyPurpose::findOrFail($request->id);
        $property_purpose->featured = $request->status;
        $property_purpose->save();
        Cache::forget('featured_product_purposes');
        return 1;
    }
}
