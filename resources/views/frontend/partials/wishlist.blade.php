<div class="header-action-icon-2">
    <a href="{{ route('wishlists.index') }}">
        <img class="svgInject" alt="Nest" src="{{ static_asset('assets/imgs/theme/icons/icon-heart.svg') }}" />
        <span class="pro-count blue">
            @if(Auth::check())
                {{count(Auth::user()->wishlists)}}</span>
            @else
                0
            @endif
        </span>
    </a>
    <a href="{{ route('wishlists.index') }}">
        <span class="lable">{{ translate('Wishlist') }}</span>
    </a>
</div>
{{-- <div class="header-action-icon-2">
 <a href="{{ route('wishlists.index') }}" class="d-flex align-items-center text-reset">
	 <img class="svgInject" alt="Biizel" src="{{ static_asset('assets/imgs/theme/icons/icon-heart.svg')}}" />
        @if(Auth::check())
		<span class="pro-count blue badge badge-primary badge-inline badge-pill">{{ count(Auth::user()->wishlists)}}</span>
        @else
			<span class="pro-count blue">0</span>
        @endif
        <span class="nav-box-text d-none d-xl-block opacity-70">{{translate('Wishlist')}}</span>
</a>
</div> --}}
