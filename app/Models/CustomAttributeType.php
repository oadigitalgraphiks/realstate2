<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomAttributeType extends Model {

    protected $table = 'custom_attribute_types';

    protected $fillable = [
        'name', 'icon', 
    ];


    public function attribute()
    {
        return $this->hasMany(CustomAttribute::class,'parent','id');
    }

}
