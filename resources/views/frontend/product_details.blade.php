@extends('frontend.layouts.app')
@section('meta_title'){{ $detailedProduct->meta_title }}@stop
@section('meta_description'){{ $detailedProduct->meta_description }}@stop
@section('meta_keywords'){{ $detailedProduct->tags }}@stop
@section('meta')
@php $agent = useragent();@endphp
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
<meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
<meta itemprop="image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">

<!-- Twitter Card data -->
<meta name="twitter:card" content="product">
<meta name="twitter:site" content="@publisher_handle">
<meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
<meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
<meta name="twitter:creator" content="@author_handle">
<meta name="twitter:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
<meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
<meta name="twitter:label1" content="Price">

<!-- Open Graph data -->
<meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
<meta property="og:type" content="og:product" />
<meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
<meta property="og:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}" />
<meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
<meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
<meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
<meta property="product:price:currency"
    content="{{ \App\Models\Currency::findOrFail(get_setting('system_default_currency'))->code }}" />
<meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
<script>
    fbq('track', 'ViewContent', {
       content_ids: {{$detailedProduct->id}},
       content_type: 'product_group',
       value: {{$detailedProduct->unit_price}},
       currency: {{check_region()->currency}}
    });
</script>
@endsection
@if ($agent->is('Firefox'))
<style>
    .flickity-prev-next-button::before {
        content: '' !important;
    }

    .flickity-enabled:not(.flickity-rtl) .flickity-prev-next-button.next::before {
        content: '' !important;
    }
</style>
@endif

@section('content')


<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb clr_red">
            <a href="{{route('home')}}" rel="nofollow" class="clr_red"><i class="fi-rs-home mr-5 clr_red"></i>Home</a>
            <span class=" clr_red"></span> <a class=" clr_red"
                href="{{ route('products.category', $detailedProduct->category->slug) }}">{{$detailedProduct->category->getTranslation('name')}}</a>
            <span></span> {{$detailedProduct->getTranslation('name')}}
        </div>
    </div>
</div>

