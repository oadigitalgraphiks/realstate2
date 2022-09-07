<div class="col-lg-1-5 col-md-4 col-6 col-sm-6">
    <div class="product-cart-wrap mb-30">
        <div class="product-img-action-wrap">
            <div class="product-img product-img-zoom">
                <a href="{{route('product',$product->slug)}}">
                    <img class="default-img" src="{{uploaded_asset($product->thumbnail_img)}}" alt="" />
                </a>
            </div>
            <div class="product-action-1">
                <a aria-label="Add To Wishlist" class="action-btn" href="javascript:void(0)" onclick="addToWishList({{ $product->id }})"><i class="fi-rs-heart"></i></a>
                <!-- <a aria-label="Compare" class="action-btn" href="#"><i class="fi-rs-shuffle"></i></a> -->
                <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                            onclick="showAddToCartModal({{ $product->id }})"><i class="fi-rs-eye"></i></a>
            </div>
            @if(discount_in_percentage($product) > 0)
                <div class="product-badges product-badges-position product-badges-mrg">
                    <span class="hot">{{ translate('OFF') }}&nbsp;{{discount_in_percentage($product)}}%</span>
                </div>
            @endif
        </div>
        <div class="product-content-wrap">
            <div class="product-category">
                <a href="{{ route('product', $product->category->slug) }}">{{$product->category->getTranslation('name')}}</a>
            </div>
            <h2><a href="{{ route('product', $product->slug) }}">{{ Str::limit($product->getTranslation('name'), 20) }}</a></h2>
            <div class="product-card-bottom">
                @if(home_base_price($product) != home_discounted_base_price($product))
                    <div class="product-price">
                        <span>{{home_discounted_base_price($product)}}</span>
                        <span class="old-price">{{home_base_price($product)}}</span>
                    </div>
                    @else
                    <div class="product-price">
                        <span>{{home_base_price($product)}}</span>
                    </div>
                @endif
                <div class="add-cart">
                    <a class="add" href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                </div>
            </div>
        </div>
    </div>
</div>
