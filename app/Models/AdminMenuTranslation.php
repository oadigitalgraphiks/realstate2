<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminMenuTranslation extends Model
{
    protected $fillable = ['name', 'lang', 'admin_menu_id'];

    public function admin_menu(){
    	return $this->belongsTo(AdminMenu::class);
    }
}
