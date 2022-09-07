@extends('frontend.layouts.app')

@section('meta_title'){{ $page->meta_title }}@stop

@section('meta_description'){{ $page->meta_description }}@stop

@section('meta_keywords'){{ $page->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $page->meta_title }}">
    <meta itemprop="description" content="{{ $page->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($page->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $page->meta_title }}">
    <meta name="twitter:description" content="{{ $page->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($page->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($page->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $page->meta_title }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ URL($page->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($page->meta_img) }}" />
    <meta property="og:description" content="{{ $page->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:price:amount" content="{{ single_price($page->unit_price) }}" />
@endsection
@php
    if (Session::has('locale')) {
        $lang = Session::get('locale', Config::get('app.locale'));
    } else {
        $lang = 'en';
    }
@endphp
@section('content')
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a> <span></span> About us
            </div>
        </div>
    </div>
    <div class="page-content pt-50 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 m-auto">
                    <section class="row align-items-center about-section">
                        <div class="col-lg-6">
                            <img src="{{uploaded_asset(get_setting('about_images'))}}" alt="" class="mb-md-3 mb-lg-0 mb-sm-4" />
                        </div>
                        <div class="col-lg-6">
                            <div class="pl-25">
                                <h2 class="mb-30">{{ get_setting('about_heading', null, $lang) ?? "" }}</h2>
                                <p class="mb-25">{!! str_replace(array("\r\n","\n"),'<br>',get_setting('about_description',null,$lang)) !!}</p>
                            </div>
                        </div>
                    </section>
                    <section class="row align-items-center about-section">
                        <div class="col-lg-6">
                            <div class="pl-25">
                                <h2 class="mb-30">{{ get_setting('about_second_heading', null, $lang) ?? "" }}</h2>
                                <p class="mb-25">{!! str_replace(array("\r\n","\n"),'<br>',get_setting('about_second_description',null,$lang)) !!}</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <img src="{{ uploaded_asset(get_setting('about_second_images')) }}" alt="" class="mb-md-3 mb-lg-0 mb-sm-4" />
                        </div>
                    </section>
                    <section class="row align-items-center about-section">
                        <div class="col-lg-6">
                            <img src="{{ uploaded_asset(get_setting('about_third_images')) }}" alt="" class="mb-md-3 mb-lg-0 mb-sm-4" />
                        </div>
                        <div class="col-lg-6">
                            <div class="pl-25">
                                <h2 class="mb-30">{{ get_setting('about_third_heading', null, $lang) ?? "" }}</h2>
                                <p class="mb-25">{!! str_replace(array("\r\n","\n"),'<br>',get_setting('about_third_description',null,$lang)) !!}</p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
