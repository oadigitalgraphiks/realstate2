@extends('frontend.layouts.app')

@section('content')

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>{{ translate('Home') }}</a>
                <span></span> {{ translate('Cart') }}
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h1 class="heading-2 mb-10">{{ translate('Your Cart') }}</h1>
                <div class="d-flex justify-content-between">
                    @if ($carts && count($carts) > 0)
                        <h6 class="text-body">{{ translate('There are') }} <span
                                class="text-brand">{{ count($carts) }}</span> {{ translate('products in your cart') }}.
                        </h6>
                    @endif
                </div>
            </div>
        </div>
        <div class="row" id="cart-summary">
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
                                    <tr class="pt-80" style="padding-top:80px">
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
                                            <h4 class="text-brand text-end text-center subtotal">{{ format_price($sum) }}</h4>
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
                                class="btn mb-20 w-100">{{ translate('Continue to Shipping') }}<i class="fi-rs-sign-out ml-15"></i></a>
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
        </div>
    </div>
</main>

{{-- <section class="pt-5 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="row aiz-steps arrow-divider">
                    <div class="col active">
                        <div class="text-center text-primary">
                            <i class="la-3x mb-2 las la-shopping-cart"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block">{{ translate('1. My Cart')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-map"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('2. Shipping info')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-truck"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('3. Delivery info')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-credit-card"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('4. Payment')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-check-circle"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">{{ translate('5. Confirmation')}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mb-4" id="cart-summary">
    <div class="container">
        @if( $carts && count($carts) > 0 )
            <div class="row">
                <div class="col-xxl-8 col-xl-10 mx-auto">
                    <div class="shadow-sm bg-white p-3 p-lg-4 rounded text-left">
                        <div class="mb-4">
                            <div class="row gutters-5 d-none d-lg-flex border-bottom mb-3 pb-3">
                                <div class="col-md-5 fw-600">{{ translate('Product')}}</div>
                                <div class="col fw-600">{{ translate('Price')}}</div>
                                <div class="col fw-600">{{ translate('Tax')}}</div>
                                <div class="col fw-600">{{ translate('Quantity')}}</div>
                                <div class="col fw-600">{{ translate('Total')}}</div>
                                <div class="col-auto fw-600">{{ translate('Remove')}}</div>
                            </div>
                            <ul class="list-group list-group-flush">
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($carts as $key => $cartItem)
                                    @php
                                        $product = \App\Models\Product::find($cartItem['product_id']);
                                        $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();
                                        $total = $total + ($cartItem['price'] + $cartItem['tax']) * $cartItem['quantity'];
                                        $product_name_with_choice = $product->getTranslation('name');
                                        if ($cartItem['variation'] != null) {
                                            $product_name_with_choice = $product->getTranslation('name').' - '.$cartItem['variation'];
                                        }
                                    @endphp
                                    <li class="list-group-item px-0 px-lg-3">
                                        <div class="row gutters-5">
                                            <div class="col-lg-5 d-flex">
                                                <span class="mr-2 ml-0">
                                                    <img
                                                        src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                        class="img-fit size-60px rounded"
                                                        alt="{{ $product->getTranslation('name')  }}"
                                                    >
                                                </span>
                                                <span class="fs-14 opacity-60">{{ $product_name_with_choice }}</span>
                                            </div>

                                            <div class="col-lg col-4 order-1 order-lg-0 my-3 my-lg-0">
                                                <span class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Price')}}</span>
                                                <span class="fw-600 fs-16">{{ single_price($cartItem['price']) }}</span>
                                            </div>
                                            <div class="col-lg col-4 order-2 order-lg-0 my-3 my-lg-0">
                                                <span class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Tax')}}</span>
                                                <span class="fw-600 fs-16">{{ single_price($cartItem['tax']) }}</span>
                                            </div>

                                            <div class="col-lg col-6 order-4 order-lg-0">
                                                @if($cartItem['digital'] != 1 && $product->auction_product == 0)
                                                    <div class="row no-gutters align-items-center aiz-plus-minus mr-2 ml-0">
                                                        <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="minus" data-field="quantity[{{ $cartItem['id'] }}]">
                                                            <i class="las la-minus"></i>
                                                        </button>
                                                        <input type="number" name="quantity[{{ $cartItem['id'] }}]" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="{{ $cartItem['quantity'] }}" min="{{ $product->min_qty }}" max="{{ $product_stock->qty }}" onchange="updateQuantity({{ $cartItem['id'] }}, this)">
                                                        <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="plus" data-field="quantity[{{ $cartItem['id'] }}]">
                                                            <i class="las la-plus"></i>
                                                        </button>
                                                    </div>
                                                @elseif($product->auction_product == 1)
                                                    <span class="fw-600 fs-16">1</span>
                                                @endif
                                            </div>
                                            <div class="col-lg col-4 order-3 order-lg-0 my-3 my-lg-0">
                                                <span class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Total')}}</span>
                                                <span class="fw-600 fs-16 text-primary">{{ single_price(($cartItem['price'] + $cartItem['tax']) * $cartItem['quantity']) }}</span>
                                            </div>
                                            <div class="col-lg-auto col-6 order-5 order-lg-0 text-right">
                                                <a href="javascript:void(0)" onclick="removeFromCartView(event, {{ $cartItem['id'] }})" class="btn btn-icon btn-sm btn-soft-primary btn-circle">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="px-3 py-2 mb-4 border-top d-flex justify-content-between">
                            <span class="opacity-60 fs-15">{{translate('Subtotal')}}</span>
                            <span class="fw-600 fs-17">{{ single_price($total) }}</span>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-6 text-center text-md-left order-1 order-md-0">
                                <a href="{{ route('home') }}" class="btn btn-link">
                                    <i class="las la-arrow-left"></i>
                                    {{ translate('Return to shop')}}
                                </a>
                            </div>
                            <div class="col-md-6 text-center text-md-right">
                                @if(Auth::check())
                                    <a href="{{ route('checkout.shipping_info') }}" class="btn btn-primary fw-600">
                                        {{ translate('Continue to Shipping')}}
                                    </a>
                                @else
                                    <button class="btn btn-primary fw-600" onclick="showCheckoutModal()">{{ translate('Continue to Shipping')}}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="shadow-sm bg-white p-4 rounded">
                        <div class="text-center p-3">
                            <i class="las la-frown la-3x opacity-60 mb-3"></i>
                            <h3 class="h4 fw-700">{{translate('Your Cart is empty')}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section> --}}

@endsection

@section('modal')
    <div class="modal fade custom-modal" id="login-modal" tabindex="-1" aria-labelledby="quickViewModalLabel"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600">{{ translate('Login')}}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                            @csrf
                            @if (addon_is_activated('otp_system') && env("DEMO_MODE") != "On")
                                <div class="form-group phone-form-group mb-1">
                                    <input type="tel" id="phone-code" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off">
                                </div>

                                <input type="hidden" name="country_code" value="">

                                <div class="form-group email-form-group mb-1 d-none">
                                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email" id="email" autocomplete="off">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group text-right">
                                    <button class="btn btn-link p-0 opacity-50 text-reset" type="button" onclick="toggleEmailPhone(this)">{{ translate('Use Email Instead') }}</button>
                                </div>
                            @else
                                <div class="form-group">
                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email" id="email" autocomplete="off">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            @endif

                            <div class="form-group">
                                <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ translate('Password')}}" name="password" id="password">
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class=opacity-60>{{  translate('Remember Me') }}</span>
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('password.request') }}" class="text-reset opacity-60 fs-14">{{ translate('Forgot password?')}}</a>
                                </div>
                            </div>

                            <div class="mb-5">
                                <button type="submit" class="btn btn-primary btn-block fw-600">{{  translate('Login') }}</button>
                            </div>
                        </form>

                    </div>
                    <div class="text-center mb-3">
                        <p class="text-muted mb-0">{{ translate('Dont have an account?')}}</p>
                        <a href="{{ route('user.registration') }}">{{ translate('Register Now')}}</a>
                    </div>
                    @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1)
                        <div class="separator mb-3">
                            <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                        </div>
                        <ul class="list-inline social colored text-center mb-3">
                            @if (get_setting('facebook_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                        <i class="lab la-facebook-f"></i>
                                    </a>
                                </li>
                            @endif
                            @if(get_setting('google_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                        <i class="lab la-google"></i>
                                    </a>
                                </li>
                            @endif
                            @if (get_setting('twitter_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                        <i class="lab la-twitter"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function removeFromCartView(e, key){
            e.preventDefault();
            removeFromCart(key);
        }

        function updateQuantity(key, element){
            $.post('{{ route('cart.updateQuantity') }}', {
                _token   :  AIZ.data.csrf,
                id       :  key,
                quantity :  element.value
            }, function(data){
                updateNavCart(data.nav_cart_view,data.cart_count);
                $('#cart-summary').html(data.cart_view);
            });
        }

        function showCheckoutModal(){
            $('#login-modal').modal('show');
        }

        // Country Code
        var isPhoneShown = true,
            countryData = window.intlTelInputGlobals.getCountryData(),
            input = document.querySelector("#phone-code");

        for (var i = 0; i < countryData.length; i++) {
            var country = countryData[i];
            if(country.iso2 == 'bd'){
                country.dialCode = '88';
            }
        }

        var iti = intlTelInput(input, {
            separateDialCode: true,
            utilsScript: "{{ static_asset('assets/js/intlTelutils.js') }}?1590403638580",
            onlyCountries: @php echo json_encode(\App\Models\Country::where('status', 1)->pluck('code')->toArray()) @endphp,
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                if(selectedCountryData.iso2 == 'bd'){
                    return "01xxxxxxxxx";
                }
                return selectedCountryPlaceholder;
            }
        });

        var country = iti.getSelectedCountryData();
        $('input[name=country_code]').val(country.dialCode);

        input.addEventListener("countrychange", function(e) {
            // var currentMask = e.currentTarget.placeholder;

            var country = iti.getSelectedCountryData();
            $('input[name=country_code]').val(country.dialCode);

        });

        function toggleEmailPhone(el){
            if(isPhoneShown){
                $('.phone-form-group').addClass('d-none');
                $('.email-form-group').removeClass('d-none');
                $('input[name=phone]').val(null);
                isPhoneShown = false;
                $(el).html('{{ translate('Use Phone Instead') }}');
            }
            else{
                $('.phone-form-group').removeClass('d-none');
                $('.email-form-group').addClass('d-none');
                $('input[name=email]').val(null);
                isPhoneShown = true;
                $(el).html('{{ translate('Use Email Instead') }}');
            }
        }
    </script>
@endsection
