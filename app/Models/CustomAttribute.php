<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class CustomAttribute extends Model {

    protected $fillable = [
        'name', 'parent', 
    ];

    protected $table = 'custom_attributes';

    public function type()
    {
        return $this->belongsTo(CustomAttributeType::class,'parent','id');
    }


}
