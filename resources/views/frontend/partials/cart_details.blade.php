@if ($carts && count($carts) > 0)
    <div class="col-lg-9">
        <div class="table-responsive shopping-summery">
            <table class="table table-wishlist">
                <thead>
                    <tr class="main-heading">
                        <th class="custome-checkbox start pl-30">
                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                            <label class="form-check-label" for="exampleCheckbox11"></label>
                        </th>
                        <th scope="col" colspan="2">{{ translate('Product') }}</th>
                        <th scope="col">{{ translate('Unit Price') }}</th>
                        <th scope="col">{{ translate('Quantity') }}</th>
                        <th scope="col">{{translate('Subtotal')}}</th>
                        <th scope="col" class="end">{{ translate('Remove') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                        $sum = 0;
                    @endphp
                    @foreach ($carts as $key => $cartItem)
                        @php
                            $product = \App\Models\Product::find($cartItem['product_id']);
                            $total = $total + $cartItem['price'] * $cartItem['quantity'] + $cartItem['tax'];
                            $product_name_with_choice = $product->name;
                            if ($cartItem['variation'] != null) {
                                // $product_name_with_choice = $product->getTranslation('name') . ' - ' . $cartItem['variation'];
                                $product_name_with_choice = $product->getTranslation('name');
                            }
                        @endphp
                        <tr class="pt-30">
                            <td class="custome-checkbox pl-30">
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                <label class="form-check-label" for="exampleCheckbox1"></label>
                            </td>
                            <td class="image product-thumbnail pt-40">
                                <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="#">
                            </td>
                            <td class="product-des product-name">
                                <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="{{ route('product', $product->slug) }}">{{ $product_name_with_choice }}</a></h6>
                            </td>
                            <td class="price" data-title="Unit Price">
                                <h4 class="text-body">{{ single_price($cartItem['price']) }}</h4>
                            </td>
                            <td class="text-center detail-info" data-title="Stock">
                                <div class="detail-extralink">
                                    @if ($cartItem['digital'] != 1)
                                        <div class="border radius aiz-plus-minus p-10">
                                            <button style="border:none; border-radius: 50%" type="button"
                                                class="col-auto btn-icon   btn-circle btn-light btn-change-qty"
                                                data-type="minus" data-field="quantity[{{ $cartItem['id'] }}]">
                                                <i class="fi-rs-minus" style="vertical-align: middle;"></i>
                                            </button>
                                            <input style="text-align: center; width: 60px; height: 45px;"
                                                class="input-number cart-quantity" type="number"
                                                name="quantity[{{ $cartItem['id'] }}]"
                                                class="col border-0 text-center flex-grow-1 fs-16 input-number"
                                                placeholder="1" value="{{ $cartItem['quantity'] }}" min="1"
                                                max="10" data-key="{{ $cartItem['id'] }}"
                                                onchange="updateQuantity({{ $cartItem['id'] }}, this)">
                                            <button style="border:none; border-radius: 50%"
                                                class="col-auto btn-icon  btn-circle btn-light btn-change-qty"
                                                data-type="plus" data-field="quantity[{{ $cartItem['id'] }}]" type="button">
                                                <i class="fi-rs-plus" style="vertical-align: middle;"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="price" data-title="Subtotal">
                                <h4 class="text-brand">
                                    {{ single_price(($cartItem['price'] ) * $cartItem['quantity']) }}
                                </h4>
                                @php
                                    $sum += convert_price(($cartItem['price'] ) * $cartItem['quantity']);
                                @endphp
                            </td>
                            <td class="action text-center" data-title="Remove">
                                <a href="javascript:void(0)"
                                    onclick="removeFromCartView(event, {{ $cartItem['id'] }})"
                                    class="text-body" style="font-size: 20px;"><i class="fi-rs-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="divider-2 mb-30"></div>
        <div class="flex-md-row flex-column cart-action d-flex justify-content-between">
            <a class="btn btn-link" href="{{ route('home') }}" style="height: fit-content;padding: 12px;"><i class="fi-rs-arrow-left @if(\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1) ml-10 @else mr-10 @endif"></i>{{ translate('Continue Shopping') }}</a>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="border p-md-4 cart-totals ">
            <div class="table-responsive">
                <table class="table no-border">
                    <tbody>
                        <tr>
                            <td scope="col" colspan="2">
                                <div class="divider-2 mt-10 mb-10"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="cart_total_label">
                                <h6 class="text-muted">{{ translate('Subtotal') }}</h6>
                            </td>
                            <td class="cart_total_amount">
                                <h4 class="text-brand text-center subtotal">{{ format_price($sum) }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td scope="col" colspan="2">
                                <div class="divider-2 mt-10 mb-10"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @if (Auth::check())
                <a href="{{ route('checkout.shipping_info') }}"
                    class="btn mb-20 w-100">{{ translate('Continue to Shipping') }}<i
                        class="fi-rs-sign-out ml-15" style="vertical-align: middle;"></i></a>
            @else
                <button class="btn mb-20 w-100"
                    onclick="showCheckoutModal()">{{ translate('Continue to Shipping') }}</button>
            @endif
        </div>
    </div>
@else
    <div class="col-lg-12">
        <div class="border p-md-4 cart-totals ml-30 text-center">
            <h3>{{ translate('Your Cart is Empty') }} !</h3>
            <a href="{{ route('home') }}" class="btn mt-10 btn-sm">{{ translate('Return to shop') }}</a>
        </div>
    </div>
@endif

<script type="text/javascript">
    AIZ.extra.plusMinus();
</script>

