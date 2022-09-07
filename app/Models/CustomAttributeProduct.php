<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomAttributeProduct extends Model {

    protected $table = 'custom_attribute_products';


    protected $fillable = [
        'product_id','attribute_id'
    ];

    public function attribute()
    {
        return $this->belongsTo(CustomAttribute::class,'attribute_id','id');
    }


}
