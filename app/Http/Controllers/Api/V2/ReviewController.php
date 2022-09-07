<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\ReviewCollection;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class ReviewController extends Controller
{
    public function index($id)
    {
        $review = Review::where('property_id', $id)->where('status', 1)->orderBy('updated_at', 'desc')->paginate(10);
        if($review){
            return new ReviewCollection($review);

        }

    }

    public function submit(Request $request)
    {

        $validator = Validator::make($request->all(),[
            "rate" => ['required','integer'],
            "description" => ['required','string','max:100'],
            "name" => ['required','string','max:50'],
            "phone" => ['required','string','max:50'],
            "email" => ['required','string','email','max:50'],
            "purpose" => ['required','string','max:50'],
            "property_id" => ['nullable','integer','exists:products,id'],
            "type" => ['required','string','max:50'],
            "locations" => ['nullable','string','max:100'],
            "interact" => ['nullable','string','max:50'],
            "terms" => ['required','integer'],
            "user_id" => ['nullable','integer','exists:users,id'],
            "user_type" => ['required','string','max:50'],
            "property_link" => ['nullable','string','max:100'],
         ]);

         if($validator->fails()){
            return response()->json([
             'message' => 'Validation Failed',
             'errors' => $validator->messages(),
            ],401);
         } 

        Review::create([
            "property_id" => $request->has('property_id') ? $request->property_id : null,
            "user_id" =>  $request->has('user_id') ? $request->user_id : null,
            "rating" =>  $request->rate,
            "comment" => $request->description,
            "name" => $request->name,
            "phone" => $request->has('phone') ? $request->phone : null,
            "email" => $request->email,
            "purpose" => $request->purpose,
            "type" => $request->type,
            "interact" => $request->interact,
            "property_link" => $request->property_link,
            "user_type" => $request->user_type,
            "location" => $request->location,
        ]);

        // $product = Product::find($request->product_id);
        // $user = User::find($request->user_id);

        /*
         @foreach ($detailedProduct->orderDetails as $key => $orderDetail)
            @if($orderDetail->order != null && $orderDetail->order->user_id == Auth::user()->id && $orderDetail->delivery_status == 'delivered' && \App\Models\Review::where('user_id', Auth::user()->id)->where('product_id', $detailedProduct->id)->first() == null)
                @php
                    $commentable = true;
                @endphp
            @endif
        @endforeach
        */

        // $reviewable = false;

        // foreach ($product->orderDetails as $key => $orderDetail) {
        //     if($orderDetail->order != null && $orderDetail->order->user_id == $request->user_id && $orderDetail->delivery_status == 'delivered' && \App\Models\Review::where('user_id', $request->user_id)->where('product_id', $product->id)->first() == null){
        //         $reviewable = true;
        //     }
        // }

        // if(!$reviewable){
        //     return response()->json([
        //         'result' => false,
        //         'message' => translate('You cannot review this product')
        //     ]);
        // }

        // $review = new \App\Models\Review;
        // $review->product_id = $request->product_id;
        // $review->user_id = $request->user_id;
        // $review->rating = $request->rating;
        // $review->comment = $request->comment;
        // $review->viewed = 0;
        // $review->save();

        // $count = Review::where('product_id', $product->id)->where('status', 1)->count();
        // if($count > 0){
        //     $product->rating = Review::where('product_id', $product->id)->where('status', 1)->sum('rating')/$count;
        // }
        // else {
        //     $product->rating = 0;
        // }
        // $product->save();

        // if($product->added_by == 'seller'){
        //     $seller = $product->user->seller;
        //     $seller->rating = (($seller->rating*$seller->num_of_reviews)+$review->rating)/($seller->num_of_reviews + 1);
        //     $seller->num_of_reviews += 1;
        //     $seller->save();
        // }

        return response()->json([
            'message' => translate('Review  Submitted')
        ],200);
    }
}
