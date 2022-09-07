<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class AdminMenu extends Model
{

    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $admin_menu_translation = $this->hasMany(AdminMenuTranslation::class)->where('lang', $lang)->first();
        return $admin_menu_translation != null ? $admin_menu_translation->$field : $this->$field;
    }

    public function admin_menu_translations(){
    	return $this->hasMany(AdminMenuTranslation::class);
    }

    public function childrens()
    {
        return $this->hasMany('App\Models\AdminMenu','parent_id','id')->orderBy('sort','asc')->where('status',1);
    }

    public function permissions()
    {
        return $this->hasMany('App\Models\Permission','admin_menu_id','id');
    }

}
