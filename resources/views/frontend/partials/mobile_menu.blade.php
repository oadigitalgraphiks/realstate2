<div id="nt_menu_canvas" class="nt_fk_canvas mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="{{route('home')}}"><img src="{{uploaded_asset(get_setting('header_logo'))}}" alt="logo" /></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="#">
                    <input id="search_mob" name="q" type="text" placeholder="{{ translate('Search for items') }}..." />
                    <button type="submit"><i class="fi-rs-search"></i></button>
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
                                <div id="search-content_mob" class="text-left"></div>
                            </div>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul id="menu_mb_ul" class="mobile-menu font-heading nt_mb_menu">
                        @foreach (\App\Models\Menu::where('parent_id', 0)->where('status',0)->orderBy('position', 'asc')->get() as $key => $menu)
                            <li class="menu-item menu-item-has-children mob-menus-nav-element" data-id="{{ $menu->id }}">
                                <?php if($menu->type=='category' && $menu->category_id!=0) {
                                    $cat=\App\Models\Category::find($menu->category_id);?>
                                <a href="{{ route('products.category',  $cat->slug) }}" target="{{ $menu->target }}">
                                    <?php }elseif($menu->type=='brand' && $menu->brand_id!=0) {
                                         $brand=\App\Models\Brand::find($menu->brand_id); ?>
                                    <a href="{{ route('products.brand',  $brand->slug) }}" target="{{ $menu->target }}">
                                    <?php }elseif($menu->type=='custom'){?>
                                    <a href="{{ url($menu->url) }}" target="{{ $menu->target }}">
                                        <?php }?>
                                        {{ $menu->getTranslation('name') }}</a>
                            </li>
                        @endforeach
                        <li class="menu-item-has-children">
                            <a href="#">Categories</a>
                            @php
                                $categories_features = \App\Models\Category::where('featured', 1)->get();
                            @endphp
                            <ul class="dropdown">
                                @foreach ($categories_features as $category)
                                    <li><a href="{{ route('products.category',  $category->slug) }}">{{$category->getTranslation('name')}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap">
                {{-- <div class="single-mobile-header-info">
                    <a href="page-contact.html"><i class="fi-rs-marker"></i> Our location </a>
                </div> --}}
                @auth
                    <div class="single-mobile-header-info">
                        <a href="{{ route('dashboard') }}"><i class="fi fi-rs-user mr-10"></i>{{ translate('My Account') }}</a>
                    </div>
                @endauth
                <div class="single-mobile-header-info">
                    @auth
                        <a href="{{route('logout')}}"><i class="fi-rs-power"></i>{{translate('Logout')}} </a>
                    @else
                        <a href="{{route('user.login')}}"><i class="fi-rs-user"></i>{{translate('Log In / Sign Up')}} </a>
                    @endauth
                </div>
                <div class="single-mobile-header-info">
                    <a href="#"><i class="fi-rs-headphones"></i>{{ get_setting('contact_phone') }} </a>
                </div>
            </div>
            <div class="mobile-social-icon mb-50">
                <h6 class="mb-15">{{translate('Follow Us')}}</h6>
                @if ( get_setting('facebook_link') !=  null )
                <a href="{{ get_setting('facebook_link') }}"><img src="{{static_asset('assets/imgs/theme/icons/icon-facebook-white.svg')}}" alt="" /></a>
                @endif
                @if ( get_setting('twitter_link') !=  null )
                    <a href="{{ get_setting('twitter_link') }}"><img src="{{static_asset('assets/imgs/theme/icons/icon-twitter-white.svg')}}" alt="" /></a>
                @endif
                @if ( get_setting('instagram_link') !=  null )
                    <a href="{{get_setting('instagram_link')}}"><img src="{{static_asset('assets/imgs/theme/icons/icon-instagram-white.svg')}}" alt="" /></a>
                @endif
                @if ( get_setting('youtube_link') !=  null )
                    <a href="{{get_setting('youtube_link')}}"><img src="{{static_asset('assets/imgs/theme/icons/icon-youtube-white.svg')}}" alt="" /></a>
                @endif
            </div>
            <div class="site-copyright">
                @php
                    echo get_setting('frontend_copyright_text');
                @endphp
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
{{--<script--}}
{{--        src="https://code.jquery.com/jquery-2.2.4.min.js"--}}
{{--        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="--}}
{{--        crossorigin="anonymous"></script>--}}
{{--<script>--}}
<script>
    if ($("#lang-change .dropdown-menu2").length > 0) {
        $("#lang-change .dropdown-menu2").each(function() {
            $(this).on('change', function(e){
                e.preventDefault();
                var locale = $(this).find(":selected").data('flag');
                $.post('{{ route('language.change') }}',{_token: AIZ.data.csrf, locale:locale}, function(data){
                    location.reload();
                });
            });
        });
    }
</script>
