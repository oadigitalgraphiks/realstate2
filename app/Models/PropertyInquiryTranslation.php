<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyInquiryTranslation extends Model
{
    protected $table = "property_contact_form_translations";
    protected $fillable = ['name', 'lang', 'property_contact_form_id'];

    public function product(){
        return $this->belongsTo(PropertyInquiry::class, 'id', 'property_inquiry_id');
      }
}
