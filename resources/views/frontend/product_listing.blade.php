@extends('frontend.layouts.app')

@if (isset($category_id))
@php
$meta_title = \App\Models\Category::find($category_id)->meta_title;
$meta_description = \App\Models\Category::find($category_id)->meta_description;
@endphp
@elseif (isset($brand_id))
@php
$meta_title = \App\Models\Brand::find($brand_id)->meta_title;
$meta_description = \App\Models\Brand::find($brand_id)->meta_description;
@endphp
@else
@php
$meta_title = get_setting('meta_title');
$meta_description = get_setting('meta_description');
@endphp
@endif

@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('meta')
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ $meta_title }}">
<meta itemprop="description" content="{{ $meta_description }}">

<!-- Twitter Card data -->
<meta name="twitter:title" content="{{ $meta_title }}">
<meta name="twitter:description" content="{{ $meta_description }}">

<!-- Open Graph data -->
<meta property="og:title" content="{{ $meta_title }}" />
<meta property="og:description" content="{{ $meta_description }}" />
@endsection

@section('content')
@php
if(isset($category_id)){
$category = \App\Models\Category::find($category_id);
}
if(isset($brand_id)){
$brand = \App\Models\Brand::find($brand_id);
}
@endphp
<main class="main">
    <form class="" id="search-form" action="" method="GET">
        <div class="page-header mt-30 mb-50">
            <div class="container">
                <div class="archive-header"
                    style="background-image: url( @if(isset($category)) {{uploaded_asset($category->banner) ?? static_asset('asset/images/header-bg.png')}} @else {{static_asset('asset/images/header-bg.png')}} @endif)">
                    <div class="row align-items-center">
                        <div class="col-xl-4">
                            @if(isset($category_id))
                            <h1 class="mb-15"> {{ $category->getTranslation('name') }}</h1>
                            <div class="breadcrumb">
                                <a href="{{route("home")}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                                <span></span> {{ $category->getTranslation('name') }}
                            </div>
                            @elseif (isset($brand_id))
                            <h1 class="mb-15"> {{ $brand->getTranslation('name') }}</h1>
                            <div class="breadcrumb">
                                <a href="{{route("home")}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                                <span></span> {{ $brand->getTranslation('name') }}
                            </div>
                            @else
                            <h1 class="mb-15">All Products</h1>
                            <div class="breadcrumb">
                                <a href="{{route("home")}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="row">
                <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                    <div class="sidebar-widget price_range range mb-30">


                        <style>
                            .aiz-square-check {
                                border-radius: 10px !important;
                            }

                            .checkbox-custom {
                                border-radius: 0px !important;
                            }
                        </style>

                        @if (count($categories) > 0)
                        <div class="">
                            <div class="">
                                <div class="mb-3">
                                    <h5
                                        class="section-title style-1 mb-30">
                                        Shop By Categories
                                    </h5>
                                    <div class="cat_fixcl-scroll-content css_ntbar">
                                        <div class="custome-checkbox fixed-scroll-ul">
                                            @foreach ($categories as $category)
                                            <div>
                                                <label class="aiz-checkbox">
                                                    <input type="checkbox" name="selected_category_ids[]" value="{{ $category->id }}"
                                                        onchange="filter()"
                                                    @isset($selected_category_ids)
                                                        @if (in_array($category->id,$selected_category_ids))
                                                            checked
                                                        @endif
                                                    @endisset
                                                    @isset($category_id)
                                                        @if (in_array($category->id,array($category_id)))
                                                            checked
                                                        @endif
                                                    @endisset
                                                    >
                                                    <span class="aiz-square-check"></span>
                                                    <span>
                                                        {{ $category->name }}
                                                    </span>
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if (count($brands) > 0)
                        <div class="">
                            <div class="">
                                <div class="mb-3">
                                    <h5
                                        class="section-title style-1 mb-30">
                                        Shop By Brands
                                    </h5>
                                    <div class="cat_fixcl-scroll-content css_ntbar">
                                        <div class="custome-checkbox fixed-scroll-ul">
                                            @foreach ($brands as $brand)
                                            <div>
                                                <label class="aiz-checkbox">
                                                    <input type="checkbox" name="brand_ids[]" value="{{ $brand->id }}"
                                                        onchange="filter()"
                                                        @isset($brand_ids)
                                                        @if (in_array($brand->id,$brand_ids))
                                                    checked
                                                    @endif
                                                    @endisset >
                                                    <span class="aiz-square-check checkbox-custom"></span>
                                                    <span>
                                                        {{ $brand->name }}
                                                    </span>
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if (count($attributes) > 0)
                        @foreach ($attributes as $attribute)
                        <div class="">
                            <div class="">
                                <div class="mb-3">
                                    <h5
                                        class="section-title style-1 mb-30">
                                       Shop By {{ $attribute->getTranslation('name') }}
                                    </h5>
                                    <div class="cat_fixcl-scroll-content css_ntbar">
                                        <div class="custome-checkbox fixed-scroll-ul">
                                            @foreach ($attribute->attribute_values as $attribute_value)
                                            <div>
                                                <label class="aiz-checkbox">
                                                    <input type="radio"
                                                        name="selected_attribute_values[]"
                                                        value="{{ $attribute_value->value }}"
                                                        @if (in_array($attribute_value->value,
                                                    $selected_attribute_values)) checked @endif
                                                    onchange="filter()">
                                                    <span class="aiz-square-check"></span>
                                                    <span>
                                                        {{ $attribute_value->value }}
                                                    </span>
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <h5 class="section-title style-1 mb-30">{{translate("Shop by price")}}</h5>
                        <div class="row mt-2">
                            <div class="bg-white shadow-sm rounded mb-3">
                                <div class="p-3">
                                    <div class="aiz-range-slider">
                                        <div
                                            id="input-slider-range"
                                            data-range-value-min="@if(\App\Models\Product::count() < 1) 0 @else {{ \App\Models\Product::min('unit_price') }} @endif"
                                            data-range-value-max="@if(\App\Models\Product::count() < 1) 0 @else {{ \App\Models\Product::max('unit_price') }} @endif">
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <span class="range-slider-value value-low fs-14 fw-600 opacity-70"
                                                    @if (isset($min_price))
                                                    data-range-value-low="{{ $min_price }}"
                                                    @elseif($products->min('unit_price') > 0)
                                                    data-range-value-low="{{ $products->min('unit_price') }}"
                                                    @else
                                                    data-range-value-low="0"
                                                    @endif
                                                    id="input-slider-range-value-low"
                                                    ></span>
                                            </div>
                                            <div class="col-6 text-right">
                                                <span class="range-slider-value value-high fs-14 fw-600 opacity-70"
                                                    @if (isset($max_price))
                                                    data-range-value-high="{{ $max_price }}"
                                                    @elseif($products->max('unit_price') > 0)
                                                    data-range-value-high="{{ $products->max('unit_price') }}"
                                                    @else
                                                    data-range-value-high="0"
                                                    @endif
                                                    id="input-slider-range-value-high"
                                                    ></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4-5">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p class="text-center">{{translate('We found')}} <strong class="text-brand">{{
                                    count($products) }}</strong> {{translate('items for you')}}!</p>
                        </div>
                        <div class="sort-by-product-area">

                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Per Page:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <select class="sort_by" name="show_count" onchange="filter()">
                                            <option value="10" @isset($show_count) @if ($show_count=='10' ) selected
                                                @endif @endisset>10</option>
                                            <option value="50" @isset($show_count) @if ($show_count=='50' ) selected
                                                @endif @endisset>50</option>
                                            <option value="100" @isset($show_count) @if ($show_count=='100' ) selected
                                                @endif @endisset>100</option>
                                            <option value="200" @isset($show_count) @if ($show_count=='200' ) selected
                                                @endif @endisset>200</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <select class="sort_by" name="sort_by" onchange="filter()">
                                            <option value="newest" @isset($sort_by) @if ($sort_by=='newest' ) selected
                                                @endif @endisset>{{ translate('Newest')}}</option>
                                            <option value="oldest" @isset($sort_by) @if ($sort_by=='oldest' ) selected
                                                @endif @endisset>{{ translate('Oldest')}}</option>
                                            <option value="price-asc" @isset($sort_by) @if ($sort_by=='price-asc' )
                                                selected @endif @endisset>{{ translate('Price low to high')}}</option>
                                            <option value="price-desc" @isset($sort_by) @if ($sort_by=='price-desc' )
                                                selected @endif @endisset>{{ translate('Price high to low')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-grid">
                        @foreach ($products as $key => $product)
                        @include('frontend.partials.product_box_1',['product' => $product])
                        @endforeach
                    </div>
                    <div class="aiz-pagination aiz-pagination-center pagination-area mt-20 mb-20">
                        {{ $products->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="min_price" value="">
        <input type="hidden" name="max_price" value="">
    </form>
</main>
@endsection

@section('script')
<script type="text/javascript">
    function filter(){
            $('#search-form').submit();
        }
        function rangefilter(arg){
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }
</script>
@endsection
