<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class Menu extends Model
{
    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $menu_translation = $this->hasMany(MenuTranslation::class)->where('lang', $lang)->first();
		//dd($menu_translation);
          return $menu_translation != null ? $menu_translation->$field : $this->$field;
		//$menu_translation != null ? $menu_translation->$field : $this->$field;
		//dd($menu_translation);
    }

    public function menu_translations(){
    	return $this->hasMany(MenuTranslation::class);
    }

    public function products(){
    	return $this->hasMany(Product::class);
    }

    public function classified_products(){
    	return $this->hasMany(CustomerProduct::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function childrenMenus()
    {
        return $this->hasMany(Menu::class, 'parent_id')->with('menus');
    }

    public function parentMenu()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }
}
