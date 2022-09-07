@php
$photos = explode(',', $product->photos);
$my_count = count($photos);
@endphp
<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
        <div class="detail-gallery">
            <!--<span class="zoom-icon"><i class="fi-rs-search"></i></span>-->
            <!-- MAIN SLIDES -->
            <div class="product-image-slider product-gallery-thumb">
                @if ($product->thumbnail_img != null)
                    <figure class="border-radius-10">
                        <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="product image" />
                    </figure>
                @endif
                @foreach ($photos as $key => $photo)
                @if ($photo != null)
                    <figure class="border-radius-10">
                        <img src="{{ uploaded_asset($photo) }}" alt="product image" />
                    </figure>
                @endif
                @endforeach
                @foreach ($product->stocks as $key => $stock)
                @if ($stock->image != null)
                    <figure class="border-radius-10 product-gallery-thumb">
                        <img src="{{ uploaded_asset($stock->image) }}" alt="product image" />
                    </figure>
                @endif
                @endforeach
            </div>
            <!-- THUMBNAILS -->
            <div class="slider-nav-thumbnails product-gallery-thumb">
                @if ($product->thumbnail_img != null)
                <div>
                    <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="product image" />
                </div>
                @endif
                @foreach ($photos as $key => $photo)
                @if ($photo != null)
                <div class="carouselbox">
                    <img src="{{ uploaded_asset($photo) }}" alt="product image" />
                </div>
                @endif
                @endforeach
                @foreach ($product->stocks as $key => $stock)
                    @if ($stock->image != null)
                        <div class="carouselbox" data-variation="{{ $stock->variant }}">
                            <img src="{{ uploaded_asset($stock->image) }}" alt="product image" />
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <!-- End Gallery -->
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="detail-info pr-30 pl-30">
            @if(discount_in_percentage($product) > 0)
                <span class="stock-status out-stock">{{ translate('OFF') }} {{discount_in_percentage($product)}}% </span>
            @endif
            @if (isset($product->flash_deal_product->flash_deal->status) == 1 &&
            flash_deals($product->flash_deal_product->flash_deal->id) == 1)
            <span class="stock-status out-stock"> {{ translate('Flash Deal') }} </span>
            @endif
            <h3 class="title-detail">
                <a href="{{ route('product', $product->slug) }}" class="text-heading">
                    {{ $product->getTranslation('name') }}</a>
            </h3>

            <div class="product-detail-rating">
                <div class="product-rate-cover text-end">
                    @php
                    $total = 0;
                    $total += $product->reviews->count();
                    @endphp
                </div>
            </div>
            <form id="option-choice-form">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                @if($product->digital !=1)
                    @if ($product->choice_options != null)
                        @foreach (json_decode($product->choice_options) as $key => $choice)
                            <div class="row no-gutters">
                                <div class="col-3">
                                    <div class="opacity-50 mt-2 ">
                                        {{ \App\Models\Attribute::find($choice->attribute_id)->getTranslation('name') }}:</div>
                                </div>
                                <div class="col-9">
                                    <div class="aiz-radio-inline">
                                        @foreach ($choice->values as $key => $value)
                                            <label class="aiz-megabox pl-0 mr-2">
                                                <input type="radio" name="attribute_id_{{ $choice->attribute_id }}"
                                                    value="{{ $value }}" @if ($key==0) checked @endif>
                                                <span
                                                    class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center py-1 px-3 mb-2">
                                                    {{ $value }}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endif
                @if (count(json_decode($product->colors)) > 0)
                <div class="row no-gutters">
                    <div class="col-3">
                        <div class="opacity-50 mt-2 ">{{ translate('Colors') }}:</div>
                    </div>
                    <div class="col-9">
                        <div class="aiz-radio-inline">
                            @foreach (json_decode($product->colors) as $key => $color)
                            <label class="aiz-megabox pl-0 mr-2">
                                <input type="radio" name="color"
                                    value="{{ \App\Models\Color::where('code', $color)->first()->name }}"
                                    @if ($key==0) checked @endif>
                                <span
                                    class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                    <span class="size-30px d-inline-block rounded"
                                        style="background: {{ $color }};"></span>
                                </span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                @php
                $qty = 0;
                foreach ($product->stocks as $key => $stock) {
                $qty += $stock->qty;
                }
                @endphp
                <ul>
                    @if (home_price($product) != home_discounted_price($product))
                    <div class="clearfix product-price-cover">
                        <div class="product-price primary-color float-left">
                            <span class="current-pric text-brand" style="margin-top: 18px;font-size: 22px;">{{ home_discounted_price($product) }}</span>
                            <span>
                                @if(discount_in_percentage($product) > 0)
                                    <span class="save-price font-md color3 ml-15">{{discount_in_percentage($product)}}% Off</span>
                                @endif
                                <span class="old-pric font-md ml-15">{{home_price($product)}}</span>
                            </span>
                        </div>
                    </div>
                    @else
                    <div class="clearfix product-price-cover">
                        <div class="product-price primary-color float-left d-unset">
                            <li class="mb-5">{{ translate('Unit Price') }}:
                                <strong class="in-stock text-dark ml-5">
                                    {{ home_discounted_price($product) }}</strong>
                            </li>
                        </div>
                    </div>
                    @endif
                </ul>
                <div class="detail-extralink mb-30 product-quantity">
                    <div class="aiz-plus-minus pb-10 pr-10">
                        <button style="border:none; border-radius: 50%;vertical-align: middle;" type="button"
                            class="col-auto btn-icon btn-sm btn-circle btn-light btn-number p-10" data-type="minus"
                            data-field="quantity">
                            <i class="fi-rs-minus"></i>
                        </button>
                        <input type="number" style="text-align: center; width: 60px; height: 50px;"
                            class="input-number cart-quantity" value="{{ $product->min_qty }}"
                            min="{{ $product->min_qty }}"
                            max="{{ $qty }}" name="quantity" id="quantity" />
                        <button style="border:none; border-radius: 50%;vertical-align: middle;"
                            class="col-auto btn-icon btn-sm btn-circle btn-light btn-number p-10" data-type="plus"
                            data-field="quantity" type="button">
                            <i class="fi-rs-plus"></i>
                        </button>
                    </div>
                    @if ($qty > 0 && ($product->unit_price > 0))
                    <div class="product-extra-link2">
                        <button type="button" class="button button-add-to-cart" onclick="addToCart()"><i
                                class="fi-rs-shopping-cart"></i>{{ translate('Add to cart') }}</button>
                    </div>
                    @elseif($qty == 0)
                    <div class="product-extra-link2">
                        <button type="button" class="button button-add-to-cart btn-secondary"><i
                                class="fi-rs-shopping-cart"></i>{{ translate('Out of stock') }}</button>
                    </div>
                    @endif
                </div>
                <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
                    {{-- <div class="col-3">
                    </div> --}}
                    <div class="col-8">
                        <div class="opacity-50">{{ translate('Total Price') }}:</div>
                        <div class="product-price">
                            <strong id="chosen_price" class="h4 fw-600 current-price text-brand">

                            </strong>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Detail Info -->
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        AIZ.extra.plusMinus();
    });
    $('#option-choice-form input').on('change', function () {
        getVariantPrice();
    });
</script>
