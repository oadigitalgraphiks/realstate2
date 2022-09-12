<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyCondition;
use App\Models\PropertyConditionTranslation;
use Illuminate\Support\Str;

class PropertyConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $property_conditions = PropertyCondition::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $property_conditions = $property_conditions->where('name', 'like', '%'.$sort_search.'%');
        }
        $property_conditions = $property_conditions->paginate(15);
        return view('backend.product.property_conditions.index', compact('property_conditions', 'sort_search'));
    }

    public function create()
    {
        return view('backend.product.property_conditions.create');
    }

    public function store(Request $request)
    {
        $property_condition = new PropertyCondition;
        $property_condition->name = $request->name;
        $property_condition->save();

        $property_condition_translation = PropertyConditionTranslation::firstOrNew([
            'lang' => env('DEFAULT_LANGUAGE'), 
            'property_condition_id' => $property_condition->id
        ]);

        $property_condition_translation->name = $request->name;
        $property_condition_translation->save();

        flash(translate('Property condition has been inserted successfully'))->success();
        return redirect()->route('property_conditions.index');
    }

    public function destroy($id)
    {
        $property_conditions = PropertyCondition::findOrFail($id);
        $property_conditions->delete();

        flash(translate('Property condition has been deleted successfully'))->success();
        return redirect()->route('property_conditions.index');

    }

    public function edit(Request $request, $id){

        $lang = $request->lang;
        $property_condition = PropertyCondition::findOrFail($id);
        return view('backend.product.property_conditions.edit', compact('lang', 'property_condition'));
    }

    public function update(Request $request, $id){
        $property_condition = PropertyCondition::findOrFail($id);
        $property_condition->name = $request->name;
        $property_condition->save();
        $property_condition_translation = PropertyConditionTranslation::firstOrNew(['lang' => $request->lang, 'property_condition_id' => $property_condition->id]);
        $property_condition_translation->name = $request->name;
        $property_condition_translation->lang = $request->lang; 
        $property_condition_translation->save();

        flash(translate('Property Type has been updated successfully'))->success();
        return redirect()->route('property_conditions.index');
    }

    public function updateFeatured(Request $request)
    {
        $property_condition = PropertyCondition::findOrFail($request->id);
        $property_condition->featured = $request->status;
        $property_condition->save();
        Cache::forget('featured_product_conditions');
        return 1;
    }
}
