<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class Role extends Model
{
    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $role_translation = $this->hasMany(RoleTranslation::class)->where('lang', $lang)->first();
        return $role_translation != null ? $role_translation->$field : $this->$field;
    }

    public function role_translations(){
      return $this->hasMany(RoleTranslation::class);
    }

    public function menus()
    {
      return $this->belongsToMany('App\Models\AdminMenu','role_admin_menus','role_id','admin_menu_id');
    }

    public function permissions()
    {
      return $this->belongsToMany('App\Models\Permission','role_permissions','role_id','permission_id');
    }
}
