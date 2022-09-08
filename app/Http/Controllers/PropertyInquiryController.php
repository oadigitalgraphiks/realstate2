<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyInquiry;
use App\Models\PropertyInquiryTranslation;
use Illuminate\Support\Str;

class PropertyInquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $property_inquiries = PropertyInquiry::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $property_inquiries = $property_inquiries->where('name', 'like', '%'.$sort_search.'%');
        }
        $property_inquiries = $property_inquiries->with(['agent.shop', 'property'])->paginate(15);
        // dd($property_inquiries);
        return view('backend.property.property_inquiries.index', compact('property_inquiries', 'sort_search'));
    }

    public function create()
    {
        $property_inquiries = PropertyInquiry::where('parent_id', 0)
            ->with('children')
            ->get();

        return view('backend.property.property_inquiries.create', compact('property_inquiries'));
    }

    public function store(Request $request)
    {
        $property_inquiry = new PropertyInquiry;
        $property_inquiry->name = $request->name;

        $property_inquiry->order_level = 0;
        if($request->order_level != null) {
            $property_inquiry->order_level = $request->order_level;
        }

        $property_inquiry->banner = $request->banner;
        $property_inquiry->small_banner = $request->small_banner;
        $property_inquiry->icon = $request->icon;
        $property_inquiry->meta_title = $request->meta_title;
        $property_inquiry->meta_description = $request->meta_description;

        if ($request->parent_id != "0") {
            $property_inquiry->parent_id = $request->parent_id;

            $parent = PropertyInquiry::find($request->parent_id);
            $property_inquiry->level = $parent->level + 1 ;
        }

        if ($request->slug != null) {
            $property_inquiry->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        }
        else {
            $property_inquiry->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }

        $property_inquiry->save();

        $property_inquiry_translation = PropertyInquiryTranslation::firstOrNew([
            'lang' => env('DEFAULT_LANGUAGE'), 
            'property_inquiry_id' => $property_inquiry->id
        ]);

        $property_inquiry_translation->name = $request->name;
        $property_inquiry_translation->save();

        flash(translate('Property Inquiry has been inserted successfully'))->success();
        return redirect()->route('property_inquiries.index');
    }

    public function destroy($id)
    {
        $property_inquiries = PropertyInquiry::findOrFail($id);
        $property_inquiries->delete();

        flash(translate('Property Inquiry has been deleted successfully'))->success();
        return redirect()->route('property_inquiries.index');

    }

    public function edit(Request $request, $id){

        $lang = $request->lang;
        $property_inquiry = PropertyInquiry::findOrFail($id);
        $property_inquiries = PropertyInquiry::where('parent_id', 0)
            ->with('children')
            ->orderBy('name','asc')
            ->get();

        return view('backend.property.property_inquiries.edit', compact('lang', 'property_inquiry', 'property_inquiries'));
    }

    public function update(Request $request, $id){
        $property_inquiry = PropertyInquiry::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $property_inquiry->name = $request->name;
        }
        if($request->order_level != null) {
            $property_inquiry->order_level = $request->order_level;
        }
        $property_inquiry->banner = $request->banner;
        $property_inquiry->small_banner = $request->small_banner;
        $property_inquiry->icon = $request->icon;
        $property_inquiry->meta_title = $request->meta_title;
        $property_inquiry->meta_description = $request->meta_description;

        $previous_level = $property_inquiry->level;

        if ($request->parent_id != "0") {
            $property_inquiry->parent_id = $request->parent_id;

            $parent = PropertyInquiry::find($request->parent_id);
            $property_inquiry->level = $parent->level + 1 ;
        }
        else{
            $property_inquiry->parent_id = 0;
            $property_inquiry->level = 0;
        }
        if ($request->slug != null) {
            $property_inquiry->slug = strtolower($request->slug);
        }
        else {
            $property_inquiry->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }

        $property_inquiry->save();
        $property_inquiry_translation = PropertyInquiryTranslation::firstOrNew(['lang' => $request->lang, 'property_inquiry_id' => $property_inquiry->id]);
        $property_inquiry_translation->name = $request->name;
        $property_inquiry_translation->save();

        flash(translate('Property Type has been updated successfully'))->success();
        return redirect()->route('property_inquiries.index');
    }

    public function updateFeatured(Request $request)
    {
        $property_inquiry = PropertyInquiry::findOrFail($request->id);
        $property_inquiry->featured = $request->status;
        $property_inquiry->save();
        Cache::forget('featured_product_inquiries');
        return 1;
    }
}
