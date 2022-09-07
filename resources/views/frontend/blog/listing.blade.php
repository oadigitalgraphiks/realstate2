@extends('frontend.layouts.app')

@section('content')
<main class="main">
    <div class="page-header mt-30 mb-75">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">{{ translate('Blog') }}</h1>
                        <div class="breadcrumb">
                            <a href="{{ route('home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span> {{ translate('Blog') }}
                        </div>
                    </div>
                    {{-- <div class="col-xl-9 text-end d-none d-xl-block">
                        <ul class="tags-list">
                            <li class="hover-up">
                                <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Shopping</a>
                            </li>
                            <li class="hover-up active">
                                <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Recips</a>
                            </li>
                            <li class="hover-up">
                                <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Kitchen</a>
                            </li>
                            <li class="hover-up">
                                <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>News</a>
                            </li>
                            <li class="hover-up mr-0">
                                <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Food</a>
                            </li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="page-content mb-50">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-product-fillter mb-50">
                        <div class="totall-product">
                            <h2>
                                {{-- <img class="w-36px mr-10" src="assets/imgs/theme/icons/category-1.svg" alt="" /> --}}
                                Latest Blogs
                            </h2>
                        </div>
                        <form class="" id="search-form" action="" method="GET">
                            <div class="sort-by-product-area">
                                <div class="sort-by-cover">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps-sort"></i>Per Page:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <select class="sort_by" name="show_count" onchange="filter()">
                                                <option value="10" @isset($show_count) @if ($show_count == '10') selected @endif @endisset>10</option>
                                                <option value="50" @isset($show_count) @if ($show_count == '50') selected @endif @endisset>50</option>
                                                <option value="100" @isset($show_count) @if ($show_count == '100') selected @endif @endisset>100</option>
                                                <option value="200" @isset($show_count) @if ($show_count == '200') selected @endif @endisset>200</option>
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
                                                <option value="newest" @isset($sort_by) @if ($sort_by == 'newest') selected @endif @endisset>{{ translate('Newest')}}</option>
                                                <option value="oldest" @isset($sort_by) @if ($sort_by == 'oldest') selected @endif @endisset>{{ translate('Oldest')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="loop-grid">
                        <div class="row">
                            @forelse ($blogs as $blog)
                                <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
                                    <div class="post-thumb">
                                        <a href="{{ url("blog").'/'. $blog->slug }}">
                                            <img class="border-radius-15" src="{{uploaded_asset($blog->thumbnail_img)}}" alt="" />
                                        </a>
                                    </div>
                                    <div class="entry-content-2">
                                        <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="{{ url("blog").'/'. $blog->slug }}">{{ $blog->category_id != 0 ? $blog->category->category_name : "" }}</a></h6>
                                        <h4 class="post-title mb-15">
                                            <a href="{{ url("blog").'/'. $blog->slug }}">{{Str::limit($blog->title, 30, $end='.......')}}</a>
                                        </h4>
                                        <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                            <div>
                                                <span class="post-on mr-10">{{date_format($blog->created_at,'d M Y')}}</span>
                                                {{-- <span class="hit-count has-dot mr-10">126k Views</span> --}}
                                                {{-- <span class="hit-count has-dot">4 mins read</span> --}}
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @empty
                                <article class="col-xl-12 col-lg-12 col-md-12 text-center hover-up mb-30 animated">
                                    <div class="entry-content-2">
                                        <div class="totall-product">
                                            <h2>
                                                Not Found
                                            </h2>
                                        </div>
                                    </div>
                                </article>
                            @endforelse
                            {{-- <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
                                <div class="post-thumb">
                                    <a href="blog-post-right.html">
                                        <img class="border-radius-15" src="assets/imgs/blog/blog-2.png" alt="" />
                                    </a>
                                </div>
                                <div class="entry-content-2">
                                    <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="blog-category-grid.html">Soups and Stews</a></h6>
                                    <h4 class="post-title mb-15">
                                        <a href="blog-post-right.html">Summer Quinoa Salad Jars with Lemon Dill</a>
                                    </h4>
                                    <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on mr-10">25 April 2022</span>
                                            <span class="hit-count has-dot mr-10">126k Views</span>
                                            <span class="hit-count has-dot">4 mins read</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
                                <div class="post-thumb">
                                    <a href="blog-post-right.html">
                                        <img class="border-radius-15" src="assets/imgs/blog/blog-3.png" alt="" />
                                    </a>
                                    <div class="entry-meta">
                                        <a class="entry-meta meta-2" href="blog-category-grid.html"><i class="fi-rs-link"></i></a>
                                    </div>
                                </div>
                                <div class="entry-content-2">
                                    <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="blog-category-grid.html">Salad</a></h6>
                                    <h4 class="post-title mb-15">
                                        <a href="blog-post-right.html">Caprese Chicken with Smashed Potatoes</a>
                                    </h4>
                                    <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on mr-10">25 April 2022</span>
                                            <span class="hit-count has-dot mr-10">126k Views</span>
                                            <span class="hit-count has-dot">4 mins read</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
                                <div class="post-thumb">
                                    <a href="blog-post-right.html">
                                        <img class="border-radius-15" src="assets/imgs/blog/blog-4.png" alt="" />
                                    </a>
                                </div>
                                <div class="entry-content-2">
                                    <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="blog-category-grid.html">Dessert</a></h6>
                                    <h4 class="post-title mb-15">
                                        <a href="blog-post-right.html">Harissa Chickpeas with Whipped Feta</a>
                                    </h4>
                                    <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on mr-10">25 April 2022</span>
                                            <span class="hit-count has-dot mr-10">126k Views</span>
                                            <span class="hit-count has-dot">4 mins read</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
                                <div class="post-thumb">
                                    <a href="blog-post-right.html">
                                        <img class="border-radius-15" src="assets/imgs/blog/blog-5.png" alt="" />
                                    </a>
                                </div>
                                <div class="entry-content-2">
                                    <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="blog-category-grid.html">Breakfast</a></h6>
                                    <h4 class="post-title mb-15">
                                        <a href="blog-post-right.html">Almond Butter Chocolate Chip Zucchini Bars</a>
                                    </h4>
                                    <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on mr-10">25 April 2022</span>
                                            <span class="hit-count has-dot mr-10">126k Views</span>
                                            <span class="hit-count has-dot">4 mins read</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
                                <div class="post-thumb">
                                    <a href="blog-post-right.html">
                                        <img class="border-radius-15" src="assets/imgs/blog/blog-6.png" alt="" />
                                    </a>
                                    <div class="entry-meta">
                                        <a class="entry-meta meta-2" href="blog-category-grid.html"><i class="fi-rs-picture"></i></a>
                                    </div>
                                </div>
                                <div class="entry-content-2">
                                    <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="blog-category-grid.html">Vegan</a></h6>
                                    <h4 class="post-title mb-15">
                                        <a href="blog-post-right.html">Smoky Beans & Greens Tacos with Aji Verde</a>
                                    </h4>
                                    <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on mr-10">25 April 2022</span>
                                            <span class="hit-count has-dot mr-10">126k Views</span>
                                            <span class="hit-count has-dot">4 mins read</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
                                <div class="post-thumb">
                                    <a href="blog-post-right.html">
                                        <img class="border-radius-15" src="assets/imgs/blog/blog-1.png" alt="" />
                                    </a>
                                    <div class="entry-meta">
                                        <a class="entry-meta meta-2" href="blog-category-grid.html"><i class="fi-rs-heart"></i></a>
                                    </div>
                                </div>
                                <div class="entry-content-2">
                                    <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="blog-category-grid.html">Side Dish</a></h6>
                                    <h4 class="post-title mb-15">
                                        <a href="blog-post-right.html">The Intermediate Guide to Healthy Food</a>
                                    </h4>
                                    <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on mr-10">25 April 2022</span>
                                            <span class="hit-count has-dot mr-10">126k Views</span>
                                            <span class="hit-count has-dot">4 mins read</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
                                <div class="post-thumb">
                                    <a href="blog-post-right.html">
                                        <img class="border-radius-15" src="assets/imgs/blog/blog-7.png" alt="" />
                                    </a>
                                    <div class="entry-meta">
                                        <a class="entry-meta meta-2" href="blog-category-grid.html"><i class="fi-rs-play-alt"></i></a>
                                    </div>
                                </div>
                                <div class="entry-content-2">
                                    <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="blog-category-grid.html">Gluten Free</a></h6>
                                    <h4 class="post-title mb-15">
                                        <a href="blog-post-right.html">Sticky Ginger Rice Bowls with Pickled Veg</a>
                                    </h4>
                                    <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on mr-10">25 April 2022</span>
                                            <span class="hit-count has-dot mr-10">126k Views</span>
                                            <span class="hit-count has-dot">4 mins read</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
                                <div class="post-thumb">
                                    <a href="blog-post-right.html">
                                        <img class="border-radius-15" src="assets/imgs/blog/blog-8.png" alt="" />
                                    </a>
                                </div>
                                <div class="entry-content-2">
                                    <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="blog-category-grid.html">Side Dish</a></h6>
                                    <h4 class="post-title mb-15">
                                        <a href="blog-post-right.html">Creamy Garlic Sun-Dried Tomato Pasta</a>
                                    </h4>
                                    <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on mr-10">25 April 2022</span>
                                            <span class="hit-count has-dot mr-10">126k Views</span>
                                            <span class="hit-count has-dot">4 mins read</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
                                <div class="post-thumb">
                                    <a href="blog-post-right.html">
                                        <img class="border-radius-15" src="assets/imgs/blog/blog-9.png" alt="" />
                                    </a>
                                </div>
                                <div class="entry-content-2">
                                    <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="blog-category-grid.html">Dairy Free</a></h6>
                                    <h4 class="post-title mb-15">
                                        <a href="blog-post-right.html">The Absolute Easiest Spinach and Pizza</a>
                                    </h4>
                                    <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on mr-10">25 April 2022</span>
                                            <span class="hit-count has-dot mr-10">126k Views</span>
                                            <span class="hit-count has-dot">4 mins read</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
                                <div class="post-thumb">
                                    <a href="blog-post-right.html">
                                        <img class="border-radius-15" src="assets/imgs/blog/blog-10.png" alt="" />
                                    </a>
                                </div>
                                <div class="entry-content-2">
                                    <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="blog-category-grid.html">Salad</a></h6>
                                    <h4 class="post-title mb-15">
                                        <a href="blog-post-right.html">Sticky Ginger Rice Bowls with Pickled</a>
                                    </h4>
                                    <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on mr-10">25 April 2022</span>
                                            <span class="hit-count has-dot mr-10">126k Views</span>
                                            <span class="hit-count has-dot">4 mins read</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
                                <div class="post-thumb">
                                    <a href="blog-post-right.html">
                                        <img class="border-radius-15" src="assets/imgs/blog/blog-1.png" alt="" />
                                    </a>
                                </div>
                                <div class="entry-content-2">
                                    <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="blog-category-grid.html">Soups</a></h6>
                                    <h4 class="post-title mb-15">
                                        <a href="blog-post-right.html">The Best Soft Chocolate Chip Cookies</a>
                                    </h4>
                                    <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on mr-10">25 April 2022</span>
                                            <span class="hit-count has-dot mr-10">126k Views</span>
                                            <span class="hit-count has-dot">4 mins read</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
                                <div class="post-thumb">
                                    <a href="blog-post-right.html">
                                        <img class="border-radius-15" src="assets/imgs/blog/blog-12.png" alt="" />
                                    </a>
                                </div>
                                <div class="entry-content-2">
                                    <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="blog-category-grid.html">Vegetarian</a></h6>
                                    <h4 class="post-title mb-15">
                                        <a href="blog-post-right.html">Baked Mozzarella Chicken Rolls</a>
                                    </h4>
                                    <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on mr-10">25 April 2022</span>
                                            <span class="hit-count has-dot mr-10">126k Views</span>
                                            <span class="hit-count has-dot">4 mins read</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
                                <div class="post-thumb">
                                    <a href="blog-post-right.html">
                                        <img class="border-radius-15" src="assets/imgs/blog/blog-13.png" alt="" />
                                    </a>
                                </div>
                                <div class="entry-content-2">
                                    <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="blog-category-grid.html"> Dessert </a></h6>
                                    <h4 class="post-title mb-15">
                                        <a href="blog-post-right.html">The Best Avocado Egg Salad</a>
                                    </h4>
                                    <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on mr-10">25 April 2022</span>
                                            <span class="hit-count has-dot mr-10">126k Views</span>
                                            <span class="hit-count has-dot">4 mins read</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
                                <div class="post-thumb">
                                    <a href="blog-post-right.html">
                                        <img class="border-radius-15" src="assets/imgs/blog/blog-14.png" alt="" />
                                    </a>
                                </div>
                                <div class="entry-content-2">
                                    <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="blog-category-grid.html">Vegetarian</a></h6>
                                    <h4 class="post-title mb-15">
                                        <a href="blog-post-right.html">The litigants on the screen are not actors</a>
                                    </h4>
                                    <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on mr-10">25 April 2022</span>
                                            <span class="hit-count has-dot mr-10">126k Views</span>
                                            <span class="hit-count has-dot">4 mins read</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
                                <div class="post-thumb">
                                    <a href="blog-post-right.html">
                                        <img class="border-radius-15" src="assets/imgs/blog/blog-15.png" alt="" />
                                    </a>
                                </div>
                                <div class="entry-content-2">
                                    <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="blog-category-grid.html">Vegetarian</a></h6>
                                    <h4 class="post-title mb-15">
                                        <a href="blog-post-right.html">The litigants on the screen are not actors</a>
                                    </h4>
                                    <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on mr-10">25 April 2022</span>
                                            <span class="hit-count has-dot mr-10">126k Views</span>
                                            <span class="hit-count has-dot">4 mins read</span>
                                        </div>
                                    </div>
                                </div>
                            </article> --}}
                        </div>
                    </div>
                    <div class="aiz-pagination aiz-pagination-center pagination-area mt-20 mb-20">
                        {{ $blogs->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('script')
    <script>
        function filter(){
            $('#search-form').submit();
        }
    </script>
@endsection
