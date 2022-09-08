<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App;

class PropertyInquiry extends Model
{
    protected $table = "property_contact_forms";
    protected $guarded = [];

    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $property_inquiry_translation = $this->property_inquiry_translations->where('lang', $lang)->first();
        return $property_inquiry_translation != null ? $property_inquiry_translation->$field : $this->$field;
    }

    public function property_inquiry_translations(){
    	return $this->hasMany(PropertyInquiryTranslation::class);
    }

    public function property()
    {
        return $this->belongsTo(Product::class,'property_id','id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class,'agent_id','id');
    }
    
}