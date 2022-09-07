<?php

namespace App\Http\Controllers;

use App\Models\AdminMenu;
use App\Models\AdminMenuTranslation;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
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
        //        $categories = Category::orderBy('name', 'asc');
        $admin_menus = AdminMenu::orderBy('sort', 'asc');

        if ($request->has('search')){
            $sort_search = $request->search;
            $admin_menus = $admin_menus->where('name', 'like', '%'.$sort_search.'%');
        }
        $admin_menus = $admin_menus->paginate(15);

        return view('backend.system.admin_menus.index', compact('admin_menus', 'sort_search'));
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

        $admin_menus = AdminMenu::where('parent_id', 0)
            ->with('childrens')
            ->get();

        return view('backend.system.admin_menus.create', compact('admin_menus'));
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
        $admin_menu                 =   new AdminMenu;
        $admin_menu->parent_id      =   $request->parent_id;
        $admin_menu->name           =   $request->name;
        $admin_menu->icon_class     =   $request->icon_class;
        $admin_menu->route          =   $request->route;
        $admin_menu->addon_name     =   $request->addon_name;
        $admin_menu->sort           =   $request->sort;
        $admin_menu->save();

        $admin_menu_translation = AdminMenuTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'admin_menu_id' => $admin_menu->id]);
        $admin_menu_translation->name = $request->name;
        $admin_menu_translation->save();

        flash(translate('Admin Menu has been inserted successfully'))->success();

        return redirect()->route('admin_menu.index');
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

        $lang = $request->lang;
        $adminMenu = AdminMenu::findOrFail($id);

        $admin_menus = AdminMenu::where('parent_id', 0)
            ->with('childrens')
            ->get();

        return view('backend.system.admin_menus.edit', compact('adminMenu', 'admin_menus', 'lang'));
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
        $admin_menu = AdminMenu::findOrFail($id);

        $admin_menu->parent_id = $request->parent_id;

        if($request->lang == env("DEFAULT_LANGUAGE")){
            $admin_menu->name = $request->name;
        }

        $admin_menu->icon_class     =   $request->icon_class;
        $admin_menu->route          =   $request->route;
        $admin_menu->addon_name     =   $request->addon_name;
        $admin_menu->sort           =   $request->sort;
        $admin_menu->save();

        $admin_menu_translation = AdminMenuTranslation::firstOrNew(['lang' => $request->lang, 'admin_menu_id' => $admin_menu->id]);
        $admin_menu_translation->name = $request->name;
        $admin_menu_translation->save();

        flash(translate('Admin Menu has been updated successfully'))->success();
        return back();
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

        $admin_menu = AdminMenu::findOrFail($id);

        // Category Translations Delete
        foreach ($admin_menu->admin_menu_translations as $key => $admin_menu_translation) {
            $admin_menu_translation->delete();
        }

        $admin_menu->delete();

        flash(translate('Admin Menu has been deleted successfully'))->success();
        return redirect()->route('admin_menu.index');
    }

    public function updateStatus(Request $request)
    {
        $admin_menu = AdminMenu::findOrFail($request->id);
        $admin_menu->status = $request->status;
        if($admin_menu->save()){
            return 1;
        }
        return 0;
    }
}
