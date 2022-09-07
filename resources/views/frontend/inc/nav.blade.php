@if(get_setting('topbar_banner') != null)
<div class="position-relative top-banner removable-session z-1035 d-none" data-key="top-banner" data-value="removed">
    <a href="{{ get_setting('topbar_banner_link') }}" class="d-block text-reset">
        <img src="{{ uploaded_asset(get_setting('topbar_banner')) }}" class="w-100 mw-100 h-50px h-lg-auto img-fit">
    </a>
    <button class="btn text-white absolute-top-right set-session" data-key="top-banner" data-value="removed" data-toggle="remove-parent" data-parent=".top-banner">
        <i class="la la-close la-2x"></i>
    </button>
</div>
@endif
<div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{static_asset("asset/imgs/theme/BiizelItems.gif")}}" width="80" alt="" />
                </div>
            </div>
        </div>
    </div>
<header class="header-area header-style-1 header-height-2">
    <div class="mobile-promotion d-none">
        <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>
    </div>

    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    @php
                        $header_logo = get_setting('header_logo');
                    @endphp
                    <a href="{{ route('home') }}">
                        @if($header_logo != null)
                            <img src="{{ uploaded_asset($header_logo) }}" height="80" alt="{{ env('APP_NAME') }}" />
                        @else
                            <img src="{{ static_asset('assets/img/logo.png') }}" height="80" alt="{{ env('APP_NAME') }}" />
                        @endif
                    </a>
                </div>

                <div class="header-right">
                    <div class="search-style-2">
                        @php $top10_categories = json_decode(get_setting('top10_categories')); @endphp
                        <form action="#" class="mx-auto">
                           
                            <input type="text" id="search" name="q"
                                placeholder="{{ translate('Search for items') }}..." />
                            <div class="typed-search-box stop-propagation document-click-d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100 d-none"
                                style="min-height: 200px; z-index: 222; top: 100%" id="sugguestlist">
                                <div class="search-preloader absolute-top-center d-none">
                                    <div class="dot-loader">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                                <div class="search-nothing d-none p-3 text-center fs-16"></div>
                                <div id="search-content" class="text-left"></div>
                            </div>
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
                            {{-- <div class="search-location">
                                <form action="#">
                                    <select class="select-active">
                                        <option>Your Language</option>
                                        <option>English</option>
                                    </select>
                                </form>
                            </div> --}}
                            <div class="wishlist-count" id="wishlist-count">
                                @include('frontend.partials.wishlist')
                            </div>
                            @php
                                if (auth()->user() != null) {
                                    $user_id = Auth::user()->id;
                                    $cart = \App\Models\Cart::where('user_id', $user_id)->get();
                                } else {
                                    $temp_user_id = Session()->get('temp_user_id');
                                    if ($temp_user_id) {
                                        $cart = \App\Models\Cart::where('temp_user_id', $temp_user_id)->get();
                                    }
                                }
                            @endphp
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="#">
                                    <img alt="Nest"
                                        src="{{ static_asset('assets/imgs/theme/icons/icon-cart.svg') }}" />
                                    @if (isset($cart))
                                        <span class="pro-count blue cart-count">{{ count($cart) }}</span>
                                    @else
                                        <span class="pro-count blue cart-count">0</span>
                                    @endif
                                </a>
                                <a href="{{ route('cart') }}"><span
                                        class="lable">{{ translate('Cart') }}</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 " id="cart_items">
                                        @include('frontend.partials.cart')
                                    </div>
                            </div>
                            <div class="header-action-icon-2">
                                <a href="#">
                                    <img class="svgInject" alt="Nest"
                                        src="{{ static_asset('assets/imgs/theme/icons/icon-user.svg') }}" />
                                </a>
                                @auth
                                    @if (isAdmin())
                                        <a href="{{ route('admin.dashboard') }}"><span
                                                class="lable ml-0">{{ translate('Account') }}</span></a>
                                    @else
                                        <a href="{{ route('dashboard') }}"><span
                                                class="lable ml-0">{{ translate('Account') }}</span></a>
                                    @endif
                                @else
                                    <a href="{{ route('user.login') }}"><span
                                            class="lable ml-0">{{ translate('Sign in') }}</span></a>
                                @endauth
                                @auth
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            @if (isAdmin())
                                                <li><a href="{{ route('admin.dashboard') }}"><i
                                                            class="fi fi-rs-user mr-10"></i>
                                                        {{ translate('My Account') }}</a></li>
                                            @else
                                                <li><a href="{{ route('dashboard') }}"><i
                                                            class="fi fi-rs-user mr-10"></i>
                                                        {{ translate('My Account') }}</a></li>
                                            @endif
                                            <li><a href="{{ route('wishlists.index') }}"><i
                                                        class="fi fi-rs-heart mr-10"></i>
                                                    {{ translate('My Wishlist') }}</a></li>
                                                <li><a href="{{ route('logout') }}"><i
                                                            class="fi fi-rs-sign-out mr-10"></i>
                                                        {{ translate('Logout') }}</a></li>
                                        </ul>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="{{route('home')}}">
                        @if($header_logo != null)
                            <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="" height="50">
                        @else
                            <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="" height="50">
                        @endif
                    </a>
                </div>
                <div class="main-categori-wrap d-none d-lg-block">
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categories-button-active" href="#">
                            <span class="fi-rs-apps"></span><span class="et">{{translate("Browse")}}</span> {{ translate('All Categories') }}
                            <i class="fi-rs-angle-down"></i>
                        </a>
                        <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
						@php
                            $categories_features = \App\Models\Category::where('featured', 1)->get();
						@endphp

						@if (count($categories_features)>0)
                            <div class="d-flex categori-dropdown-inner hide-dropdown">
                                <!--<ul>
                                    @php
									 if (count($categories_features)>1) {
                                        $pieces = array_chunk($categories_features->toArray(), ceil(count($categories_features->toArray()) / 2));
										}else{
										$pieces[0] = $categories_features;
										$pieces[1]=[];
										}
                                    @endphp
                                    @foreach ($pieces[0] as $key => $categories_feature)
                                        <li>
                                            <a href="{{ route('products.category', $categories_feature['slug']) }}">
                                                <img src="{{ uploaded_asset($categories_feature['icon']) }}"
                                                    alt="" />{{ translate($categories_feature['name']) }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="end">
                                    @foreach ($pieces[1] as $categories_feature)
                                        <li>
                                            <a href="{{ route('products.category', $categories_feature['slug']) }}">
                                                <img src="{{ uploaded_asset($categories_feature['icon']) }}"
                                                    alt="" />{{ translate($categories_feature['name']) }}</a>
                                        </li>
                                    @endforeach
                                </ul>-->
								<ul style="display: flex; flex-wrap: wrap;row-gap: 1rem; justify-content: space-between;">
                                    @foreach ($categories_features as $categories_feature)
                                        <li style="width: 49%!important; margin : 0;padding :9px 18px">
                                            <a href="{{ route('products.category', $categories_feature->slug) }}">
                                                <img src="{{ uploaded_asset($categories_feature->icon) }}"
                                                    alt="" />{{ $categories_feature->getTranslation('name') }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
							 @endif
                            @if (count($categories_features) > 10)
                                <div class="more_categories"><span class="icon"></span> <span
                                        class="heading-sm-1" id="hidword">{{ translate('Show More') }}...</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading ha8_nav">
                        @include('frontend.partials.main_menu')
                    </div>
                </div>
                <div class="hotline d-none d-lg-flex">
                    <img src="{{static_asset("assets/imgs/theme/icons/icon-headphone-white.svg")}}" alt="hotline" />
                    <p><a href="tel:{{ get_setting('contact_phone',null,App::getLocale()) }}">{{ get_setting('contact_phone',null,App::getLocale()) }}</a><span>24/7 Support Center</span></p>
                </div>
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>
                @php $agent = useragent(); @endphp
                @if ($agent->isMobile())
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="wishlist-count" id="wishlist-count">
                                @include('frontend.partials.wishlist')
                            </div>
                            @php
                                if (auth()->user() != null) {
                                    $user_id = Auth::user()->id;
                                    $cart = \App\Models\Cart::where('user_id', $user_id)->get();
                                } else {
                                    $temp_user_id = Session()->get('temp_user_id');
                                    if ($temp_user_id) {
                                        $cart = \App\Models\Cart::where('temp_user_id', $temp_user_id)->get();
                                    }
                                }
                            @endphp
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{route('cart')}}">
                                    <img alt="Biizel" src="{{static_asset("assets/imgs/theme/icons/icon-cart.svg")}}">
                                    @if (isset($cart))
                                        <span class="pro-count white cart-count">{{count($cart)}}</span>
                                    @else
                                        <span class="pro-count white cart-count">0</span>
                                    @endif
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2 " id="mob_cart_items">
                                    @include('frontend.partials.mob_cart')
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</header>

@include('frontend.partials.mobile_menu')


<script>
    const more_categories_btn = document.querySelector('.more_categories');
    if (more_categories_btn) {
        more_categories_btn.addEventListener('click', function() {
            document.querySelector('.d-flex.categori-dropdown-inner').classList.toggle('hide-dropdown');
            if (document.querySelector('.d-flex.categori-dropdown-inner').classList.contains('hide-dropdown')) {
                console.log(true)
                document.getElementById("hidword").innerHTML = "{{translate('Show more')}}";
            }
            else{
                document.getElementById("hidword").innerHTML = "{{translate('Show less')}}";

            }
        });
    }
</script>
