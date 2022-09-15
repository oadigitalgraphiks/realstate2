<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model {

    // protected $fillable = [
    //     'name', 'added_by', 'user_id', 'category_id', 'brand_id', 'video_provider', 'video_link', 'unit_price',
    //     'purchase_price', 'unit', 'slug', 'colors', 'choice_options', 'variations', 'thumbnail_img', 'meta_title', 'meta_description'
    // ];

    protected $guarded = [];

    protected $with = ['product_translations', 'taxes'];

    public function getTranslation($field = '', $lang = false) {
        
        $lang = $lang == false ? App::getLocale() : $lang;
        $product_translations = $this->product_translations->where('lang', $lang)->first();
        return $product_translations != null ? $product_translations->$field : $this->$field;
    }

  

    public function product_translations() {
        return $this->hasMany(ProductTranslation::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class)->where('status', 1);
    }

   

    public function wishlists() {
        return $this->hasMany(Wishlist::class);
    }

    public function stocks() {
        return $this->hasMany(ProductStock::class);
    }

    public function taxes() {
        return $this->hasMany(ProductTax::class);
    }

    public function flash_deal_product() {
        return $this->hasOne(FlashDealProduct::class);
    }

    public function bids() {
        return $this->hasMany(AuctionProductBid::class);
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class,'product_id','id');
    }

    public function type()
    {
        return $this->belongsTo(PropertyType::class,'type_id','id');
    }

    public function purpose()
    {
        return $this->belongsTo(PropertyPurpose::class,'purpose_id','id');
    }

    public function purpose_child()
    {
        return $this->belongsTo(PropertyPurpose::class,'purpose_child_id','id');
    }

    public function bed()
    {
        return $this->belongsTo(PropertyBed::class,'bed_id','id');
    }

    public function bath()
    {
        return $this->belongsTo(PropertyBath::class,'bath_id','id');
    }

    public function tour_type()
    {
        return $this->belongsTo(PropertyTourType::class,'tour_type_id','id');
    }

    public function plans()
    {
        return $this->hasMany(PropertyPlan::class,'property_id','id');
    }

    public function property_unit()
    {
        return $this->belongsTo(PropertyUnit::class,'unit_id','id');
    }

    public function furnish_type()
    {
        return $this->belongsTo(PropertyFurnishType::class,'furnish_type_id','id');
    }

    public function aminity()
    {
        return $this->belongsTo(PropertyAminity::class,'furnish_type_id','id');
    }

    public function country()
    {
        return $this->belongsTo(PropertyCountry::class,'country_id','id');
    }

    public function state()
    {
        return $this->belongsTo(PropertyState::class,'state_id','id');
    }

    public function city()
    {
        return $this->belongsTo(PropertyCity::class,'city_id','id');
    }

    public function area()
    {
        return $this->belongsTo(PropertyArea::class,'area_id','id');
    }

    public function nested_area()
    {
        return $this->belongsTo(PropertyNestedArea::class,'nested_area_id','id');
    }



    


    

}
