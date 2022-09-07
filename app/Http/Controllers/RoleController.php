<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\RoleAdminMenu;
use App\Models\RolePermission;
use App\Models\RoleTranslation;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Builder;
class RoleController extends Controller
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
    public function index()
    {
        $menu_id = getMenuIdForPermission($this->current_route);

        if(auth()->user()->user_type != 'admin' && !menu_permissions($menu_id)){
            return redirect()->route('backend.no-rights');
        }

        $roles = Role::whereNotIn('id',[1])->paginate(10);
        return view('backend.staff.staff_roles.index', compact('roles'));
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

        return view('backend.staff.staff_roles.create');
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

        if($request->has('role_menus')){
            $role = new Role;
            $role->name = $request->name;
            // $role->permissions = json_encode($request->permissions);
            $role->save();

            foreach($request->role_menus as $role_menu){
                $role_admin_menu                =   new RoleAdminMenu;
                $role_admin_menu->role_id       =   $role->id;
                $role_admin_menu->admin_menu_id =   $role_menu;
                $role_admin_menu->save();
            }

            foreach($request->role_permissions as $value){
                $role_permission                =   new RolePermission;
                $role_permission->role_id       =   $role->id;
                $role_permission->permission_id =   $value;
                $role_permission->save();
            }

            $role_translation = RoleTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'role_id' => $role->id]);
            $role_translation->name = $request->name;
            $role_translation->save();

            flash(translate('Role has been inserted successfully'))->success();
            return redirect()->route('roles.index');
        }
        flash(translate('Something went wrong'))->error();
        return back();

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
        $role = Role::findOrFail($id);
        return view('backend.staff.staff_roles.edit', compact('role','lang'));
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

        $role = Role::findOrFail($id);

        if($request->has('role_menus')){
            if($request->lang == env("DEFAULT_LANGUAGE")){
                $role->name = $request->name;
            }
            // $role->permissions = json_encode($request->permissions);
            $role->save();

            RoleAdminMenu::where('role_id',$role->id)->delete();
            foreach($request->role_menus as $role_menu){
                $role_admin_menu                =   new RoleAdminMenu;
                $role_admin_menu->role_id       =   $role->id;
                $role_admin_menu->admin_menu_id =   $role_menu;
                $role_admin_menu->save();
            }

            RolePermission::where('role_id',$role->id)->delete();
            foreach($request->role_permissions as $value){
                $role_permission                =   new RolePermission;
                $role_permission->role_id       =   $role->id;
                $role_permission->permission_id =   $value;
                $role_permission->save();
            }

            $role_translation = RoleTranslation::firstOrNew(['lang' => $request->lang ?? env("DEFAULT_LANGUAGE"), 'role_id' => $role->id]);
            $role_translation->name = $request->name;
            $role_translation->save();

            flash(translate('Role has been updated successfully'))->success();
            return redirect()->route('roles.index');
        }
        flash(translate('Something went wrong'))->error();
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

        $role = Role::findOrFail($id);
        $staffCount = Staff::whereHas('role', function(Builder $query) use($role){
            $query->where('id',$role->id);
        })->get()->count();

        if ($staffCount > 0) {
            flash(translate('Sorry! This Role have Staff'))->error();

            return redirect()->route('roles.index');
        }
        foreach ($role->role_translations as $key => $role_translation) {
            $role_translation->delete();
        }

        RoleAdminMenu::where('role_id',$role->id)->delete();
        RolePermission::where('role_id',$role->id)->delete();

        Role::destroy($id);

        flash(translate('Role has been deleted successfully'))->success();
        return redirect()->route('roles.index');
    }
}
