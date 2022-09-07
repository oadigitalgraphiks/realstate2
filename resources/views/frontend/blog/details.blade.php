@extends('frontend.layouts.app')

@section('meta_title'){{ $blog->meta_title }}@stop

@section('meta_description'){{ $blog->meta_description }}@stop

@section('meta_keywords'){{ $blog->meta_keywords }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $blog->meta_title }}">
    <meta itemprop="description" content="{{ $blog->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($blog->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $blog->meta_title }}">
    <meta name="twitter:description" content="{{ $blog->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($blog->meta_img) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $blog->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('blog.details', $blog->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($blog->meta_img) }}" />
    <meta property="og:description" content="{{ $blog->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endsection

@section('content')

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route("home")}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                @if ($blog->category_id != null && $blog->category_id != 0)
                    <span></span> {{$blog->category->category_name}}
                @endif
                <span></span> {{$blog->title}}
            </div>
        </div>
    </div>
    <div class="page-content mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 m-auto">
                    <div class="single-page pt-50 pr-30">
                        <div class="single-header style-2">
                            <div class="row">
                                <div class="col-xl-10 col-lg-12 m-auto">
                                    <h6 class="mb-10"><a href="#">{{ $blog->category_id != 0 ? $blog->category->category_name : ""}}</a></h6>
                                    <h2 class="mb-10">{{$blog->title}}</h2>
                                    <div class="single-header-meta">
                                        <div class="entry-meta meta-1 font-xs mt-15 mb-15">
                                            <span class="post-on has-dot">{{date_format($blog->created_at,'d/M/Y')}}</span>
                                        </div>
                                        <div class="social-icons single-share">
                                            <ul class="text-grey-5 d-inline-block">
                                                <li class="mr-5"><a href="#"><img src="" alt=""></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <figure class="single-thumbnail">
                            <img src="{{uploaded_asset($blog->banner)}}" alt="">
                        </figure>
                        <div class="single-content">
                            <div class="row">
                                <div class="col-xl-10 col-lg-12 m-auto">
                                    <p class="single-excerpt">{!! $blog->description !!}</p>
                                    <!--Entry bottom-->
                                    {{-- <div class="entry-bottom mt-50 mb-30">
                                        <div class="social-icons single-share">
                                            <ul class="text-grey-5 d-inline-block">
                                                <li><strong class="mr-10">Share this:</strong></li>
                                                <li class="social-facebook"><a href="#"><img src="assets/imgs/theme/icons/icon-facebook.svg" alt=""></a></li>
                                                <li class="social-twitter"> <a href="#"><img src="assets/imgs/theme/icons/icon-twitter.svg" alt=""></a></li>
                                                <li class="social-instagram"><a href="#"><img src="assets/imgs/theme/icons/icon-instagram.svg" alt=""></a></li>
                                                <li class="social-linkedin"><a href="#"><img src="assets/imgs/theme/icons/icon-pinterest.svg" alt=""></a></li>
                                            </ul>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>

@endsection


@section('script')
    @if (get_setting('facebook_comment') == 1)
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0&appId={{ env('FACEBOOK_APP_ID') }}&autoLogAppEvents=1" nonce="ji6tXwgZ"></script>
    @endif
@endsection
