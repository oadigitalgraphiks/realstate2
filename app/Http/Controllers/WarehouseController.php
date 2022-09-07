<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\WarehouseTranslation;
use App\Models\Product;
use Illuminate\Support\Str;

class WarehouseController extends Controller
{

    protected $current_route;

    public function __construct()
    {
        $this->current_route = \Request::route()->getName();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menu_id = getMenuIdForPermission($this->current_route);

        if(auth()->user()->user_type != 'admin' && !menu_permissions($menu_id)){
            return redirect()->route('backend.no-rights');
        }

        $sort_search =null;
        $warehouse = Warehouse::orderBy('name', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $warehouses = $warehouse->where('name', 'like', '%'.$sort_search.'%');
        }
        $warehouses = $warehouse->paginate(15);
        return view('warehouse.index', compact('warehouses', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu_id = getMenuIdForPermission($this->current_route);

        if(auth()->user()->user_type != 'admin' && !frontend_permissions($this->current_route)){
            return redirect()->route('backend.no-rights');
        }

        $countries = Country::where('status', 1)->get();

        return view('warehouse.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;

        $warehouse                  =   new Warehouse;
        $warehouse->code            =   $request->code;
        $warehouse->name            =   $request->name;
        $warehouse->logo            =   $request->logo;
        $warehouse->address         =   $request->address;
        $warehouse->country         =   $request->country;
        $warehouse->city            =   $request->city;
        $warehouse->area            =   $request->area;
        $warehouse->postal_code     =   $request->postal_code;
        $warehouse->phone           =   $request->phone;
        $warehouse->shipping_rule   =   $request->shipping_rule;
		$warehouse->email           =   $request->email;
        $warehouse->staff_ids       = json_encode($request->staff_ids);

        if($request->has('country_id') && !empty($request->has('country_id'))){
            $warehouse->shipping_country_id =json_encode($request->country_id);
			$all_country_code=array();
			foreach($request->country_id as $cid){
			$country_lists = Country::where('id', $cid)->first();
				//dd($country_lists[0]->code);
				array_push($all_country_code,$country_lists->code);
			}
			$warehouse->shipping_country_code =json_encode($all_country_code);
        }else {
            $country_id = array();
            $warehouse->shipping_country_id = json_encode($country_id);
			$warehouse->shipping_country_code= json_encode($country_id);
        }

        $warehouse->meta_title      =   $request->meta_title;
        $warehouse->meta_description=   $request->meta_description;

        if ($request->slug != null) {
            $warehouse->slug = str_replace(' ', '-', $request->slug);
        }else {
            $warehouse->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }

        $warehouse->save();

        $warehouse_translation = WarehouseTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'warehouse_id' => $warehouse->id]);
        $warehouse_translation->name = $request->name;
        $warehouse_translation->save();

        flash(translate('Warehouse has been inserted successfully'))->success();

        return redirect()->route('warehouse.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $menu_id = getMenuIdForPermission($this->current_route);

        if(auth()->user()->user_type != 'admin' && !frontend_permissions($this->current_route)){
            return redirect()->route('backend.no-rights');
        }

        $lang   = $request->lang;

        $warehouse  = Warehouse::findOrFail($id);
        $countries = Country::where('status', 1)->get();

        return view('warehouse.edit', compact('warehouse','lang','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $warehouse = Warehouse::findOrFail($id);

        $warehouse->code            =   $request->code;

        if($request->lang == env("DEFAULT_LANGUAGE")){
            $warehouse->name = $request->name;
        }

        $warehouse->logo            =   $request->logo;
        $warehouse->address         =   $request->address;
        $warehouse->country         =   $request->country;
        $warehouse->city            =   $request->city;
        $warehouse->area            =   $request->area;
        $warehouse->postal_code     =   $request->postal_code;
        $warehouse->phone           =   $request->phone;
        $warehouse->shipping_rule   =   $request->shipping_rule;
		$warehouse->email           =   $request->email;
        $warehouse->staff_ids       = json_encode($request->staff_ids);

        if($request->has('country_id') && !empty($request->has('country_id'))){
            $warehouse->shipping_country_id =json_encode($request->country_id);
			$all_country_code=array();
			foreach($request->country_id as $cid){
			$country_lists = Country::where('id', $cid)->first();
				//dd($country_lists[0]->code);
				array_push($all_country_code,$country_lists->code);
			}
			$warehouse->shipping_country_code =json_encode($all_country_code);
        }else {
            $country_id = array();
            $warehouse->shipping_country_id = json_encode($country_id);
			$warehouse->shipping_country_code= json_encode($country_id);
        }

        $warehouse->meta_title      =   $request->meta_title;
        $warehouse->meta_description=   $request->meta_description;

        $warehouse->meta_title = $request->meta_title;
        $warehouse->meta_description = $request->meta_description;

        if ($request->slug != null) {
            $warehouse->slug = strtolower($request->slug);
        }else {
            $warehouse->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }

        $warehouse->save();

        $warehouse_translation = WarehouseTranslation::firstOrNew(['lang' => $request->lang, 'warehouse_id' => $warehouse->id]);
        $warehouse_translation->name = $request->name;
        $warehouse_translation->save();

        flash(translate('Warehouse has been updated successfully'))->success();
        return back();

    }

    public function bulk_warehouse_edit(Request $request) {
        // return $request;
        if($request->ids) {
	        $warehouse=explode(',',$request->ids);

		    foreach ($warehouse as $warehouse_id) {
               //$this->destroy($warehouse_id);
			    $warehouse = Warehouse::findOrFail($warehouse_id);

				if($request->shipping_rule){
					$warehouse->shipping_rule   = $request->shipping_rule;
				}

				if($request->country_id){
					$all_country_code=array();
					$warehouse->shipping_country_id   = json_encode($request->country_id);
					foreach($request->country_id as $cid){
                        $country_lists = Country::where('id', $cid)->first();
                        array_push($all_country_code,$country_lists->code);
					}
					$warehouse->shipping_country_code =json_encode($all_country_code);
				}

				$warehouse->save();
			   //dd($warehouse);

            }

        }
  		return redirect()->route('warehouse.index');
    }

    public function bulk_warehouse_delete(Request $request) {
        if($request->id) {
            foreach ($request->id as $warehouse_id) {
                $productCount = Product::where('warehouse_id', $warehouse_id)->get()->count();

                if ($productCount > 0) {
                    return 0;
                }
                $this->destroy($warehouse_id);
            }
        }

        return 1;
    }

    /**
     * Duplicates the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function duplicate(Request $request, $id)
    {
        $menu_id = getMenuIdForPermission($this->current_route);

        if(auth()->user()->user_type != 'admin' && !frontend_permissions($this->current_route)){
            return redirect()->route('backend.no-rights');
        }

        $warehouse = Warehouse::find($id);

        $warehouse_new = $warehouse->replicate();
        $warehouse_new->slug = substr($warehouse_new->slug, 0, -5).Str::random(5);
        $warehouse_new->save();

        loggs('Duplicated Warehouse: '.$warehouse->name);

        flash(translate('Warehouse has been duplicated successfully'))->success();

        return redirect()->route('warehouse.index');

    }

    public function status(Request $request)
    {
        $warehouse = Warehouse::findOrFail($request->id);
        $warehouse->status = $request->status;
        if ($warehouse->save()) {

            return 1;
        }
        return 0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu_id = getMenuIdForPermission($this->current_route);

        if(auth()->user()->user_type != 'admin' && !frontend_permissions($this->current_route)){
            return redirect()->route('backend.no-rights');
        }

        $warehouse = Warehouse::findOrFail($id);
        $productCount = Product::where('warehouse_id', $warehouse->id)->get()->count();

        if ($productCount > 0) {
            flash(translate('Sorry! This Warehouse have Products'))->error();

            return redirect()->route('warehouse.index');
        }
        WarehouseTranslation::where('warehouse_id', $warehouse->id)->delete();

        $warehouse->delete();

        flash(translate('Warehouse has been deleted successfully'))->success();
        return redirect()->route('warehouse.index');

    }
}
