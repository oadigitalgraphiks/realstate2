<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyReportTranslation extends Model
{
    protected $fillable = ['name', 'lang', 'property_report_id'];

    public function product(){
        return $this->belongsTo(PropertyReport::class);
      }
}
