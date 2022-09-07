@foreach (\App\Models\Category::where('featured', '1')->orderBy('order_level','asc')->take(6)->get() as $key => $category)
        @if ($category != null)
            <div class="card-2 bg-9 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                <figure class="img-hover-scale overflow-hidden">
                    <a href="{{ route('products.category', $category->slug) }}"><img src="{{ uploaded_asset($category->icon) }}" height="80px" alt="" /></a>
                </figure>
                <h6><a href="{{ route('products.category', $category->slug) }}">{{ $category->getTranslation('name') }}</a></h6>
                <span>{{count($category->products->where('published',1))}} items</span>
            </div>
        @endif
    @endforeach