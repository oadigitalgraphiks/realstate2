<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseTranslation extends Model
{
  protected $fillable = ['name', 'lang', 'warehouse_id'];

  public function warehouse(){
    return $this->belongsTo(Warehouse::class);
  }
}
