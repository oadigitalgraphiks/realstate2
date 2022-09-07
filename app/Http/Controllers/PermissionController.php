<?php

namespace App\Http\Controllers;

use App\Models\AdminMenu;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
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
        $permissions = Permission::with('admin_menu')->orderBy('admin_menu_id', 'asc');

        if ($request->has('search')){
            $sort_search = $request->search;
            $permissions = $permissions->where('name', 'like', '%'.$sort_search.'%');
        }
        $permissions = $permissions->paginate(15);

        return view('backend.system.permissions.index', compact('permissions', 'sort_search'));
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

        return view('backend.system.permissions.create', compact('admin_menus'));
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
        $permission                 =   new Permission;
        $permission->admin_menu_id  =   $request->admin_menu_id;
        $permission->name           =   $request->name;
        $permission->route          =   $request->route;
        $permission->sort           =   $request->sort;
        $permission->save();

        flash(translate('Permission has been inserted successfully'))->success();

        return redirect()->route('permission.index');
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
        $permission = Permission::findOrFail($id);

        $admin_menus = AdminMenu::where('parent_id', 0)
            ->with('childrens')
            ->get();

        return view('backend.system.permissions.edit', compact('permission', 'admin_menus', 'lang'));
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
        $permission = Permission::findOrFail($id);

        $permission->admin_menu_id  =   $request->admin_menu_id;
        $permission->name           =   $request->name;
        $permission->route          =   $request->route;
        $permission->sort           =   $request->sort;
        $permission->save();

        loggs('Updated Permission: '.$permission->name);

        flash(translate('Permission has been updated successfully'))->success();
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

        $permission = Permission::findOrFail($id);

        $permission->delete();

        loggs('Deleted Permission: '.$permission->name);

        flash(translate('Permission has been deleted successfully'))->success();
        return redirect()->route('permission.index');
    }

    public function updateStatus(Request $request)
    {
        $permission = Permission::findOrFail($request->id);
        $permission->status = $request->status;
        if($permission->save()){
            return 1;
        }
        return 0;
    }
}
