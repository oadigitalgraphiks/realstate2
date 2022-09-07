@if (count($popular_products) > 0)
    @foreach ($popular_products as $key => $product)
        <div class="col-lg-1-5 col-md-4 col-6 col-sm-6">
            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                <div class="product-img-action-wrap">
                    <div class="product-img product-img-zoom">
                        <a href="{{ route('product', $product->slug) }}">
                            <img class="default-img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="" />
                            <img class="hover-img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="" />
                        </a>
                    </div>
                    <div class="product-action-1">
                        <a aria-label="Add To Wishlist" href="javascript:void();" onclick="addToWishList({{ $product->id }})" data-data="{{ $product->id }}"
                            class="action-btn">
                                <i class="fi-rs-heart wishlist_icon"></i>
                        </a>
                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                            onclick="showAddToCartModal({{ $product->id }})"><i class="fi-rs-eye"></i></a>
                    </div>
                    @if ($product->getTranslation('badge') != null)
                        <div class="product-badges product-badges-position product-badges-mrg">
                            <span class="hot">{{ $product->getTranslation('badge') }}</span>
                        </div>
                    @endif
                    @if (isset($product->flash_deal_product->flash_deal->status) == 1 && flash_deals($product->flash_deal_product->flash_deal->id) == 1)
                        <div class="product-badges product-badges-position product-badges-mrg">
                            <span class="hot">{{ translate('Flash Deal') }}</span>
                        </div>
                    @endif
                </div>
                <div class="product-content-wrap">
                    <div class="product-category">
                        <a href="{{ route('products.category', $product->category->slug) }}">
                            {{ $product->category->getTranslation('name') }}
                        </a>
                    </div>
                    <h2><a
                            href="{{ route('product', $product->slug) }}">{{ Str::limit($product->getTranslation('name'), 25) }}</a>
                    </h2>
                     
                    <div class="product-card-bottom">
                        <div class="product-price">
                                <span>{{ home_discounted_base_price($product) }}</span>
                            @if (home_base_price($product) != home_discounted_base_price($product))
                                <span class="old-price">{{ home_base_price($product) }}</span>
                            @endif
                        </div>
                        @php
                            $qty = 0;
                            foreach ($product->stocks as $key => $stock) {
                                $qty += $stock->qty;
                            }
                        @endphp
                        @if ($qty > 0 && ($product->unit_price > 0))
                            <div class="add-cart">
                                <a class="add" href="javascript:void(0)"
                                    onclick="showAddToCartModal({{ $product->id }})"><i
                                        class="fi-rs-shopping-cart mr-5"></i>{{ translate('Add') }} </a>
                            </div>
                        @elseif($qty == 0)
                            <div class="add-cart">
                                <i class="fi-rs-shopping-cart mr-5"></i>{{ translate('Out of Stock') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-lg-12 col-md-3 col-12 col-sm-6 text-center">
        <h5>{{ translate('Products Not Found!') }}</h5>
    </div>
@endif
