@extends('frontend.layouts.app')

@section('content')
@php
    $address = \App\Models\Address::where('user_id', Auth::user()->id)
        ->where('type', 'billing')
        ->first();
@endphp
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route("home")}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Checkout
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="heading-2 mb-10">Checkout</h1>
                @if ($carts && count($carts) > 0)
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body">There are <span class="text-brand">{{ count($carts) }}</span> products in your cart</h6>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <div class="row mb-50">
                    @if (Auth::check() && get_setting('coupon_system') == 1)
                        @if ($carts[0]['discount'] > 0)
                            <div class="col-lg-12 mt-20  mb-20">
                                <form method="post" class="apply-coupon" id="remove-coupon-form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="owner_id" value="{{ $carts[0]['owner_id'] }}">
                                    <input type="text" placeholder="Enter Coupon Code...">
                                    <button type="button" id="coupon-remove" class="btn btn-primary">{{translate('Apply')}}</button>
                                </form>
                            </div>
                            @else
                            <div class="col-lg-12 mt-20  mb-20">
                                <form method="post" class="apply-coupon" id="apply-coupon-form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="owner_id" value="{{ $carts[0]['owner_id'] }}">
                                    <input type="text" class="form-control" name="code" onkeydown="return event.key != 'Enter';" placeholder="{{translate('Have coupon code? Enter here')}}" required>
                                    <button type="button" id="coupon-apply" class="btn btn-primary">{{translate('Apply')}}</button>
                                </form>
                            </div>
                        @endif
                    @endif
                    <div class="col-lg-12 mb-sm-15 mb-lg-0 mb-md-3 mt-5">
                        <div class="row">
                            <h4 class="mb-30">Billing Details</h4>
                            <form  method="POST"  class="checkout woocommerce-checkout row" action="{{ route('checkout.address_store') }}" enctype="multipart/form-data">
                                @csrf
                                <input id="type"
                                       name="type"
                                       type="hidden"
                                       value="billing">
                                <input id="type"
                                       name="address_id"
                                       type="hidden"
                                       value="{{ $address->id ?? '' }}">
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <input type="text" class="input-text " name="first_name" id="first_name" placeholder="" value="{{ $address->first_name ?? Auth::user()->name }}" autocomplete="given-name" />
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <input type="text" required="" name="last_name" id="last_name" placeholder="Last name *" value="{{ $address->last_name ?? '' }}">
                                    </div>
                                </div>
                                <div class="row shipping_calculator">
                                    <div class="form-group col-lg-6">
                                        <div class="custom_select">
                                            <select class="form-control select-active" name="country_id" id="country_id" required>
                                                <option value="">Select an Country...</option>
                                                @foreach (\App\Models\Country::where('status', 1)->get() as $key => $country)
                                                    <option value="{{ $country->id }}" country_code="{{ $country->code }}"
                                                        @if ($address != null && $address->country_id != null) @if ($address->country_id == $country->id)
                                                                selected @endif
                                                        @endif>
                                                        {{ $country->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="custom_select">
                                            <select class="form-control select-active" name="state_id" required>
                                                <option value="">Select an State...</option>
                                                @if ($address != null)
                                                    @foreach (\App\Models\State::where('status', 1)->where('country_id', $address->country_id)->get() as $key => $state)
                                                        <option value="{{ $state->id }}"
                                                            @if ($address->state_id != null) @if ($address->state_id == $state->id)
                                                                selected @endif
                                                            @endif>
                                                            {{ $state->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="custom_select">
                                            <select class="form-control select-active" name="city_id" required>
                                                <option value="">Select an City...</option>
                                                @if ($address != null)
                                                    @foreach (\App\Models\City::where('status', 1)->where('state_id', $address->state_id)->get() as $key => $city)
                                                        <option value="{{ $city->id }}"
                                                            @if ($address->city_id != null) @if ($address->city_id == $city->id)
                                                                    selected @endif
                                                            @endif>
                                                            {{ $city->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="custom_select">
                                            <input type="text" class="input-text" name="postal_code" id="postal_code" placeholder="Postal Code" value="{{ $address->postal_code ?? '' }}" autocomplete="postal-code" required />
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="custom_select">
                                            <input type="tel"  class="input-text" name="phone" id="phone" placeholder="Phone" value="{{ $address->phone ?? '' }}" autocomplete="tel" required />
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="custom_select">
                                            <input type="email" class="input-text " name="email" id="email" placeholder="" value="{{ Auth::user()->email ?? '' }}" autocomplete="email username" required />
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <div class="custom_select">
                                            <textarea rows="5" placeholder="Address" name="address" id="address" required>{{ $address->address ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="ship_detail">
                                    <div class="form-group">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" id="differentaddress" name="ship_to_different_address" value="1">
                                                <label class="form-check-label label_info" data-bs-toggle="collapse" data-target="#collapseAddress" href="#collapseAddress" aria-controls="collapseAddress" for="differentaddress"><span>Ship to a different address?</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapseAddress" class="different_address collapse in">
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <input type="text" name="shipping_first_name" id="shipping_first_name" placeholder="First name *">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <input type="text" name="shipping_last_name" id="shipping_last_name" placeholder="Last name *">
                                            </div>
                                            <div class="row shipping_calculator">
                                                <div class="form-group col-lg-6">
                                                    <div class="custom_select w-100">
                                                        <select class="form-control select-active" name="shipping_country_id"
                                                        id="shipping_country_id">
                                                            <option value="">Select an Country...</option>
                                                            @foreach(\App\Models\Country::where('status',1)->get() as $key => $country)
                                                                <option value="{{ $country->id }}" country_code={{ $country->code }}>
                                                                    {{ $country->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="custom_select w-100">
                                                        <select class="form-control select-active" name="shipping_state_id" id="shipping_state_id" >
                                                            <option value="">Select an State...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="custom_select w-100">
                                                        <select class="form-control select-active" name="shipping_city_id" id="shipping_city_id">
                                                            <option value="">Select an City...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="custom_select">
                                                        <input type="text" class="input-text" name="shipping_billing_postcode" id="shipping_billing_postcode" placeholder="Postal Code" autocomplete="postal-code" />
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="custom_select">
                                                        <input type="tel"  class="input-text" name="shipping_phone" id="shipping_phone" placeholder="Phone" autocomplete="tel" />
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="custom_select">
                                                        <input type="email" class="input-text " name="shipping_email" id="shipping_email" placeholder="Email" autocomplete="email username" />
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <div class="custom_select">
                                                        <textarea rows="5" placeholder="Address" name="shipping_address" id="shipping_address"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="border p-15 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Your Order</h4>
                        <h6 class="text-muted">Subtotal</h6>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="table-responsive order_table checkout" id="cart_summary">
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
                    </div>
                </div>
                <div class="payment ml-30">
                    <h4 class="mb-30">Payment</h4>
                    <div class="payment_option">
                        @if(get_setting('ngenius') == 1)
                            <div class="custome-radio">
                                <input class="form-check-input" checked required="" type="radio" name="payment_option" id="exampleRadios3" value="ngenius" >
                                <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">{{ translate('Pay via Credit Card')}}</label>
                            </div>
                        @endif
                        @if(get_setting('cash_payment') == 1)
                            @php
                                $digital = 0;
                                $cod_on = 1;
                                foreach($carts as $cartItem){
                                    $product = \App\Models\Product::find($cartItem['product_id']);
                                    if($product['digital'] == 1){
                                        $digital = 1;
                                    }
                                    if($product['cash_on_delivery'] == 0){
                                        $cod_on = 0;
                                    }
                                }
                            @endphp
                            @if($digital != 1 && $cod_on == 1)
                                <div class="custome-radio">
                                    <input value="cash_on_delivery" class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios4" checked="">
                                    <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">{{ translate('Cash on Delivery')}}</label>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="payment-logo d-flex">
                        <img class="mr-15" src="{{uploaded_asset(get_setting("payment_method_images"))}}" alt="">
                    </div>
                    <button type="submit" class="btn btn-fill-out btn-block mt-30">{{ translate('Place an Order')}}<i class="fi-rs-sign-out ml-15"></i></button>
                    {{-- <a href="#" class="btn btn-fill-out btn-block mt-30">Place an Order<i class="fi-rs-sign-out ml-15"></i></a> --}}
                </div>
            </div>
        </form>
        </div>
    </div>

</main>



{{-- <section class="pt-5 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="row aiz-steps arrow-divider">
                    <div class="col done">
                        <div class="text-center text-success">
                            <i class="la-3x mb-2 las la-shopping-cart"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block ">{{ translate('1. My Cart')}}</h3>
                        </div>
                    </div>
                    <div class="col active">
                        <div class="text-center text-primary">
                            <i class="la-3x mb-2 las la-map"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block ">{{ translate('2. Shipping info')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-truck"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 ">{{ translate('3. Delivery info')}}
                            </h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-credit-card"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 ">{{ translate('4. Payment')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-check-circle"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 ">{{ translate('5. Confirmation')}}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mb-4 gry-bg">
    <div class="container">
        <div class="row cols-xs-space cols-sm-space cols-md-space">
            <div class="col-xxl-8 col-xl-10 mx-auto">
                <form class="form-default" data-toggle="validator"
                    action="{{ route('checkout.store_shipping_infostore') }}" role="form" method="POST">
                    @csrf
                    @if(Auth::check())
                    <div class="shadow-sm bg-white p-4 rounded mb-4">
                        <div class="row gutters-5">
                            @foreach (Auth::user()->addresses as $key => $address)
                            <div class="col-md-6 mb-3">
                                <label class="aiz-megabox d-block bg-white mb-0">
                                    <input type="radio" name="address_id" value="{{ $address->id }}" @if
                                        ($address->set_default)
                                    checked
                                    @endif required>
                                    <span class="d-flex p-3 aiz-megabox-elem">
                                        <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                        <span class="flex-grow-1 pl-3 text-left">
                                            <div>
                                                <span class="opacity-60">{{ translate('Address') }}:</span>
                                                <span class="fw-600 ml-2">{{ $address->address }}</span>
                                            </div>
                                            <div>
                                                <span class="opacity-60">{{ translate('Postal Code') }}:</span>
                                                <span class="fw-600 ml-2">{{ $address->postal_code }}</span>
                                            </div>
                                            <div>
                                                <span class="opacity-60">{{ translate('City') }}:</span>
                                                <span class="fw-600 ml-2">{{ optional($address->city)->name }}</span>
                                            </div>
                                            <div>
                                                <span class="opacity-60">{{ translate('State') }}:</span>
                                                <span class="fw-600 ml-2">{{ optional($address->state)->name }}</span>
                                            </div>
                                            <div>
                                                <span class="opacity-60">{{ translate('Country') }}:</span>
                                                <span class="fw-600 ml-2">{{ optional($address->country)->name }}</span>
                                            </div>
                                            <div>
                                                <span class="opacity-60">{{ translate('Phone') }}:</span>
                                                <span class="fw-600 ml-2">{{ $address->phone }}</span>
                                            </div>
                                        </span>
                                    </span>
                                </label>
                                <div class="dropdown position-absolute right-0 top-0">
                                    <button class="btn bg-gray px-2" type="button" data-toggle="dropdown">
                                        <i class="la la-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" onclick="edit_address('{{$address->id}}')">
                                            {{ translate('Edit') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <input type="hidden" name="checkout_type" value="logged">
                            <div class="col-md-6 mx-auto mb-3">
                                <div class="border p-3 rounded mb-3 c-pointer text-center bg-white h-100 d-flex flex-column justify-content-center"
                                    onclick="add_new_address()">
                                    <i class="las la-plus la-2x mb-3"></i>
                                    <div class="alpha-7">{{ translate('Add New Address') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center text-md-left order-1 order-md-0">
                            <a href="{{ route('home') }}" class="btn btn-link">
                                <i class="las la-arrow-left"></i>
                                {{ translate('Return to shop')}}
                            </a>
                        </div>
                        <div class="col-md-6 text-center text-md-right">
                            <button type="submit" class="btn btn-primary fw-600">{{ translate('Continue to Delivery
                                Info')}}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section> --}}

@endsection

{{-- @section('modal')
@include('frontend.partials.address_modal')
@endsection --}}

@section('script')
    <script type="text/javascript">
        function add_new_address() {
            $('#new-address-modal').modal('show');
        }

        function edit_address(address) {
            var url = '{{ route('addresses.edit', ':id') }}';
            url = url.replace(':id', address);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#edit_modal_body').html(response.html);
                    $('#edit-address-modal').modal('show');
                    AIZ.plugins.bootstrapSelect('refresh');

                    @if (get_setting('google_map') == 1)
                        var lat = -33.8688;
                        var long = 151.2195;

                        if(response.data.address_data.latitude && response.data.address_data.longitude) {
                        lat = response.data.address_data.latitude;
                        long = response.data.address_data.longitude;
                        }

                        initialize(lat, long, 'edit_');
                    @endif
                }
            });
        }

        $(document).ready(function() {
            var country_code = $("#country_id").find('option:selected').attr("country_code");
            $("#cart_summary").html("");
            $.post('{{ route('cart.cart_summary') }}', {
                _token: AIZ.data.csrf,
                country_code: country_code
            }, function(data) {
                $("#cart_summary").html(data);
            });
        });


        $(document).on('change', '[name=country_id]', function() {
            var country_id = $(this).val();
            if ($('#differentaddress').is(":checked") == false) {
                var country_code = $("#country_id").find('option:selected').attr("country_code");
                $("#cart_summary").html("");
                $.post('{{ route('cart.cart_summary') }}', {
                    _token: AIZ.data.csrf,
                    country_code: country_code
                }, function(data) {
                    $("#cart_summary").html(data);
                });
            }
            get_states(country_id);
        });

        $(document).on('change', '[name=state_id]', function() {
            var state_id = $(this).val();
            get_city(state_id);
        });

        function get_states(country_id) {
            $('[name="state"]').html("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('get-state') }}",
                type: 'POST',
                data: {
                    country_id: country_id
                },
                success: function(response) {
                    var obj = JSON.parse(response);
                    if (obj != '') {
                        $('[name="state_id"]').html(obj);
                        AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }

        function get_city(state_id) {
            $('[name="city"]').html("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('get-city') }}",
                type: 'POST',
                data: {
                    state_id: state_id
                },
                success: function(response) {
                    var obj = JSON.parse(response);
                    if (obj != '') {
                        $('[name="city_id"]').html(obj);
                        AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }


        // shipping

        $(document).on('change', '[name=shipping_country_id]', function() {
            var country_id = $(this).val();
            if ($('#differentaddress').is(":checked") == true) {
                var country_code = $("#shipping_country_id").find('option:selected').attr("country_code");
                $("#cart_summary").html("");
                $.post('{{ route('cart.cart_summary') }}', {
                    _token: AIZ.data.csrf,
                    country_code: country_code
                }, function(data) {
                    $("#cart_summary").html(data);
                });
            }
            shipping_get_states(country_id);
        });

        $(document).on('change', '[name=shipping_state_id]', function() {
            var state_id = $(this).val();
            shipping_get_city(state_id);
        });

        function shipping_get_states(country_id) {
            $('[name="shipping_state_id"]').html("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('get-state') }}",
                type: 'POST',
                data: {
                    country_id: country_id
                },
                success: function(response) {
                    var obj = JSON.parse(response);
                    if (obj != '') {
                        $('[name="shipping_state_id"]').html(obj);
                        AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }

        function shipping_get_city(state_id) {
            $('[name="shipping_city_id"]').html("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('get-city') }}",
                type: 'POST',
                data: {
                    state_id: state_id
                },
                success: function(response) {
                    var obj = JSON.parse(response);
                    if (obj != '') {
                        $('[name="shipping_city_id"]').html(obj);
                        AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }
        $(document).ready(function() {
            $('#differentaddress').click(function() {
                console.log($(this), $(this).is(":checked"));
                if ($(this).is(":checked") == true) {
                    $("#shipping_first_name").attr('required', 'required');
                    $("#shipping_last_name").attr('required', 'required');
                    $("#shipping_country_id").attr('required', 'required');
                    $("#shipping_state_id").attr('required', 'required');
                    $("#shipping_city_id").attr('required', 'required');
                    $("#shipping_billing_postcode").attr('required', 'required');
                    $("#shipping_address").attr('required', 'required');
                    $("#shipping_phone").attr('required', 'required');
                    $("#shipping_email").attr('required', 'required');
                }
            });
        });

        $(document).on("click", "#coupon-apply",function() {
            var data = new FormData($('#apply-coupon-form')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{route('checkout.apply_coupon_code')}}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data, textStatus, jqXHR) {
                    AIZ.plugins.notify(data.response_message.response, data.response_message.message);
                        // console.log(data.response_message);
                    $("#cart_summary").html(data.html);
                }
            })
        });

        $(document).on("click", "#coupon-remove",function() {
            var data = new FormData($('#remove-coupon-form')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{route('checkout.remove_coupon_code')}}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data, textStatus, jqXHR) {
                    $("#cart_summary").html(data);
                }
            })
        })

    </script>
@endsection