<div class="container mb-30">
    <div class="row">
        <div class="col-xl-11 col-lg-12 m-auto">
            <div class="product-detail accordion-detail">
                <div class="row mb-50 mt-30">
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery dir_ltr gallery-top">
                            <!-- MAIN SLIDES -->
                            <div class="product-image-slider">
                                @php
                                 
                                $photos = explode(',', $detailedProduct->photos);
                                @endphp
                                @foreach ($photos as $key => $photo)
                                
                                @if ($photo != null)
                                
                                <figure class="carouselbox border-radius-10 easyzoom easyzoom--overlay">
                                        <img src="{{uploaded_asset($photo)}}"
                                            alt="product image" />
                                </figure>
                                @endif
                                @endforeach
                                @foreach ($detailedProduct->stocks as $key => $stock)
                                @if ($stock->image != null)
                                <figure class="carouselbox border-radius-10 easyzoom easyzoom--overlay">
                                        <img src="{{uploaded_asset($stock->image)}}"
                                            alt="product image" />
                                </figure>
                                @endif
                                @endforeach
                            </div>
                            <!-- THUMBNAILS -->
                            <div class="slider-nav-thumbnails product-gallery-thumb">
                                
                               @foreach ($photos as $key => $photo)
                                
                                @if ($photo != null)
                                <div class="carouselbox"  >
                                    <img src="{{uploaded_asset($photo)}}" alt="product image" />
                                </div>
                                @endif
                                @endforeach
                                
                                
                                @foreach ($detailedProduct->stocks as $key => $stock)
                                @if ($stock->image != null)
                                <div class="carouselbox" data-variation="{{ $stock->variant }}">
                                    <img src="{{uploaded_asset($stock->image)}}" alt="product image" />
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30">
                            @if(discount_in_percentage($detailedProduct) > 0)
                                <span class="stock-status out-stock">{{ translate('OFF') }}&nbsp;{{discount_in_percentage($detailedProduct)}}%
                                </span>
                            @endif
                            @if (isset($detailedProduct->flash_deal_product->flash_deal->status) == 1 &&
                            flash_deals($detailedProduct->flash_deal_product->flash_deal->id) == 1)
                            <span class="stock-status out-stock"> {{ translate('Flash Deal') }} </span>
                            @endif
                            <h2 class="title-detail">{{$detailedProduct->getTranslation('name')}}</h2>
                            <!--<div class="product-detail-rating">-->
                            <!--    <div class="product-rate-cover text-end">-->


                            <!--    </div>-->
                            <!--</div>-->
                             @php
                                    $total = 0;
                                    $total += $detailedProduct->reviews->count();
                                    @endphp
                            <form id="option-choice-form">
                                @csrf
                                @if(home_price($detailedProduct) != home_discounted_price($detailedProduct))
                                    <div class="clearfix @if(\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1) textright @endif"
                                        id="chosen_price_div">
                                        <div
                                            class="product-price primary-color @if(\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1) float-right @else float-left @endif">
                                            <span class="current-price text-brand" id="chosen_price">

                                            </span>
                                            <span>
                                                <span class="save-price font-md color3 ml-15">{{ translate('OFF') }}&nbsp;{{discount_in_percentage($detailedProduct)}}%</span>
                                                <span class="old-price font-md ml-15">{{ home_price($detailedProduct) }}
                                                    @if($detailedProduct->unit != null)
                                                    /{{ $detailedProduct->getTranslation('unit') }}
                                                    @endif
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <div class="clearfix @if(\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1) textright @endif"
                                        id="chosen_price_div">
                                        <div
                                            class="product-price primary-color @if(\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1) float-right @else float-left @endif">
                                            <span class="current-price text-brand" id="chosen_price">

                                            </span>
                                        </div>
                                    </div>
                                @endif

                                <div class="clearfix product-price-cover hide d-none">
                                    @if(home_price($detailedProduct) != home_discounted_price($detailedProduct))
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">{{
                                            home_discounted_price($detailedProduct) }}</span>
                                        <span>
                                            <span class="save-price font-md color3 ml-15"></span>
                                            <span class="old-price font-md ml-15">{{ home_price($detailedProduct) }}
                                                @if($detailedProduct->unit != null)
                                                /{{ $detailedProduct->getTranslation('unit') }}
                                                @endif
                                            </span>
                                        </span>
                                    </div>
                                    @else
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">{{
                                            home_discounted_price($detailedProduct) }}</span>
                                    </div>
                                    @endif
                                </div>

                                <div class="short-desc mb-30">
                                    {{-- <p class="font-lg">@php echo $detailedProduct->getTranslation('description');
                                        @endphp</p> --}}
                                </div>

                                <input type="hidden" name="id" value="{{ $detailedProduct->id }}">
                                @if ($detailedProduct->choice_options != null)
                                @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)
                                <div class="attr-detail attr-size mb-30 mmb-15">
                                    <strong class="mr-10 mb-10">{{
                                        \App\Models\Attribute::find($choice->attribute_id)->getTranslation('name') }}:</strong>
                                    <div class="aiz-radio-inline">
                                        @foreach ($choice->values as $key => $value)
                                        <label class="aiz-megabox pl-0 mr-2">
                                            <input
                                                type="radio"
                                                name="attribute_id_{{ $choice->attribute_id }}"
                                                value="{{ $value }}"
                                                @if($key==0) checked @endif>
                                            <span
                                                class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center py-0 px-3 mb-2">
                                                @php
                                                $value_tr = \App\Models\AttributeValue::where('value',$value)->first();
                                                try {
                                                echo $value_tr->getTranslation('value');;
                                                } catch (\Throwable $th) {
                                                echo $value;
                                                }
                                                @endphp
                                            </span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                {{-- @dd(count(json_decode($detailedProduct->colors))) --}}
                                @if (count(json_decode($detailedProduct->colors)) > 0)
                                <div class="attr-detail attr-size mb-30 mmb-15">
                                    <strong class="mr-10 mb-10">{{translate('Color')}}:</strong>
                                    <div class="aiz-radio-inline list-filter size-filter font-small">
                                        @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                        <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip"
                                            data-title="{{ \App\Models\Color::where('code', $color)->first()->name }}">
                                            <li>
                                                <input
                                                    type="radio"
                                                    data-title="{{ \App\Models\Color::where('code', $color)->first()->name }}"
                                                    name="color"
                                                    value="{{ \App\Models\Color::where('code', $color)->first()->name }}"
                                                    @if($key==0) checked @endif>
                                                <span
                                                    class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                    <span class="size-30px d-inline-block rounded"
                                                        style="background: {{ $color }};"></span>
                                                </span>

                                            </li>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @php
                                $qty = 0;
                                foreach ($detailedProduct->stocks as $key => $stock) {
                                $qty += $stock->qty;
                                }
                                @endphp
                                <div class="detail-extralink mb-20 mmb-20">
                                    <div class="product-quantity">
                                        <div class="aiz-plus-minus pb-10 pr-10">
                                            <button style="border:none; border-radius: 50%;vertical-align: middle;" type="button"
                                                class="col-auto btn-icon btn-sm btn-circle btn-light btn-number p-10" data-type="minus"
                                                data-field="quantity">
                                                <i class="fi-rs-minus"></i>
                                            </button>
                                            <input type="number" style="text-align: center; width: 60px; height: 50px;"
                                                class="input-number cart-quantity" value="{{ $detailedProduct->min_qty }}"
                                                min="{{ $detailedProduct->min_qty }}"
                                                max="{{ $qty }}" name="quantity" id="quantity" />
                                            <button style="border:none; border-radius: 50%;vertical-align: middle;"
                                                class="col-auto btn-icon btn-sm btn-circle btn-light btn-number p-10" data-type="plus"
                                                data-field="quantity" type="button">
                                                <i class="fi-rs-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="product-extra-link2">
                                        <button type="button" onclick="addToCart()"
                                            class="button button-add-to-cart add-to-cart d-none"><i
                                                class="fi-rs-shopping-cart"></i>{{translate('Add to cart')}}</button>
                                        <button type="button" class="btn btn-secondary out-of-stock fw-600 d-none"
                                            disabled>
                                            <i class="fi-rs-shopping-cart"></i> {{ translate('Out of Stock')}}
                                        </button>
                                        <a aria-label="Add To Wishlist"
                                            onclick="addToWishList({{ $detailedProduct->id }})"
                                            class="action-btn hover-up" href="javascript:void(0)"><i
                                                class="fi-rs-heart"></i></a>
                                        <!-- <a aria-label="Compare" class="action-btn hover-up" href="#"><i class="fi-rs-shuffle"></i></a> -->
                                    </div>
                                    <br>
                                </div>
                            </form>
                            <div class="font-xs">
                                <ul class="float-start">
                                    @if ($detailedProduct->sku != null)
                                    <li class="mb-5">{{translate('SKU')}}: <a href="#">{{$detailedProduct->sku}}</a></li>
                                    @endif
                                    @if ($detailedProduct->tags != null)
                                    <li class="mb-5">{{translate('Tags')}}: <a href="#" rel="tag">{{$detailedProduct->tags}}</a>,</li>
                                    @endif
                                    @if($detailedProduct->stock_visibility_state == 'quantity')
                                    <li>{{translate('Stock')}}:<span class="in-stock text-brand ml-5"
                                    id="available-quantity">{{$qty}}</span><span class="in-stock text-brand" style="text-transform: capitalize;">
                                    {{$qty > 0 ? translate('Available') : translate('Not Available')}}
                                    </span></li>
                                    @elseif($detailedProduct->stock_visibility_state == 'text' && $qty >= 1)
                                    <li>{{translate('Stock')}}:<span class="in-stock text-brand ml-5"
                                    id="available-quantity">{{$qty}} </span> <span class="in-stock text-brand ml-5" style="text-transform: capitalize;">
                                    {{$qty > 0 ? translate('Items In Stock') : translate('Items Out Of Stock')}}
                                    </span></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>
                <div class="product-info">
                    <div class="tab-style3">
                        <ul class="nav nav-tabs text-uppercase">
                            <li class="nav-item">
                                <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                    href="#Description">{{translate('Description')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab"
                                    href="#Additional-info">{{translate('Additional info')}}</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab"
                                    href="#Vendor-info">{{translate('Vendor')}}</a>
                            </li> --}}
                            <!--<li class="nav-item">
                                <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">{{translate('Reviews')}} ({{$total}})</a>
                            </li>-->
                        </ul>
                        <div class="tab-content shop_info_tab entry-main-content">
                            <div class="tab-pane fade show active" id="Description">
                                <div class="">
                                    <p>
                                        <?php echo $detailedProduct->getTranslation('description'); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Additional-info">
                                <table class="font-md">
                                    <tbody>
                                        <tr class="stand-up">
                                            <th>{{translate('Weight')}}:</th>
                                            <td>
                                                <p>{{$detailedProduct->weight}} KG</p>
                                            </td>
                                        </tr>
                                        @if ($detailedProduct->length != null)
                                        <tr class="stand-up">
                                            <th>{{translate('Length')}}:</th>
                                            <td>
                                                <p>{{$detailedProduct->length}}</p>
                                            </td>
                                        </tr>
                                        @endif
                                        @if ($detailedProduct->width != null)
                                        <tr class="stand-up">
                                            <th>{{translate('Width')}}:</th>
                                            <td>
                                                <p>{{$detailedProduct->width}}</p>
                                            </td>
                                        </tr>
                                        @endif
                                        @if ($detailedProduct->height != null)
                                        <tr class="stand-up">
                                            <th>{{translate('Height')}}:</th>
                                            <td>
                                                <p>{{$detailedProduct->height}}</p>
                                            </td>
                                        </tr>
                                        @endif
                                        @if ($detailedProduct->choice_options != null)
                                        <tr class="stand-up">
                                            @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)
                                            <th>{{ \App\Models\Attribute::find($choice->attribute_id)->getTranslation('name')
                                                }}:</th>
                                            @foreach ($choice->values as $key => $value)
                                            <td>
                                                <p>{{$value}}</p>
                                            </td>
                                            @endforeach
                                            @endforeach
                                        </tr>
                                        @endif
                                        @if (count(json_decode($detailedProduct->colors)) > 0)
                                        <tr class="stand-up">
                                            @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                            <th>{{ translate('Color') }}:</th>
                                            <td style="background-color: {{$color}};padding:10px">
                                            </td>
                                            @endforeach
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="Reviews">
                                <!--Comments-->
                                <div class="comments-area">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4 class="mb-30">Customer questions & answers</h4>
                                            <div class="comment-list">
                                                <div class="single-comment justify-content-between d-flex mb-30">
                                                    <div class="user justify-content-between d-flex">
                                                        <div class="thumb text-center">
                                                            <img src="assets/imgs/blog/author-2.png" alt="" />
                                                            <a href="#" class="font-heading text-brand">Sienna</a>
                                                        </div>
                                                        <div class="desc">
                                                            <div class="d-flex justify-content-between mb-10">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="font-xs text-muted">December 4, 2021 at
                                                                        3:12 pm </span>
                                                                </div>
                                                                <div class="product-rate d-inline-block">
                                                                    <div class="product-rating" style="width: 100%">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p class="mb-10">Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit. Delectus, suscipit exercitationem
                                                                accusantium obcaecati quos voluptate nesciunt facilis
                                                                itaque modi commodi dignissimos sequi repudiandae minus
                                                                ab deleniti totam officia id incidunt? <a href="#"
                                                                    class="reply">Reply</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="single-comment justify-content-between d-flex mb-30 ml-30">
                                                    <div class="user justify-content-between d-flex">
                                                        <div class="thumb text-center">
                                                            <img src="assets/imgs/blog/author-3.png" alt="" />
                                                            <a href="#" class="font-heading text-brand">Brenna</a>
                                                        </div>
                                                        <div class="desc">
                                                            <div class="d-flex justify-content-between mb-10">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="font-xs text-muted">December 4, 2021 at
                                                                        3:12 pm </span>
                                                                </div>
                                                                <div class="product-rate d-inline-block">
                                                                    <div class="product-rating" style="width: 80%">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p class="mb-10">Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit. Delectus, suscipit exercitationem
                                                                accusantium obcaecati quos voluptate nesciunt facilis
                                                                itaque modi commodi dignissimos sequi repudiandae minus
                                                                ab deleniti totam officia id incidunt? <a href="#"
                                                                    class="reply">Reply</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="single-comment justify-content-between d-flex">
                                                    <div class="user justify-content-between d-flex">
                                                        <div class="thumb text-center">
                                                            <img src="assets/imgs/blog/author-4.png" alt="" />
                                                            <a href="#" class="font-heading text-brand">Gemma</a>
                                                        </div>
                                                        <div class="desc">
                                                            <div class="d-flex justify-content-between mb-10">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="font-xs text-muted">December 4, 2021 at
                                                                        3:12 pm </span>
                                                                </div>
                                                                <div class="product-rate d-inline-block">
                                                                    <div class="product-rating" style="width: 80%">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p class="mb-10">Lorem ipsum dolor sit amet, consectetur
                                                                adipisicing elit. Delectus, suscipit exercitationem
                                                                accusantium obcaecati quos voluptate nesciunt facilis
                                                                itaque modi commodi dignissimos sequi repudiandae minus
                                                                ab deleniti totam officia id incidunt? <a href="#"
                                                                    class="reply">Reply</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <h4 class="mb-30">Customer reviews</h4>
                                            <div class="d-flex mb-30">
                                                <div class="product-rate d-inline-block mr-15">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <h6>4.8 out of 5</h6>
                                            </div>
                                            <div class="progress">
                                                <span>5 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 50%"
                                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                            </div>
                                            <div class="progress">
                                                <span>4 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 25%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                            </div>
                                            <div class="progress">
                                                <span>3 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 45%"
                                                    aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                            </div>
                                            <div class="progress">
                                                <span>2 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 65%"
                                                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                            </div>
                                            <div class="progress mb-30">
                                                <span>1 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 85%"
                                                    aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                            </div>
                                            <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                                        </div>
                                    </div>
                                </div>
                                <!--comment form-->
                                <div class="comment-form">
                                    <h4 class="mb-15">Add a review</h4>
                                    <div class="product-rate d-inline-block mb-30"></div>
                                    <div class="row">
                                        <div class="col-lg-8 col-md-12">
                                            <form class="form-contact comment_form" action="#" id="commentForm">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <textarea class="form-control w-100" name="comment"
                                                                id="comment" cols="30" rows="9"
                                                                placeholder="Write Comment"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="name" id="name"
                                                                type="text" placeholder="Name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input class="form-control" name="email" id="email"
                                                                type="email" placeholder="Email" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <input class="form-control" name="website" id="website"
                                                                type="text" placeholder="Website" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="button button-contactForm">Submit
                                                        Review</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-60">
                    <div class="col-12">
                        <h2 class="section-title style-1 mb-30">{{ translate('Related products')}}</h2>
                    </div>
                    <div class="col-12" id="section_related_products">
                        <div class="row related-products">
                            @foreach (filter_products(\App\Models\Product::where('category_id', $detailedProduct->category_id)->where('id', '!=', $detailedProduct->id))->limit(5)->get() as $key => $related_product)
                                 <div class="col-lg-1-5 col-md-4 col-6 col-sm-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{route('product',$related_product->slug)}}">
                                                    <img class="default-img" src="{{uploaded_asset($related_product->thumbnail_img)}}" alt="" />
                                                </a>
                                            </div>
                                            @if(discount_in_percentage($related_product) > 0)
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">{{ translate('OFF') }}&nbsp;{{discount_in_percentage($related_product)}}%</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="{{ route('product', $related_product->category->slug) }}">{{$related_product->category->getTranslation('name')}}</a>
                                            </div>
                                            <h2><a href="{{ route('product', $related_product->slug) }}">{{  $related_product->getTranslation('name')  }}</a></h2>
                                            <div class="product-card-bottom">
                                                @if(home_base_price($related_product) != home_discounted_base_price($related_product))
                                                    <div class="product-price">
                                                        <span>{{home_discounted_base_price($related_product)}}</span>
                                                        <span class="old-price">{{home_base_price($related_product)}}</span>
                                                    </div>
                                                    @else
                                                    <div class="product-price">
                                                        <span>{{home_base_price($related_product)}}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        getVariantPrice();

    });
    if ($("#lang-change .dropdown-menu").length > 0) {
        $("#lang-change .dropdown-menu").each(function() {
            $(this).on('change', function(e){
                e.preventDefault();
                console.log(e.target);
                var locale = $(this).find(":selected").data('flag');
                $.post('{{ route('language.change') }}',{_token: AIZ.data.csrf, locale:locale}, function(data){
                    location.reload();
                });
            });
        });
    }
</script>

@endsection
