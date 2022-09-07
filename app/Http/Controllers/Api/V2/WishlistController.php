<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\WishlistCollection;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;

class WishlistController extends Controller
{

    public function index($id)
    {
        $user_id = User::find($id);
        if($user_id == null){
            return response()->json(['message' => translate('User Not Found')], 401);
        }

        $product_ids = Wishlist::where('user_id', $id)->pluck("product_id")->toArray();
        $existing_product_ids = Product::whereIn('id', $product_ids)->pluck("id")->toArray();

        $query = Wishlist::query();
        $query->where('user_id', $id)->whereIn("product_id", $existing_product_ids);

        return new WishlistCollection($query->latest()->get());
    }

    public function store(Request $request)
    {
       
            Wishlist::updateOrCreate(
                ['user_id' => $request->user_id, 'product_id' => $request->property_id]
            );
            return response()->json(['message' => translate('Product is successfully added to your wishlist')], 201);
               
    }

    public function destroy($id)
    {
        try {
            Wishlist::destroy($id);
            return response()->json(['result' => true, 'message' => translate('Property is successfully removed from your wishlist')], 200);
        } catch (\Exception $e) {
            return response()->json(['result' => false, 'message' => $e->getMessage()], 200);
        }

    }

    public function add(Request $request)
    {

        $property_id = Product::find($request->property_id);
        $user_id = User::find($request->user_id);
        if($property_id == null && $user_id == null){
            return response()->json(['message' => translate('Product Or User Not Found')], 401);
        }

        $product = Wishlist::where(['product_id' => $request->property_id, 'user_id' => $request->user_id])->count();
        if ($product > 0) {

            return response()->json([
                'message' => translate('Property present in wishlist'),
                'is_in_wishlist' => true,
                'property_id' => (integer)$request->property_id,
                'wishlist_id' => (integer)Wishlist::where(['product_id' => $request->property_id, 'user_id' => $request->user_id])->first()->id
            ], 200);

        } else {
            Wishlist::create(
                ['user_id' => $request->user_id, 'product_id' => $request->property_id]
            );

            return response()->json([
                'message' => translate('Property added to wishlist'),
                'is_in_wishlist' => true,
                'product_id' => (integer)$request->property_id,
                'wishlist_id' => (integer)Wishlist::where(['product_id' => $request->property_id, 'user_id' => $request->user_id])->first()->id
            ], 200);
        }

    }

    public function remove(Request $request)
    {
        $property_id = Product::find($request->property_id);
        $user_id = User::find($request->user_id);
        if($property_id == null && $user_id == null){
            return response()->json(['message' => translate('Property Or User Not Found')], 401);
        }
        
        $product = Wishlist::where(['product_id' => $request->property_id, 'user_id' => $request->user_id])->count();
        if ($product == 0) {
            return response()->json([
                'message' => translate('Product in not in wishlist'),
                'is_in_wishlist' => false,
                'product_id' => (integer)$request->property_id,
                'wishlist_id' => 0
            ], 200);
        } else {
            Wishlist::where(['product_id' => $request->property_id, 'user_id' => $request->user_id])->delete();

            return response()->json([
                'message' => translate('Property is removed from wishlist'),
                'is_in_wishlist' => false,
                'product_id' => (integer)$request->property_id,
                'wishlist_id' => 0
            ], 200);
        }
    }

    public function isProductInWishlist(Request $request)
    {

        $property_id = Product::find($request->property_id);
        $user_id = User::find($request->user_id);
        if($property_id == null && $user_id == null){
            return response()->json(['message' => translate('Property Or User Not Found')], 401);
        }

        $product = Wishlist::where(['product_id' => $request->property_id, 'user_id' => $request->user_id])->count();
        if ($product > 0)
            return response()->json([
                'message' => translate('Property present in wishlist'),
                'is_in_wishlist' => true,
                'product_id' => (integer)$request->property_id,
                'wishlist_id' => (integer)Wishlist::where(['product_id' => $request->property_id, 'user_id' => $request->user_id])->first()->id
            ], 200);

        return response()->json([
            'message' => translate('Property is not present in wishlist'),
            'is_in_wishlist' => false,
            'product_id' => (integer)$request->property_id,
            'wishlist_id' => 0
        ], 200);
    }
}
