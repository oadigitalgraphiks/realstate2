<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyReport;
use App\Models\PropertyReportTranslation;
use Illuminate\Support\Str;

class PropertyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $property_reports = PropertyReport::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $property_reports = $property_reports->where('name', 'like', '%'.$sort_search.'%');
        }
        $property_reports = $property_reports->with(['agent.shop', 'property'])->paginate(15);
        // dd($property_reports);
        return view('backend.property.property_reports.index', compact('property_reports', 'sort_search'));
    }

    public function create()
    {
        $property_reports = PropertyReport::where('parent_id', 0)
            ->with('children')
            ->get();

        return view('backend.property.property_reports.create', compact('property_reports'));
    }

    public function store(Request $request)
    {
        $property_report = new PropertyReport;
        $property_report->name = $request->name;

        $property_report->order_level = 0;
        if($request->order_level != null) {
            $property_report->order_level = $request->order_level;
        }

        $property_report->banner = $request->banner;
        $property_report->small_banner = $request->small_banner;
        $property_report->icon = $request->icon;
        $property_report->meta_title = $request->meta_title;
        $property_report->meta_description = $request->meta_description;

        if ($request->parent_id != "0") {
            $property_report->parent_id = $request->parent_id;

            $parent = PropertyReport::find($request->parent_id);
            $property_report->level = $parent->level + 1 ;
        }

        if ($request->slug != null) {
            $property_report->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        }
        else {
            $property_report->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }

        $property_report->save();

        $property_report_translation = PropertyReportTranslation::firstOrNew([
            'lang' => env('DEFAULT_LANGUAGE'), 
            'property_report_id' => $property_report->id
        ]);

        $property_report_translation->name = $request->name;
        $property_report_translation->save();

        flash(translate('Property report has been inserted successfully'))->success();
        return redirect()->route('property_reports.index');
    }

    public function destroy($id)
    {
        $property_reports = PropertyReport::findOrFail($id);
        $property_reports->delete();

        flash(translate('Property report has been deleted successfully'))->success();
        return redirect()->route('property_reports.index');

    }

    public function edit(Request $request, $id){

        $lang = $request->lang;
        $property_report = PropertyReport::findOrFail($id);
        $property_reports = PropertyReport::where('parent_id', 0)
            ->with('children')
            ->orderBy('name','asc')
            ->get();

        return view('backend.property.property_reports.edit', compact('lang', 'property_report', 'property_reports'));
    }

    public function update(Request $request, $id){
        $property_report = PropertyReport::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $property_report->name = $request->name;
        }
        if($request->order_level != null) {
            $property_report->order_level = $request->order_level;
        }
        $property_report->banner = $request->banner;
        $property_report->small_banner = $request->small_banner;
        $property_report->icon = $request->icon;
        $property_report->meta_title = $request->meta_title;
        $property_report->meta_description = $request->meta_description;

        $previous_level = $property_report->level;

        if ($request->parent_id != "0") {
            $property_report->parent_id = $request->parent_id;

            $parent = PropertyReport::find($request->parent_id);
            $property_report->level = $parent->level + 1 ;
        }
        else{
            $property_report->parent_id = 0;
            $property_report->level = 0;
        }
        if ($request->slug != null) {
            $property_report->slug = strtolower($request->slug);
        }
        else {
            $property_report->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }

        $property_report->save();
        $property_report_translation = PropertyReportTranslation::firstOrNew(['lang' => $request->lang, 'property_report_id' => $property_report->id]);
        $property_report_translation->name = $request->name;
        $property_report_translation->save();

        flash(translate('Property Type has been updated successfully'))->success();
        return redirect()->route('property_reports.index');
    }

    public function updateFeatured(Request $request)
    {
        $property_report = PropertyReport::findOrFail($request->id);
        $property_report->featured = $request->status;
        $property_report->save();
        Cache::forget('featured_product_reports');
        return 1;
    }
}
