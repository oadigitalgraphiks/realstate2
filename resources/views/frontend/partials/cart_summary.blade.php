<table class="table no-border">
    <tbody>
        @php
            $subtotal = 0;
            $tax = 0;
            $shipping = 0;
            $product_shipping_cost = 0;
        @endphp
        @foreach ($carts as $key => $cartItem)
            @php
                $product = \App\Models\Product::find($cartItem['product_id']);
                $subtotal += $cartItem['price'] * $cartItem['quantity'];
                $tax += $cartItem['tax'] * $cartItem['quantity'];
                $product_shipping_cost = $cartItem['shipping_cost'];

                $shipping += $product_shipping_cost;

                $product_name_with_choice = $product->getTranslation('name');
                if ($cartItem['variant'] != null) {
                    $product_name_with_choice = $product->getTranslation('name').' - '.$cartItem['variant'];
                }
            @endphp
            <tr class="cart_item requires-shipping--true">
                <td class="image product-thumbnail"><img src="{{uploaded_asset($product->thumbnail_img)}}" alt="{{$product->name}}"></td>
                <td>
                    <h6 class="w-160 mb-5"><a href="{{route('product',$product->slug)}}" class="text-heading">{{ $product_name_with_choice }}</a></h6></span>
                </td>
                <td>
                    <h6 class="text-muted pl-20 pr-20">x {{ $cartItem['quantity'] }}</h6>
                </td>
                <td>
                    <h4 class="text-brand">{{ single_price(($cartItem['price']) * $cartItem['quantity']) }}</h4>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr class="cart-subtotal">
            <th><h5>{{ translate('Tax') }}</h5></th>
            <td>
                <h6> {{ single_price($tax) }} </h6>
            </td>
        </tr>
        <tr class="cart-shipping">
            <th><h6>{{translate('Total Shipping')}}</h6></th>
            <td class="text-right">
                <h6>{{ single_price($shipping) }}</h6>
            </td>
        </tr>
        @if ($carts->sum('discount') > 0)
            <tr class="cart-shipping">
                <th><h6>{{translate('Coupon Discount')}}</h6></th>
                <td>
                    <h6>{{ single_price($carts->sum('discount')) }}</h6>
                </td>
            </tr>
        @endif
        @php
            $total = $subtotal+$tax+$shipping;
            if(Session::has('club_point')) {
                $total -= Session::get('club_point');
            }
            if ($carts->sum('discount') > 0){
                $total -= $carts->sum('discount');
            }
        @endphp
        <tr class="order-total">
            <th><h5>{{ translate('Total') }}</h5></th>
            <td>
                <h6> {{ single_price($total) }} </h6>
            </td>
        </tr>


    </tfoot>
</table>
