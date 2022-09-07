<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class Warehouse extends Model
{
    // protected $fillable = ['name','slug','meta_title','meta_description','top'];
    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $warehouse_translation = $this->hasMany(WarehouseTranslation::class)->where('lang', $lang)->first();
        return $warehouse_translation != null ? $warehouse_translation->$field : $this->$field;
    }

    public function warehouse_translations(){
        return $this->hasMany(WarehouseTranslation::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function shipping_method()
    {
        return $this->belongsTo(ShippingMethod::class);
    }


}
