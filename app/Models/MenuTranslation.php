<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuTranslation extends Model
{
    protected $fillable = ['name', 'lang', 'menu_id'];

    public function menu(){
    	return $this->belongsTo(Menu::class);
    }
}
