<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public function product(){
    	return $this->belongsTo(Product::class);
    }

    public function seller(){
    	return $this->belongsTo(Seller::class);
    }

    public function warehouse(){
    	return $this->belongsTo(Warehouse::class);
    }

    public function stocks(){
    	return $this->belongsTo(ProductStock::class,'variant','variant');
    }
}
