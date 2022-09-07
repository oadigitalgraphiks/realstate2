@extends('frontend.layouts.app')

@section('content')
@php $agent = useragent(); @endphp

    <main class="main">
        <section class="home-slider position-relative mb-30">
            <div class="container">
                <div class="home-slide-cover mt-30">
                    <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">

					@foreach (\App\Models\Slider::where("status",1)->orderBy("sorting_id","asc")->cursor() as $key => $slider)
					 <?php  //dd($slider->photo); ?>
                        <div class="single-hero-slider single-animation-wrap" style="background-image: url({{$agent->isDesktop() ? uploaded_asset($slider->photo) : uploaded_asset($slider->mobile_photo)}})">
                            <div class="slider-content">
                                <h4 class="display-33 mb-40">
                                    {!! str_replace(array("\r\n","\n"), "<br>", $slider->title1) !!}
                                </h4>
						@if($slider->type=='category' && $slider->category_id!=0 && $slider->button_text !=null)
						  <?php $cat=\App\Models\Category::find($slider->category_id); ?>
							<a href="{{ route('products.category', $cat->slug) }}" class="btn">
						 @elseif($slider->type=='brand' && $slider->brand_id!=0 && $slider->button_text !=null)
							<?php $brand=\App\Brand::find($slider->brand_id); ?>
							 <a href="{{ route('products.brand',  $brand->slug) }}" class="btn">
						 @elseif($slider->type=='custom' && $slider->button_text !=null)
							 <a href="{{ url($slider->link) }}" class="btn">
								{{$slider->button_text}}
						 @endif
						  </a>
                            </div>
                        </div>

                    @endforeach

                    </div>
                    <div class="slider-arrow hero-slider-1-arrow"></div>
                </div>
            </div>
        </section>
        <!--End hero slider-->
        <section class="popular-categories section-padding">
            <div class="container wow animate__animated animate__fadeIn">
                <div class="section-title">
                    <div class="title">
                        <h3>Featured Categories</h3>
                    </div>
                    <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow" id="carausel-10-columns-arrows"></div>
                </div>
                <div class="carausel-10-columns-cover position-relative">
                    <div class="carausel-10-columns" id="carausel-10-columns">

                    </div>
                </div>
            </div>
        </section>
        <div class="marquee">
            <h3>
                @if (json_decode(get_setting('home_ads_first_banner_heading'), true) != null)
                    @foreach (json_decode(get_setting('home_ads_first_banner_heading'), true) as $key => $home_ads_first_banner)
                        @if ($home_ads_first_banner != null)
                            <div><span class="hd_cls-1">{{$home_ads_first_banner}}</span><span class="hd_cls-2 text-red"> {{ json_decode(get_setting('home_ads_first_banner_text'), true)[$key] ?? "" }}</span></div>
                        @endif
                    @endforeach
                @endif
                {{-- <div><span class="hd_cls-1">Scyavuru</span><span class="hd_cls-2 text-red"> Jam</span></div> --}}
            </h3>
        </div>
        <!--End category slider-->
        <section class="banners mb-25">
            <div class="container">
                <div class="row">
                    @if (get_setting("home_widget_section_brand_image") != null)
                        @foreach (json_decode(get_setting("home_widget_section_brand_image", null, 'en'),true) as $key=> $home_widget_section_brand_image)
                            <div class="col-lg-4 col-md-6">
                                <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                                    <img src="{{ uploaded_asset($home_widget_section_brand_image) }}" alt="" />
                                    <div class="banner-text">
                                        <h4>
                                            {{ json_decode(get_setting('home_widget_section_brand_title', null, 'en'),true)[$key] ?? "" }}
                                        </h4>
                                        <a href="{{ json_decode(get_setting('home_widget_section_brand_btn_link', null, 'en'),true)[$key] ?? "" }}" class="btn btn-xs">{{ json_decode(get_setting('home_widget_section_brand_btn_text', null, 'en'),true)[$key] ?? "" }}<i class="fi-rs-arrow-small-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
        <!--End banners-->
        <section class="product-tabs section-padding position-relative">
            <div class="container">
                <div class="section-title style-2 wow animate__animated animate__fadeIn">
                    <h3>Popular Products</h3>
                    <ul class="nav nav-tabs links" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true" onclick="popular_product()">All</button>
                        </li>
                        @if(get_setting('home_categories') != null)
                            @php $home_categories = json_decode(get_setting('home_categories')); @endphp
                            @foreach ($home_categories as $key => $value)
                                @php $category = \App\Models\Category::find($value); @endphp
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="nav-tab-two_{{ $category->id }}" data-bs-toggle="tab" data-bs-target="#{{$category->name}}" type="button" role="tab" aria-controls="{{$category->name}}" data-id="{{ $category->id }}" onclick="popular_product({{ $category->id }})" aria-selected="false">{{$category->getTranslation('name')}}</button>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <!--End nav-tabs-->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all">
                        <div class="row product-grid-4" id="popular_product">
                          
                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab one-->
                </div>
                <!--End tab-content-->
            </div>
        </section>
        <!--Products Tabs-->
        <!--End Best Sales-->


        @if (json_decode(get_setting('home_ads_banner_heading'), true) != null)
            <div class="marquee">
                <h3>
                    @foreach (json_decode(get_setting('home_ads_banner_heading'), true) as $key => $home_ads_banner)
                    @if ($home_ads_banner != null)
                        <div><span class="hd_cls-2 text-red"> {{$home_ads_banner}} </span><span class="hd_cls-1">{{ json_decode(get_setting('home_ads_banner_text'), true)[$key] ?? "" }}</span></div>
                    @endif
                    @endforeach
                    {{-- <div><span class="hd_cls-2 text-red"> Noalya </span><span class="hd_cls-1">Cultured Chocolate</span></div> --}}
                </h3>
            </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 m-auto">
                    <section class="row align-items-center about-section">
                        <div class="col-lg-6">
                            <img src="{{ uploaded_asset(get_setting('home_about_images')) }}" alt="" class="mb-md-3 mb-lg-0 mb-sm-4" />
                        </div>
                        <div class="col-lg-6">
                            <div class="pl-25">
                                <h2 class="mb-30">{{ get_setting('home_about_heading') ?? "" }}</h2>
                                <p class="mb-25">{!! str_replace(array("\r\n","\n"),'<br>',get_setting('home_about_description')) !!}</p>
                            </div>
                        </div>
                    </section>
                    <section class="row align-items-center mb-50 about-section">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-4 pl-15 pr-0">
                                    <img src="{{ uploaded_asset(get_setting('home_about_second_gif')) }}" style="vertical-align: top;" alt="">
                                </div>
                                <div class="col-8">
                                    <div class="pl-10">
                                        <h2 class="mb-30">{{ get_setting('home_about_second_heading') ?? "" }}</h2>
                                        <p class="mb-25">{!! str_replace(array("\r\n","\n"),'<br>',get_setting('home_about_second_description')) !!}</p>
                                        <!-- <p class="mb-50">With great networking and understanding of the local global health and food industry , trends and benifits is what helps us stand out.</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <img src="{{ uploaded_asset(get_setting('home_about_second_images')) }}" alt="" class="mb-md-3 mb-lg-0 mb-sm-4" />
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <div class="instafeed">
            <div class="container-fluid">
                <div class="row align-items-center instatop">
                    <div class="col-md-4 col-12 ">
                        <h2>{{ get_setting('home_social_heading') ?? "" }} <br /><span>{{ get_setting('home_social_second_heading') ?? "" }}</span></h2>
                    </div>
                    <div class="col-md-4 col-12 my-md-0 my-4">
                        <a href="{{ get_setting('home_social_link') ?? "" }}" class="link">{{ get_setting('home_social_button_title') ?? "" }}</a>
                    </div>
                    <div class="col-md-4 col-12 ">
                        <p><strong>{{ get_setting('home_social_description') }} </strong><br>{{ get_setting('home_social_second_description') }}</p>
                    </div>
                </div>
                <div class="row instabottom">
                    @if(json_decode(get_setting('home_social_images'), true) != null)
                        @foreach (json_decode(get_setting('home_social_images'), true) as $key => $home_social_images)
                            @if ($home_social_images != null)
                                <div class="col-lg-3 col-md-4 col-6 px-1">
                                    <a href="{{ json_decode(get_setting('home_social_images_link'), true)[$key] ?? "" }}">
                                        <img src="{{uploaded_asset($home_social_images)}}" alt="">
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

    </main>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_featured').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_selling').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.auction_products') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#auction_products').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#carausel-10-columns').html(data);
                $('#carausel-10-columns').slick('refresh');
                // AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_sellers').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.popular_product') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $("#popular_product").html(data);
            });
        });
    </script>
@endsection
