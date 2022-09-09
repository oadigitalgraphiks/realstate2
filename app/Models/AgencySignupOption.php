<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class AgencySignupOption extends Model
{
    protected $table = "property_signup_options";
   
    public function parents()
    {
        return $this->belongsTo(AgencySignupOption::class, 'parent');
    }

    public function children()
    {
        return $this->hasMany(AgencySignupOption::class, 'parent');
    }
    
}
