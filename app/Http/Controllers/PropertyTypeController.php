<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyType;
use App\Models\PropertyTypeTranslation;
use Illuminate\Support\Str;

class PropertyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $property_type = PropertyType::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $property_type = $property_type->where('name', 'like', '%'.$sort_search.'%');
        }
        $property_type = $property_type->paginate(15);
        // dd($property_type);
        // die;
        return view('backend.product.property_types.index', compact('property_type', 'sort_search'));
    }

    public function create()
    {
        $property_type = PropertyType::where('parent_id', 0)
            ->with('childrenProperties')
            ->get();

        return view('backend.product.property_types.create', compact('property_type'));
    }

    public function store(Request $request)
    {
        $property_type = new PropertyType;
        $property_type->name = $request->name;
        $property_type->order_level = 0;
        if($request->order_level != null) {
            $property_type->order_level = $request->order_level;
        }
        $property_type->banner = $request->banner;
        $property_type->small_banner = $request->small_banner;
        $property_type->icon = $request->icon;
        $property_type->meta_title = $request->meta_title;
        $property_type->meta_description = $request->meta_description;

        if ($request->parent_id != "0") {
            $property_type->parent_id = $request->parent_id;

            $parent = PropertyType::find($request->parent_id);
            $property_type->level = $parent->level + 1 ;
        }

        if ($request->slug != null) {
            $property_type->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        }
        else {
            $property_type->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }
        if ($request->commision_rate != null) {
            $property_type->commision_rate = $request->commision_rate;
        }

        $property_type->save();

        $property_type_translation = PropertyTypeTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'property_type_id' => $property_type->id]);
        $property_type_translation->name = $request->name;
        $property_type_translation->save();

        flash(translate('Property Type has been inserted successfully'))->success();
        return redirect()->route('product.property_type');
    }

    public function destroy($id)
    {
        $property_type = PropertyType::findOrFail($id);

        $property_type->delete();

        flash(translate('Property Type has been deleted successfully'))->success();
        return redirect()->route('product.property_type');
    }

    public function edit(Request $request, $id){

        $lang = $request->lang;
        $property_type = PropertyType::findOrFail($id);
        $property_types = PropertyType::where('parent_id', 0)
            ->with('childrenProperties')
            ->orderBy('name','asc')
            ->get();

        return view('backend.product.property_types.edit', compact('lang', 'property_type', 'property_types'));
    }

    public function update(Request $request, $id){
        $property_type = PropertyType::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $property_type->name = $request->name;
        }
        if($request->order_level != null) {
            $property_type->order_level = $request->order_level;
        }
        $property_type->banner = $request->banner;
        $property_type->small_banner = $request->small_banner;
        $property_type->icon = $request->icon;
        $property_type->meta_title = $request->meta_title;
        $property_type->meta_description = $request->meta_description;

        $previous_level = $property_type->level;

        if ($request->parent_id != "0") {
            $property_type->parent_id = $request->parent_id;

            $parent = PropertyType::find($request->parent_id);
            $property_type->level = $parent->level + 1 ;
        }
        else{
            $property_type->parent_id = 0;
            $property_type->level = 0;
        }
        if ($request->slug != null) {
            $property_type->slug = strtolower($request->slug);
        }
        else {
            $property_type->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }

        $property_type->save();


        $property_type_translation = PropertyTypeTranslation::firstOrNew(['lang' => $request->lang, 'property_type_id' => $property_type->id]);
        $property_type_translation->name = $request->name;
        $property_type_translation->save();

        flash(translate('Property Type has been updated successfully'))->success();
        return redirect()->route('product.property_type');
    }

    public function updateFeatured(Request $request)
    {
        $property_type = PropertyType::findOrFail($request->id);
        $property_type->featured = $request->status;
        $property_type->save();
        Cache::forget('featured_product_types');
        return 1;
    }
}
