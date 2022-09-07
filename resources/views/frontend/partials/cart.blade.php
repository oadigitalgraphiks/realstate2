@php
if(auth()->user() != null) {
    $user_id = Auth::user()->id;
    $cart = \App\Models\Cart::where('user_id', $user_id)->get();
} else {
    $temp_user_id = Session()->get('temp_user_id');
    if($temp_user_id) {
        $cart = \App\Models\Cart::where('temp_user_id', $temp_user_id)->get();
    }
}
$sum = 0;
@endphp
@if(isset($cart) && count($cart) > 0)

@else
<div class="shopping-cart-footer">
        <div class="text-center p-3">
            <i class="fi fi-rs-shopping-cart la-3x opacity-60 mb-3 fz_42"></i>
            <h3 class="h5 fw-500">{{translate('Your Cart is empty')}}</h3>
            <p class="return-to-shop mb__15">
                <a class="button button_primary tu js_add_ld" href="{{ route('home') }}">{{translate('Return To Home')}}</a>
            </p>
        </div>

</div>
@endif
@if(isset($cart) && count($cart) > 0)
@php
        $total = 0;
@endphp
    <ul class="@if(isset($cart) && count($cart) > 2) fixed-scroll-ul @endif">
        @foreach($cart as $key => $cartItem)
            @php
                $product = \App\Models\Product::find($cartItem['product_id']);
                $total = $total + $cartItem['price'] * $cartItem['quantity'];
            @endphp
            @if ($product != null)
                <li>
                    <div class="shopping-cart-img">
                        <a href="{{ route('product', $product->slug) }}"><img alt="Nest"
                                src="{{ uploaded_asset($product->thumbnail_img) }}" /></a>
                    </div>
                    <div class="shopping-cart-title">
                        <h4>
                        <a href="{{route('product',$product->slug)}}">{{$product->name}}</a></h4>
                            <h4><span>{{ $cartItem['quantity'] }} × </span>{{ single_price($cartItem['price']) }}</h4>
                            @php
                                $sum += convert_price(($cartItem['price']) * $cartItem['quantity']);
                            @endphp
                    </div>
                    <div class="shopping-cart-delete">
                        <a href="javascript:void(0)" onclick="removeFromCart({{ $cartItem['id'] }})">
                            <i class="fi-rs-cross-small"></i>
                        </a>
                    </div>
                </li>
            @endif
        @endforeach
    </ul>
    <div class="shopping-cart-footer">
        <div class="shopping-cart-total">
            <h4>{{translate('Total')}} <span>{{ format_price($sum) }}</span></h4>
        </div>
        <div class="shopping-cart-button">
            <a href="{{ route('cart') }}" class="outline">{{translate('View cart')}}</a>
            <a href="{{ route('checkout.shipping_info') }}">{{translate('Checkout')}}</a>
        </div>
    </div>
@endif
