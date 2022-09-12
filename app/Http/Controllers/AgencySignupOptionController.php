<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgencySignupOption;
use Illuminate\Support\Str;

class AgencySignupOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $agency_signup_options = AgencySignupOption::orderBy('sorting_id', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $agency_signup_options = $agency_signup_options->where('name', 'like', '%'.$sort_search.'%');
        }
        $agency_signup_options = $agency_signup_options->paginate(15);
        return view('backend.sellers.signup_options.index', compact('agency_signup_options', 'sort_search'));
    }

    public function create()
    {
        $agency_signup_options = AgencySignupOption::where('parent', 0)
            ->with('children')
            ->get();

        return view('backend.sellers.signup_options.create', compact('agency_signup_options'));
    }

    public function store(Request $request)
    {
        $agency_signup_option = new AgencySignupOption;
        $agency_signup_option->name = $request->name;
        $agency_signup_option->parent = $request->parent;
        $agency_signup_option->sorting_id = 0;
        if($request->order_level != null) {
            $agency_signup_option->sorting_id = $request->order_level;
        }
        if ($request->slug != null) {
            $agency_signup_option->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        }
        else {
            $agency_signup_option->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }

        $agency_signup_option->save();

        flash(translate('Signup Option has been created successfully'))->success();
        return redirect()->route('agency_signup_options.index');
    }

    public function destroy($id)
    {
        $agency_signup_options = AgencySignupOption::findOrFail($id);
        $agency_signup_options->delete();

        flash(translate('Property Purpose has been deleted successfully'))->success();
        return redirect()->route('agency_signup_options.index');

    }

    public function edit(Request $request, $id){

        $lang = $request->lang;
        $agency_signup_option = AgencySignupOption::findOrFail($id);
        $agency_signup_options = AgencySignupOption::where('parent', 0)
            ->with('children')
            ->orderBy('name','asc')
            ->get();

        return view('backend.sellers.signup_options.edit', compact('lang', 'agency_signup_option', 'agency_signup_options'));
    }

    public function update(Request $request, $id){
        $agency_signup_option = AgencySignupOption::findOrFail($id);
        $agency_signup_option->name = $request->name;
        if($request->order_level != null) {
            $agency_signup_option->sorting_id = $request->order_level;
        }

        $previous_level = $agency_signup_option->level;
        $agency_signup_option->parent = $request->parent;

        if ($request->slug != null) {
            $agency_signup_option->slug = strtolower($request->slug);
        }
        else {
            $agency_signup_option->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }

        $agency_signup_option->save();

        flash(translate('Agent Signup Option has been updated successfully'))->success();
        return redirect()->route('agency_signup_options.index');
    }

    public function updateFeatured(Request $request)
    {
        $agency_signup_option = AgencySignupOption::findOrFail($request->id);
        $agency_signup_option->featured = $request->status;
        $agency_signup_option->save();
        Cache::forget('featured_product_purposes');
        return 1;
    }
}
