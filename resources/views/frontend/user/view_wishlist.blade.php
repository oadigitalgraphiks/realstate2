@extends('frontend.layouts.app')
@section('content')
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>{{translate('Home')}}</a>
            <span></span> {{translate('Wishlist')}}
        </div>
    </div>
</div>

<div class="container mb-30 mt-50">
    <div class="row">
        <div class="col-xl-10 col-lg-12 m-auto">
            <div class="mb-50">
                <h1 class="heading-2 mb-10">{{translate('Your Wishlist')}}</h1>
                <h6 class="text-body">{{translate('There are')}}
                    <span class="text-brand">
                        @if(session()->get('temp_user_id') != null)
                            {{  \App\Models\Wishlist::where('temp_user_id', session()->get('temp_user_id'))->count() }}
                        @elseif(Auth::check())
                            {{ \App\Models\Wishlist::where('user_id', Auth::user()->id)->count()  }}
                        @else
                            0
                        @endif
                    </span>
                    {{translate('products in this list')}}
                </h6>
            </div>
            <div class="table-responsive shopping-summery">
                <table class="table table-wishlist">
                    <thead>
                        <tr class="main-heading">
                            <th class="custome-checkbox start pl-30">
                                <input class="form-check-input" type="checkbox" name="checkbox"
                                    id="exampleCheckbox11" value="" />
                                <label class="form-check-label" for="exampleCheckbox11"></label>
                            </th>
                            <th scope="col" colspan="2">{{translate('Product')}}</th>
                            <th scope="col">{{translate('Price')}}</th>
                            <th scope="col">{{translate('Stock Status')}}</th>
                            <th scope="col">{{translate('Action')}}</th>
                            <th scope="col" class="end">{{translate('Remove')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if ($wishlists && count($wishlists) > 0)
                        @forelse ($wishlists as $key => $wishlist)
                            @if ($wishlist->product != null)
                                <tr class="pt-30" id="wishlist_{{ $wishlist->id }}">
                                    <td class="custome-checkbox pl-30">
                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                            id="exampleCheckbox1" value="" />
                                        <label class="form-check-label" for="exampleCheckbox1"></label>
                                    </td>
                                    <td class="image product-thumbnail pt-40">
                                        <img src="{{uploaded_asset( $wishlist->product->thumbnail_img)}}" alt="#" />
                                        </td>
                                    <td class="product-des product-name">
                                        <h6>
                                            <a class="product-name mb-10" href="{{route('product',$wishlist->product->slug)}}">
                                                {{ $wishlist->product->getTranslation('name') }}
                                            </a>
                                        </h6>
                                        {{-- @php $total = 0; $total += $wishlist->product->reviews->count(); @endphp
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:  {{ $total > 0 ? $total * 2 : ''}}0%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted">  {{ renderStarRating($wishlist->product->rating) }}</span>
                                        </div> --}}
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h3 class="text-brand">{{ home_discounted_base_price($wishlist->product) }}</h3>
                                    </td>
                                    @php
                                        $qty = 0;
                                        foreach ($wishlist->product->stocks as $key => $stock) {
                                            $qty += $stock->qty;
                                        }
                                    @endphp
                                    <td class="text-center detail-info" data-title="Stock">
                                        <span class="stock-status in-stock mb-0">
                                            {{$qty > 0 ? translate('In Stock') : translate('Out of Stock')}}
                                        </span>
                                    </td>
                                    @if($qty > 0)
                                        <td class="text-right" data-title="Cart">
                                            <button class="btn btn-sm" onclick="showAddToCartModal({{$wishlist->product->id}})">
                                                {{translate('Add to cart')}}
                                            </button>
                                        </td>
                                    @else
                                        <td class="text-right" data-title="Cart">
                                            <button type="button" class="btn btn-sm btn-secondary out-of-stock fw-600" disabled>
                                                <i class="fi-rs-shopping-cart"></i> {{ translate('Out of Stock')}}
                                            </button>
                                        </td>
                                    @endif
                                    <td class="action text-center" data-title="Remove">
                                        <a href="javascript:void(0)" onclick="removeFromWishlist({{ $wishlist->id }})" class="text-body">
                                            <i class="fi-rs-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="12" class="text-center">
                                <h4>{{translate('Your Wishlist is empty')}}!</h4>
                                <a href="{{route('home')}}" class="btn mt-10 btn-sm">{{translate('Return to shop')}}</a>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
    <script type="text/javascript">
        function removeFromWishlist(id){
            $.post('{{ route('wishlists.remove') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
                $('.wishlist-count').html(data);
                $('#wishlist_'+id).hide();
                console.log(data);
                AIZ.plugins.notify('success', '{{ translate('Item has been renoved from wishlist') }}');
            })
        }
    </script>
@endsection
