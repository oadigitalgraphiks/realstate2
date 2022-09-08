<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyConditionTranslation extends Model
{
    protected $fillable = ['name', 'lang', 'property_condition_id'];

    public function product(){
        return $this->belongsTo(PropertyCondition::class);
      }
}
