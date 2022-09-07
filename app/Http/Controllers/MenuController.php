<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\HomeMenu;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Language;
use App\Models\MenuTranslation;
use App\Utility\MenuUtility;
use Illuminate\Support\Str;

class MenuController extends Controller
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
        // $menu_id = getMenuIdForPermission($this->current_route);

        // if(auth()->user()->user_type != 'admin' && !menu_permissions($menu_id)){
        //     return redirect()->route('backend.no-rights');
        // }

        $sort_search = null;
        //        $categories = Category::orderBy('name', 'asc');
        $menus = Menu::orderBy('order_level', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $menus = $menus->where('name', 'like', '%' . $sort_search . '%');
        }
        $menus = $menus->paginate(15);
        //dd($menus);
        //echo "<pre>";var_dump($menus);die();
        return view('manage_menu.index', compact('menus', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu = new Menu;
        $menu->name = $request->name;
        $menu->parent_id = 0;
        $menu->status = 0;
        $menu->menu_id = $request->menu_id;
        $menu->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)) . '-' . Str::random(5);
        $menu->save();
        // $menu_translation = MenuTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'menu_id' => $request->menu_id]);
        //        $menu_translation->name = $request->name;
        //        $menu_translation->save();



        flash(translate('Menu has been inserted successfully'))->success();
        return back();
        // return redirect()->route('manage.menus');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request)
    {
        //$menu_id = getMenuIdForPermission($this->current_route);
        //
        //        if(auth()->user()->user_type != 'admin' && !frontend_permissions($this->current_route)){
        //        return redirect()->route('backend.no-rights');
        //        }

        $lang = $request->lang;
        $menu = Menu::findOrFail($request->id);
        $categories = Category::where('parent_id', 0)
            ->with('childrenCategories')
            ->orderBy('name', 'asc')
            ->get();
        //dd($categories);
        $brands = Brand::orderby('name', 'ASC')->get();
        return view('manage_menu.edit', compact('menu', 'lang', 'categories', 'brands'));
    }


    public function chnagelang(Request $request)
    {
        //$menu_id = getMenuIdForPermission($this->current_route);

        //  if(auth()->user()->user_type != 'admin' && !frontend_permissions($this->current_route)){
        //            return redirect()->route('backend.no-rights');
        //        }
        //dd($request);
        $lang = $request->lang;
        $menu = Menu::findOrFail($request->id);
        $categories = Category::where('parent_id', 0)
            ->with('childrenCategories')
            ->orderBy('name', 'asc')
            ->get();
        //dd($lang);
        $brands = Brand::orderby('name', 'ASC')->get();
        return view('manage_menu.edit', compact('menu', 'lang', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $id = $request->id;
        //dd($id);
        $menu = Menu::findOrFail($id);
        if ($request->lang == env("DEFAULT_LANGUAGE")) {
            $menu->name = $request->name;
        }
        //dd($menu);
        $menu->type = $request->type;

        $menu->menu_type = $request->menu_type;
        $menu->target = $request->target;
        if (isset($request->status)) {
            $menu->status = $request->status;
        }else{
            $menu->status = 0;
        }
        $menu->category_id = $request->category_id;
        $menu->brand_id = $request->brand_id;
        $menu->url = $request->url;

        //dd($menu);
        $menu->save();
        $menu_translation = MenuTranslation::firstOrNew(['lang' => $request->lang, 'menu_id' => $menu->id]);
        $menu_translation->name = $request->name;
        $menu_translation->save();



        flash(translate('Menu has been updated successfully'))->success();
        return redirect(route("manage.menus") . "?id=" . $request->main_menu_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $menu_id = getMenuIdForPermission($this->current_route);

        // if(auth()->user()->user_type != 'admin' && !frontend_permissions($this->current_route)){
        //     return redirect()->route('backend.no-rights');
        // }

        $menu = Menu::findOrFail($id);

        // Category Translations Delete
        foreach ($menu->menu_translations as $key => $menu_translation) {
            $menu_translation->delete();
        }

        MenuUtility::delete_menu($id);


        flash(translate('Menu has been deleted successfully'))->success();
        return back();
    }
}
