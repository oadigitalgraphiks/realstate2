<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PropertyReport extends Model
{
    protected $table = "property_reports";
    protected $guarded = [];

    public function property()
    {
        return $this->belongsTo(Product::class,'property_id','id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class,'agent_id','id');
    }
    
}