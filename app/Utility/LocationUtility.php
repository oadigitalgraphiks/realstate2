<?php

namespace App\Utility;

use App\Models\Product;
use App\Models\Country;
use App\Models\PropertyState;
use App\Models\PropertyCity;
use App\Models\PropertyArea;
use App\Models\PropertyNestedArea;


class LocationUtility
{
 
    public static function product_count_by_country($id,$product)
    {
        
        $products = Product::where('country_id',$id)->where('published',1)->get();
        return count($products);
    }


    public static function product_count_by_state($id,$product)
    {

        $products = Product::where('state_id',$id)->where('published',1)->get();
        return count($products);
    }


    public static function product_count_by_city($id,$product)
    {

        $products = Product::where('city_id',$id)->where('published',1)->get();
        return count($products);
    }

    public static function product_count_by_area($id,$product)
    {

        $products = Product::where('area_id',$id)->where('published',1)->get();
        return count($products);
    }

    public static function product_count_by_nested_area($id)
    {

        $products = Product::where('nested_area_id',$id)->where('published',1)->get();
        return count($products);
    }



  
    
}
