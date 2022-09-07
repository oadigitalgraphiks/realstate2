<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyTeam extends Model
{

    protected $table = "property_teams";
    
    public function agency()
    {
      return $this->belongsTo(Shop::class);
    }
       
}