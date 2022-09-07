<footer class="main">
    <section class="featured section-padding">
        <div class="container">
            <div class="row">
                @if (get_setting('footer_widget_title') != null)
                    @foreach (json_decode(get_setting('footer_widget_title'), true) as $key => $value)
                        <div class="col-lg-3 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
                            <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay="0">
                                <div class="banner-icon">
                                    <img src="{{ uploaded_asset(json_decode(get_setting('footer_widget_images'), true)[$key]) ?? "" }}" alt="" />
                                </div>
                                <div class="banner-text">
                                    <h3 class="icon-box-title">{{$value}}</h3>
                                    <!--<p>{{ json_decode(get_setting('footer_widget_title2'), true)[$key] ?? "" }}</p>-->
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col-lg-4">
                    <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <div class="logo mb-30">
						<a href="{{ route('home') }}" class="d-block mb-15">
                        @if(get_setting('footer_logo') != null)
                            <img class="lazyload" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="{{ env('APP_NAME') }}" height="130">
                        @else
                            <img class="lazyload" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" height="130">
                        @endif
                    </a>
                            <p class="font-lg text-heading">{!! get_setting('about_us_description',null,App::getLocale()) !!}</p>
                        </div>
                    </div>
                </div>
                <div class="footer-link-widget col-lg-2 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                    <h4 class="widget-title">{{ translate('Quick Links') }}</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="{{ route('home') }}">{{ translate('Home') }}</a></li>
                        <li><a href="{{ url('about') }}">{{ translate('About') }}</a></li>
                        <li><a href="{{ route('search') }}">{{ translate('Products') }}</a></li>
                        <li><a href="{{ url('contactus') }}">{{ translate('Contact Us') }}</a></li>
                    </ul>
                </div>
                <div class="footer-link-widget col-lg-3 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                    <h4 class="widget-title">{{ translate('Address') }}</h4>
                    <ul class="contact-infor">
                        <li><img src="{{ static_asset('assets/imgs/theme/icons/icon-location.svg') }}" alt="" /> <span>{{ get_setting('contact_address',null,App::getLocale()) }}</span></li>
                        <li><img src="{{ static_asset('assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><span><a href="tel:{{ get_setting('contact_phone',null,App::getLocale()) }}">{{ get_setting('contact_phone',null,App::getLocale()) }}</a></span></li>
                        <li><img src="{{ static_asset('assets/imgs/theme/icons/icon-email-2.svg') }}" alt="" /><span><a href="mailto:{{ get_setting('contact_email',null,App::getLocale()) }}" class="__cf_email__" data-cfemail="f487959891b4ba918780da979b99">{{ get_setting('contact_email',null,App::getLocale()) }}</a></span></li>

                    </ul>

                </div>

            </div>
    </section>
    <div class="container pb-10 wow animate__animated animate__fadeInUp" data-wow-delay="0">
        <div class="row align-items-center">
            <div class="col-12 mb-10">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <p class="font-sm mb-0">{!! get_setting('frontend_copyright_text',null,App::getLocale()) !!}</p>
            </div>
            <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">

                <div class="hotline d-lg-inline-flex">
                    <img src="{{ static_asset('assets/imgs/theme/icons/phone-call.svg')}}" alt="hotline" />
                    <p>
                      <a href="tel:{{get_setting('contact_phone',null,App::getLocale())}}">{{ get_setting('contact_phone',null,App::getLocale()) }}</a>
                    </p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                <div class="mobile-social-icon">
                    <h6>Follow Us</h6>
					@if ( get_setting('instagram_link') !=  null )
					<a href="{{ get_setting('instagram_link') }}" target="_blank" ><img src="{{ static_asset('assets/imgs/theme/icons/icon-instagram-white.svg')}}" alt="" /></a>
                    @endif
                    @if ( get_setting('facebook_link') !=  null )
					<a href="{{ get_setting('facebook_link') }}" target="_blank" ><img src="{{ static_asset('assets/imgs/theme/icons/icon-facebook-white.svg')}}" alt="" /></a>
                    @endif
                    @if ( get_setting('twitter_link') !=  null )
					<a href="{{ get_setting('twitter_link') }}" target="_blank" ><img src="{{ static_asset('assets/imgs/theme/icons/icon-twitter-white.svg')}}" alt="" /></a>
                    @endif
                    @if ( get_setting('youtube_link') !=  null )
					<a href="{{ get_setting('youtube_link') }}" target="_blank" ><img src="{{ static_asset('assets/imgs/theme/icons/icon-youtube-white.svg')}}" alt="" /></a>
                    @endif
                
                </div>
            </div>
        </div>
    </div>
</footer>
