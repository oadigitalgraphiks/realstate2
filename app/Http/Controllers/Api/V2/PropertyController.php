<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\PropertyMiniCollection;
use App\Http\Resources\V2\PropertyDetailCollection;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Utility\CategoryUtility;
use App\Utility\SearchUtility;
use Cache;
use App\Models\PropertyPurpose;
use App\Models\PropertyBed;
use App\Models\PropertyBath;
use App\Models\PropertyType;
use App\Models\PropertyCountry;
use App\Models\PropertyState;
use App\Models\PropertyCity;
use App\Models\PropertyArea;
use App\Models\PropertyNestedArea;

class PropertyController extends Controller
{
    public function index()
    {
        return new PropertyMiniCollection(Product::latest()->paginate(10));
    }

    public function show($id)
    {
        // return new PropertyMiniCollection(Product::where('id', $id)->get());
        return new PropertyDetailCollection(Product::where('id', $id)->get());
    }

    public function search(Request $request)
    {

        $sort_by = $request->sort_key;
        $name = $request->name;
        $min = $request->min;
        $max = $request->max;
    
        $products = Product::query();
        $products->where('published', 1);

        if($name != null && $name != ""){
             $products->where(function ($query) use ($name) {
                foreach (explode(' ', trim($name)) as $word) {

                  $query->where('name', 'like', '%'.$word.'%')->
                  orWhere('search_sqft', 'like', '%'.$word.'%')->
                  orWhere('tags', 'like', '%'.$word.'%')->
                  orWhereHas('product_translations', function($query) use ($word){
                        $query->where('name', 'like', '%'.$word.'%');
                  })->orWhereHas('bed', function($query) use ($word){
                        $query->where('name', 'like', '%'.$word.'%');
                  })->orWhereHas('bath', function($query) use ($word){
                    $query->where('name', 'like', '%'.$word.'%');
                  });  

                }
            });
            SearchUtility::store($name);
        }

        if($request->has('country') && $request->country != null){
            $country = PropertyCountry::where('slug',$request->country)->first();
            $country = $country ? $country->id:false;
            $products->where('country_id',$country);
        }

        if($request->has('state') && $request->state != ''){
            $state = PropertyState::where('orignal_slug',$request->state)->first();
            $state = $state ? $state->id : false;
            $products->where('state_id',$state);
        }

        if ($request->has('city') && $request->city != '') {
            $city = PropertyCity::where('orignal_slug',$request->city)->first();
            $city = $city ? $city->id : false;
            $products->where('city_id',$city);
        }

        if ($request->has('area') && $request->area != '') {
            $areas = PropertyArea::where('orignal_slug',$request->area)->first();
            $areas = $areas ? $areas->id : false;
            $products->where('area_id',$areas);
        }

        if ($request->has('nested_area') && $request->nested_area != '') {
            $areas = PropertyNestedArea::where('orignal_slug',$request->nested_area)->first();
            $areas = $areas ? $areas->id : false;
            $products->where('nested_area_id',$areas);
        }

        if ($request->has('purpose_child') && $request->purpose_child != '') {
            $purpose = PropertyPurpose::where('slug',$request->purpose_child)->first();
            $purpose = $purpose ? $purpose->id : false;
            $products->where('purpose_child_id',$purpose);
        }


        if ($request->has('agent') && $request->agent != null && is_numeric($request->agent)) {
            $agent = Shop::find($request->agent);
            if($agent){
                $products->where('user_id',$agent->user_id);
            }
        }

        if ($min != null && $min != "" && is_numeric($min)) {
            $products->where('unit_price', '>=', $min);
        }

        if ($max != null && $max != "" && is_numeric($max)) {
            $products->where('unit_price', '<=', $max);
        }

        if ($request->has('bath') && $request->bath != '') {
             $bathIds = explode(',', $request->bath);
             $products->whereIn('bath_id',$bathIds);
        }

        if ($request->has('bed') && $request->bed != '') {
            $bedhIds = explode(',', $request->bed);
            $products->whereIn('bed_id',$bedhIds);
        }

        if($request->has('sqftmin') && $request->sqftmin != null && $request->sqftmin != "" && is_numeric($request->sqftmin)) {
            $products->where('search_sqft', '>=', $request->sqftmin);
        }

        if($request->has('sqftmax') != null && $request->sqftmax != "" && is_numeric($request->sqftmax)) {
            $products->where('search_sqft', '<=', $request->sqftmax);
        }

        if ($request->has('tour_type') && $request->tour_type != null && is_numeric($request->tour_type)){
            $products->where('tour_type_id', $request->tour_type);
        }

        if ($request->has('furnish_type') && $request->furnish_type != null && is_numeric($request->furnish_type)){
            $products->where('furnish_type_id', $request->furnish_type);
        }

        if ($request->has('purpose') && $request->purpose != ''){
            $purpose = PropertyPurpose::where('slug',$request->purpose)->first();
            $products->where('purpose_id',$purpose->id);
        }

        if($request->has('type') && $request->type != ''){

            $typeIdz = [];
            $type = PropertyType::where('slug',$request->type)->first();
            if($type){
                if($type->parent_id == 0){
                    foreach ($type->children()->get() as $value) {  
                        array_push($typeIdz,$value->id);
                    }
                }else{
                    array_push($typeIdz,$type->id);
                }
            }

            $products->whereIn('type_id',$typeIdz);
        }


        if ($request->has('true_check') && $request->true_check != '' && is_numeric($request->true_check)){
            $products->where('true_check',$request->true_check);    
         }

    
        switch ($sort_by) {
            case 'price_low_to_high':
                $products->orderBy('unit_price', 'asc');
                break;

            case 'price_high_to_low':
                $products->orderBy('unit_price', 'desc');
                break;

            case 'new_arrival':
                $products->orderBy('created_at', 'desc');
                break;

            case 'popularity':
                $products->orderBy('num_of_sale', 'desc');
                break;

            case 'top_rated':
                $products->orderBy('rating', 'desc');
                break;

            default:
                $products->orderBy('created_at', 'desc');
                break;
        }

        return new PropertyMiniCollection($products->paginate(10));
    }

