<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function admin_menu()
    {
        return $this->belongsTo(AdminMenu::class, 'admin_menu_id');
    }
}