    // public function seller($id, Request $request)
    // {
    //     $shop = Shop::findOrFail($id);
    //     $products = Product::where('added_by', 'seller')->where('user_id', $shop->user_id);
    //     if ($request->name != "" || $request->name != null) {
    //         $products = $products->where('name', 'like', '%' . $request->name . '%');
    //     }
    //     $products->where('published', 1);
    //     return new ProductMiniCollection($products->latest()->paginate(10));
    // }

    // public function category($id, Request $request)
    // {
    //     $category_ids = CategoryUtility::children_ids($id);
    //     $category_ids[] = $id;

    //     $products = Product::whereIn('category_id', $category_ids);

    //     if ($request->name != "" || $request->name != null) {
    //         $products = $products->where('name', 'like', '%' . $request->name . '%');
    //     }
    //     $products->where('published', 1);
    //     return new ProductMiniCollection(filter_products($products)->latest()->paginate(10));
    // }


    // public function brand($id, Request $request)
    // {
    //     $products = Product::where('brand_id', $id);
    //     if ($request->name != "" || $request->name != null) {
    //         $products = $products->where('name', 'like', '%' . $request->name . '%');
    //     }

    //     return new ProductMiniCollection(filter_products($products)->latest()->paginate(10));
    // }

    // public function todaysDeal()
    // {
    //     return Cache::remember('app.todays_deal', 86400, function(){
    //         $products = Product::where('todays_deal', 1);
    //         return new ProductMiniCollection(filter_products($products)->limit(20)->latest()->get());
    //     });
    // }

    // public function flashDeal()
    // {
    //     return Cache::remember('app.flash_deals', 86400, function(){
    //         $flash_deals = FlashDeal::where('status', 1)->where('featured', 1)->where('start_date', '<=', strtotime(date('d-m-Y')))->where('end_date', '>=', strtotime(date('d-m-Y')))->get();
    //         return new FlashDealCollection($flash_deals);
    //     });
    // }

    // public function featured()
    // {
    //     $products = Product::where('featured', 1);
    //     return new ProductMiniCollection(filter_products($products)->latest()->paginate(10));
    // }

    // public function bestSeller()
    // {
    //     return Cache::remember('app.best_selling_products', 86400, function(){
    //         $products = Product::orderBy('num_of_sale', 'desc');
    //         return new ProductMiniCollection(filter_products($products)->limit(20)->get());
    //     });
    // }

    // public function related($id)
    // {
    //     return Cache::remember("app.related_products-$id", 86400, function() use ($id){
    //         $product = Product::find($id);
    //         $products = Product::where('category_id', $product->category_id)->where('id', '!=', $id);
    //         return new ProductMiniCollection(filter_products($products)->limit(10)->get());
    //     });
    // }

    // public function topFromSeller($id)
    // {
    //     return Cache::remember("app.top_from_this_seller_products-$id", 86400, function() use ($id){
    //         $product = Product::find($id);
    //         $products = Product::where('user_id', $product->user_id)->orderBy('num_of_sale', 'desc');

    //         return new ProductMiniCollection(filter_products($products)->limit(10)->get());
    //     });
    // }


    

}