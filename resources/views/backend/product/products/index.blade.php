@extends('backend.layouts.app')

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Products</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">eCommerce</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Catalog</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        @if ($type == 'Seller')
                            <li class="breadcrumb-item text-dark">Seller Products</li>
                            @else
                            <li class="breadcrumb-item text-dark">In House Products</li>
                        @endif
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Products-->
                <form class="" id="sort_products" action="" method="GET">
                    <div class="card card-flush">
                        <!--begin::Card header-->
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                                transform="rotate(45 17.0365 15.1223)" fill="black" />
                                            <path
                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <input type="text" class="form-control form-control-solid w-250px ps-14" id="search"
                                        name="search" @isset($sort_search) value="{{ $sort_search }}"
                                        @endisset placeholder="{{ translate('Type & Enter') }}" />
                                </div>
                                <!--end::Search-->
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                @if($type == 'Seller')
                                    <div class="w-100 mw-150px">
                                        <!--begin::Select2-->
                                        <select class="form-select form-select-solid" id="user_id" name="user_id"
                                            onchange="sort_products()">
                                            <option value="">{{ translate('All Sellers') }}</option>
                                            @foreach (App\Models\Seller::all() as $key => $seller)
                                                @if ($seller->user != null && $seller->user->shop != null)
                                                    <option value="{{ $seller->user->id }}" @if ($seller->user->id == $seller_id) selected @endif>
                                                        {{ $seller->user->shop->name }} ({{ $seller->user->name }})</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <!--end::Select2-->
                                    </div>
                                @endif
                                <div class="w-100 mw-150px">
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="type" id="type"
                                        onchange="sort_products()">
                                        <option value="">{{ translate('Sort By') }}</option>
                                        <option value="rating,desc" @isset($col_name, $query)
                                            @if ($col_name == 'rating' && $query == 'desc') selected @endif @endisset>{{ translate('Rating (High > Low)') }}
                                        </option>
                                        <option value="rating,asc" @isset($col_name, $query)
                                            @if ($col_name == 'rating' && $query == 'asc') selected @endif @endisset>{{ translate('Rating (Low > High)') }}
                                        </option>
                                        <option value="num_of_sale,desc" @isset($col_name, $query)
                                            @if ($col_name == 'num_of_sale' && $query == 'desc') selected @endif @endisset>{{ translate('Num of Sale (High > Low)') }}
                                        </option>
                                        <option value="num_of_sale,asc" @isset($col_name, $query)
                                            @if ($col_name == 'num_of_sale' && $query == 'asc') selected @endif @endisset>{{ translate('Num of Sale (Low > High)') }}
                                        </option>
                                        <option value="unit_price,desc" @isset($col_name, $query)
                                            @if ($col_name == 'unit_price' && $query == 'desc') selected @endif @endisset>{{ translate('Base Price (High > Low)') }}
                                        </option>
                                        <option value="unit_price,asc" @isset($col_name, $query)
                                            @if ($col_name == 'unit_price' && $query == 'asc') selected @endif @endisset>{{ translate('Base Price (Low > High)') }}
                                        </option>
                                    </select>
                                    <!--end::Select2-->
                                </div>
                                <!--begin::Add product-->
                                @if ($type != 'Seller')
                                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                                        {{ translate('Add New Product') }}
                                    </a>
                                @endif
                                <!--end::Add product-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->

                        <div class="card-body pt-0">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                    <!--begin::Table head-->
                                    <thead>
                                        <!--begin::Table row-->
                                        <tr class="text-center text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2">
                                                <div
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                        data-kt-check-target="#kt_ecommerce_products_table .form-check-input"
                                                        value="1" />
                                                </div>
                                            </th>
                                            <th class="min-w-200px">{{ translate('Product Name') }}</th>
                                            @if ($type == 'Seller' || $type == 'All')
                                                <th class="text-center min-w-75px">{{ translate('Added By') }}</th>
                                            @endif
                                            <th class="text-center min-w-175px">{{ translate('Info') }}</th>
                                            <th class="text-center min-w-175px">{{ translate('Purpose') }}</th>
                                            <th class="text-center min-w-175px">{{ translate('Type') }}</th>
                                            <th class="text-center min-w-100px">{{ translate('Published') }}</th>
                                            @if (get_setting('product_approve_by_admin') == 1 && $type == 'Seller')<th class="text-center min-w-100px">{{ translate('Approved') }}</th>@endif
                                            <th class="text-center min-w-70px">{{ translate('Featured') }}</th>
                                            <th class="text-center min-w-150px">{{ translate('Actions') }}</th>
                                        </tr>
                                        <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                        <!--begin::Table row-->
                                        @foreach ($products as $key => $product)
                                            <tr>
                                                <!--begin::Checkbox-->
                                                <td>
                                                    <div
                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" name="id[]"
                                                            value="{{ $product->id }}" />
                                                    </div>
                                                </td>
                                                <!--end::Checkbox-->
                                                <!--begin::Category=-->
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Thumbnail-->
                                                        <a href="{{ route('product', $product->slug) }}"
                                                            class="symbol symbol-50px">
                                                            <span class="symbol-label"
                                                                style="background-image:url({{ uploaded_asset($product->thumbnail_img) }});"></span>
                                                        </a>
                                                        <!--end::Thumbnail-->
                                                        <div class="ms-5">
                                                            <!--begin::Title-->
                                                            <a href="{{ route('product', $product->slug) }}"
                                                                class="text-gray-800 text-hover-primary fs-5 fw-bolder"
                                                                data-kt-ecommerce-product-filter="product_name">{{ $product->getTranslation('name') }}</a>
                                                            <!--end::Title-->
                                                        </div>
                                                    </div>
                                                </td>
                                                <!--end::Category=-->
                                                <!--begin::SKU=-->
                                                @if ($type == 'Seller' || $type == 'All')
                                                    <td class="text-center pe-0">
                                                        <span class="fw-bolder">{{ $product->user->name }}</span>
                                                    </td>
                                                @endif
                                                <!--end::SKU=-->
                                                <!--begin::Qty=-->
                                                <td class="text-center pe-0" data-order="32">
                                                    <span class="fw-bolder ms-3">
                                                        <strong>{{ translate('Num of Sale') }}:</strong>
                                                        {{ $product->num_of_sale }} {{ translate('times') }} </br>
                                                        <strong>{{ translate('Base Price') }}:</strong>
                                                        {{ single_price($product->unit_price) }} </br>
                                                        <strong>{{ translate('Rating') }}:</strong>
                                                        {{ $product->rating }} </br>
                                                    </span>
                                                </td>
                                                <!--end::Qty=-->
                                                <td class="text-center pe-0" data-order="rating-3">
                                                    <span class="fw-bolder ms-3">
                                                    {{$product->purpose->name}}, {{$product->purpose_child->name}}
                                    
                                                </span>
                                                </td>
                                                <td class="text-center pe-0" data-order="rating-3">
                                                    <span class="fw-bolder ms-3">
                                                    {{$product->type->name}}
                                    
                                                </span>
                                                </td>
                                                <!--begin::Status=-->
                                                <td class="text-center pe-0" data-order="Scheduled">
                                                    <label
                                                        class="form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" onchange="update_published(this)"
                                                            value="{{ $product->id }}" type="checkbox"
                                                            <?php if ($product->published == 1) {
                                                                echo 'checked';
                                                            } ?>>
                                                    </label>
                                                </td>
                                                @if (get_setting('product_approve_by_admin') == 1 && $type == 'Seller')
                                                    <td class="text-center pe-0" data-order="">
                                                        <label
                                                            class="form-check form-switch form-check-custom form-check-solid">
                                                            <input class="form-check-input"
                                                                onchange="update_approved(this)"
                                                                value="{{ $product->id }}" type="checkbox"
                                                                <?php if ($product->approved == 1) {
                                                                    echo 'checked';
                                                                } ?>>
                                                        </label>
                                                    </td>
                                                @endif
                                                <td class="text-center pe-0" data-order="">
                                                    <label
                                                        class="form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" onchange="update_featured(this)"
                                                            value="{{ $product->id }}" type="checkbox"
                                                            <?php if ($product->featured == 1) {
                                                                echo 'checked';
                                                            } ?>>
                                                    </label>
                                                </td>
                                                <!--end::Status=-->
                                                <!--begin::Action=-->
                                                <td class="text-center">
                                                    <a href="{{ route('product', $product->slug) }}"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <path
                                                                        d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z"
                                                                        fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                    <path
                                                                        d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
                                                                        fill="#000000" opacity="0.3" />
                                                                </g>
                                                            </svg></span>
                                                    </a>
                                                    <a href="{{ route('products.duplicate', ['id' => $product->id, 'type' => $type]) }}"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                        <span class="svg-icon svg-icon-3">
                                                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Duplicate.svg--><svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <path
                                                                        d="M15.9956071,6 L9,6 C7.34314575,6 6,7.34314575 6,9 L6,15.9956071 C4.70185442,15.9316381 4,15.1706419 4,13.8181818 L4,6.18181818 C4,4.76751186 4.76751186,4 6.18181818,4 L13.8181818,4 C15.1706419,4 15.9316381,4.70185442 15.9956071,6 Z"
                                                                        fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                    <path
                                                                        d="M10.1818182,8 L17.8181818,8 C19.2324881,8 20,8.76751186 20,10.1818182 L20,17.8181818 C20,19.2324881 19.2324881,20 17.8181818,20 L10.1818182,20 C8.76751186,20 8,19.2324881 8,17.8181818 L8,10.1818182 C8,8.76751186 8.76751186,8 10.1818182,8 Z"
                                                                        fill="#000000" />
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </a>
                                                    @if ($type == 'Seller')
                                                        <a href="{{ route('products.seller.edit', ['id' => $product->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                        @else
                                                            <a href="{{ route('products.admin.edit', ['id' => $product->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    @endif
                                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3"
                                                                d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                                fill="black"></path>
                                                            <path
                                                                d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                                fill="black"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                    </a>
                                                    <a href="#"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm confirm-delete"
                                                        data-href="{{ route('products.destroy', $product->id) }}">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none">
                                                                <path
                                                                    d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                                    fill="black"></path>
                                                                <path opacity="0.5"
                                                                    d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                                    fill="black"></path>
                                                                <path opacity="0.5"
                                                                    d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                                    fill="black"></path>
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </a>

                                                </td>

                                                <!--end::Action=-->
                                            </tr>
                                        @endforeach
                                        <!--end::Table row-->
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <div class="aiz-pagination">
                                {{ $products->appends(request()->input())->links() }}
                            </div>
                            <!--end::Card body-->
                        </div>
                    </div>
                </form>
                <!--end::Products-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
    {{-- <div class="aiz-titlebar text-left mt-2 mb-3"> --}}
    {{-- <div class="row align-items-center"> --}}
    {{-- <div class="col-auto"> --}}
    {{-- <h1 class="h3">{{translate('All products')}}</h1> --}}
    {{-- </div> --}}
    {{-- @if ($type != 'Seller') --}}
    {{-- <div class="col text-right"> --}}
    {{-- <a href="{{ route('products.create') }}" class="btn btn-circle btn-info"> --}}
    {{-- <span>{{translate('Add New Product')}}</span> --}}
    {{-- </a> --}}
    {{-- </div> --}}
    {{-- @endif --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- <br> --}}

    {{-- <div class="card"> --}}
    {{-- <form class="" id="sort_products" action="" method="GET"> --}}
    {{-- <div class="card-header row gutters-5"> --}}
    {{-- <div class="col"> --}}
    {{-- <h5 class="mb-md-0 h6">{{ translate('All Product') }}</h5> --}}
    {{-- </div> --}}

    {{-- <div class="dropdown mb-2 mb-md-0"> --}}
    {{-- <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown"> --}}
    {{-- {{translate('Bulk Action')}} --}}
    {{-- </button> --}}
    {{-- <div class="dropdown-menu dropdown-menu-right"> --}}
    {{-- <a class="dropdown-item" href="#" onclick="bulk_delete()"> {{translate('Delete selection')}}</a> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- @if ($type == 'Seller') --}}
    {{-- <div class="col-md-2 ml-auto"> --}}
    {{-- <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" id="user_id" name="user_id" onchange="sort_products()"> --}}
    {{-- <option value="">{{ translate('All Sellers') }}</option> --}}
    {{-- @foreach (App\Models\Seller::all() as $key => $seller) --}}
    {{-- @if ($seller->user != null && $seller->user->shop != null) --}}
    {{-- <option value="{{ $seller->user->id }}" @if ($seller->user->id == $seller_id) selected @endif>{{ $seller->user->shop->name }} ({{ $seller->user->name }})</option> --}}
    {{-- @endif --}}
    {{-- @endforeach --}}
    {{-- </select> --}}
    {{-- </div> --}}
    {{-- @endif --}}
    {{-- @if ($type == 'All') --}}
    {{-- <div class="col-md-2 ml-auto"> --}}
    {{-- <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" id="user_id" name="user_id" onchange="sort_products()"> --}}
    {{-- <option value="">{{ translate('All Sellers') }}</option> --}}
    {{-- @foreach (App\Models\User::where('user_type', '=', 'admin')->orWhere('user_type', '=', 'seller')->get()
    as $key => $seller) --}}
    {{-- <option value="{{ $seller->id }}" @if ($seller->id == $seller_id) selected @endif>{{ $seller->name }}</option> --}}
    {{-- @endforeach --}}
    {{-- </select> --}}
    {{-- </div> --}}
    {{-- @endif --}}
    {{-- <div class="col-md-2 ml-auto"> --}}
    {{-- <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" name="type" id="type" onchange="sort_products()"> --}}
    {{-- <option value="">{{ translate('Sort By') }}</option> --}}
    {{-- <option value="rating,desc" @isset($col_name, $query) @if ($col_name == 'rating' && $query == 'desc') selected @endif @endisset>{{translate('Rating (High > Low)')}}</option> --}}
    {{-- <option value="rating,asc" @isset($col_name, $query) @if ($col_name == 'rating' && $query == 'asc') selected @endif @endisset>{{translate('Rating (Low > High)')}}</option> --}}
    {{-- <option value="num_of_sale,desc"@isset($col_name, $query) @if ($col_name == 'num_of_sale' && $query == 'desc') selected @endif @endisset>{{translate('Num of Sale (High > Low)')}}</option> --}}
    {{-- <option value="num_of_sale,asc"@isset($col_name, $query) @if ($col_name == 'num_of_sale' && $query == 'asc') selected @endif @endisset>{{translate('Num of Sale (Low > High)')}}</option> --}}
    {{-- <option value="unit_price,desc"@isset($col_name, $query) @if ($col_name == 'unit_price' && $query == 'desc') selected @endif @endisset>{{translate('Base Price (High > Low)')}}</option> --}}
    {{-- <option value="unit_price,asc"@isset($col_name, $query) @if ($col_name == 'unit_price' && $query == 'asc') selected @endif @endisset>{{translate('Base Price (Low > High)')}}</option> --}}
    {{-- </select> --}}
    {{-- </div> --}}
    {{-- <div class="col-md-2"> --}}
    {{-- <div class="form-group mb-0"> --}}
    {{-- <input type="text" class="form-control form-control-sm" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type & Enter') }}"> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <div class="card-body"> --}}
    {{-- <table class="table aiz-table mb-0"> --}}
    {{-- <thead> --}}
    {{-- <tr> --}}
    {{-- <th> --}}
    {{-- <div class="form-group"> --}}
    {{-- <div class="aiz-checkbox-inline"> --}}
    {{-- <label class="aiz-checkbox"> --}}
    {{-- <input type="checkbox" class="check-all"> --}}
    {{-- <span class="aiz-square-check"></span> --}}
    {{-- </label> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </th> --}}
    {{-- <!--<th data-breakpoints="lg">#</th>--> --}}
    {{-- <th>{{translate('Name')}}</th> --}}
    {{-- @if ($type == 'Seller' || $type == 'All') --}}
    {{-- <th data-breakpoints="lg">{{translate('Added By')}}</th> --}}
    {{-- @endif --}}
    {{-- <th data-breakpoints="sm">{{translate('Info')}}</th> --}}
    {{-- <th data-breakpoints="md">{{translate('Total Stock')}}</th> --}}
    {{-- <th data-breakpoints="lg">{{translate('Todays Deal')}}</th> --}}
    {{-- <th data-breakpoints="lg">{{translate('Published')}}</th> --}}
    {{-- @if (get_setting('product_approve_by_admin') == 1 && $type == 'Seller') --}}
    {{-- <th data-breakpoints="lg">{{translate('Approved')}}</th> --}}
    {{-- @endif --}}
    {{-- <th data-breakpoints="lg">{{translate('Featured')}}</th> --}}
    {{-- <th data-breakpoints="sm" class="text-right">{{translate('Options')}}</th> --}}
    {{-- </tr> --}}
    {{-- </thead> --}}
    {{-- <tbody> --}}
    {{-- @foreach ($products as $key => $product) --}}
    {{-- <tr> --}}
    {{-- <!--<td>{{ ($key+1) + ($products->currentPage() - 1)*$products->perPage() }}</td>--> --}}
    {{-- <td> --}}
    {{-- <div class="form-group d-inline-block"> --}}
    {{-- <label class="aiz-checkbox"> --}}
    {{-- <input type="checkbox" class="check-one" name="id[]" value="{{$product->id}}"> --}}
    {{-- <span class="aiz-square-check"></span> --}}
    {{-- </label> --}}
    {{-- </div> --}}
    {{-- </td> --}}
    {{-- <td> --}}
    {{-- <div class="row gutters-5 w-200px w-md-300px mw-100"> --}}
    {{-- <div class="col-auto"> --}}
    {{-- <img src="{{ uploaded_asset($product->thumbnail_img)}}" alt="Image" class="size-50px img-fit"> --}}
    {{-- </div> --}}
    {{-- <div class="col"> --}}
    {{-- <span class="text-muted text-truncate-2">{{ $product->getTranslation('name') }}</span> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </td> --}}
    {{-- @if ($type == 'Seller' || $type == 'All') --}}
    {{-- <td>{{ $product->user->name }}</td> --}}
    {{-- @endif --}}
    {{-- <td> --}}
    {{-- <strong>{{translate('Num of Sale')}}:</strong> {{ $product->num_of_sale }} {{translate('times')}} </br> --}}
    {{-- <strong>{{translate('Base Price')}}:</strong> {{ single_price($product->unit_price) }} </br> --}}
    {{-- <strong>{{translate('Rating')}}:</strong> {{ $product->rating }} </br> --}}
    {{-- </td> --}}
    {{-- <td> --}}
    {{-- @php --}}
    {{-- $qty = 0; --}}
    {{-- if($product->variant_product) { --}}
    {{-- foreach ($product->stocks as $key => $stock) { --}}
    {{-- $qty += $stock->qty; --}}
    {{-- echo $stock->variant.' - '.$stock->qty.'<br>'; --}}
    {{-- } --}}
    {{-- } --}}
    {{-- else { --}}
    {{-- //$qty = $product->current_stock; --}}
    {{-- $qty = optional($product->stocks->first())->qty; --}}
    {{-- echo $qty; --}}
    {{-- } --}}
    {{-- @endphp --}}
    {{-- @if ($qty <= $product->low_stock_quantity) --}}
    {{-- <span class="badge badge-inline badge-danger">Low</span> --}}
    {{-- @endif --}}
    {{-- </td> --}}
    {{-- <td> --}}
    {{-- <label class="aiz-switch aiz-switch-success mb-0"> --}}
    {{-- <input onchange="update_todays_deal(this)" value="{{ $product->id }}" type="checkbox" <?php if ($product->todays_deal == 1) {
    echo 'checked';
} ?> > --}}
    {{-- <span class="slider round"></span> --}}
    {{-- </label> --}}
    {{-- </td> --}}
    {{-- <td> --}}
    {{-- <label class="aiz-switch aiz-switch-success mb-0"> --}}
    {{-- <input onchange="update_published(this)" value="{{ $product->id }}" type="checkbox" <?php if ($product->published == 1) {
    echo 'checked';
} ?> > --}}
    {{-- <span class="slider round"></span> --}}
    {{-- </label> --}}
    {{-- </td> --}}
    {{-- @if (get_setting('product_approve_by_admin') == 1 && $type == 'Seller') --}}
    {{-- <td> --}}
    {{-- <label class="aiz-switch aiz-switch-success mb-0"> --}}
    {{-- <input onchange="update_approved(this)" value="{{ $product->id }}" type="checkbox" <?php if ($product->approved == 1) {
    echo 'checked';
} ?> > --}}
    {{-- <span class="slider round"></span> --}}
    {{-- </label> --}}
    {{-- </td> --}}
    {{-- @endif --}}
    {{-- <td> --}}
    {{-- <label class="aiz-switch aiz-switch-success mb-0"> --}}
    {{-- <input onchange="update_featured(this)" value="{{ $product->id }}" type="checkbox" <?php if ($product->featured == 1) {
    echo 'checked';
} ?> > --}}
    {{-- <span class="slider round"></span> --}}
    {{-- </label> --}}
    {{-- </td> --}}
    {{-- <td class="text-right"> --}}
    {{-- <a class="btn btn-soft-success btn-icon btn-circle btn-sm"  href="{{ route('product', $product->slug) }}" target="_blank" title="{{ translate('View') }}"> --}}
    {{-- <i class="las la-eye"></i> --}}
    {{-- </a> --}}
    {{-- @if ($type == 'Seller') --}}
    {{-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('products.seller.edit', ['id'=>$product->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" title="{{ translate('Edit') }}"> --}}
    {{-- <i class="las la-edit"></i> --}}
    {{-- </a> --}}
    {{-- @else --}}
    {{-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('products.admin.edit', ['id'=>$product->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" title="{{ translate('Edit') }}"> --}}
    {{-- <i class="las la-edit"></i> --}}
    {{-- </a> --}}
    {{-- @endif --}}
    {{-- <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="{{route('products.duplicate', ['id'=>$product->id, 'type'=>$type]  )}}" title="{{ translate('Duplicate') }}"> --}}
    {{-- <i class="las la-copy"></i> --}}
    {{-- </a> --}}
    {{-- <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('products.destroy', $product->id)}}" title="{{ translate('Delete') }}"> --}}
    {{-- <i class="las la-trash"></i> --}}
    {{-- </a> --}}
    {{-- </td> --}}
    {{-- </tr> --}}
    {{-- @endforeach --}}
    {{-- </tbody> --}}
    {{-- </table> --}}
    {{-- <div class="aiz-pagination"> --}}
    {{-- {{ $products->appends(request()->input())->links() }} --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </form> --}}
    {{-- </div> --}}

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')
    <script type="text/javascript">
        $(document).on("change", ".check-all", function() {
            if (this.checked) {
                // Iterate each checkbox
                $('.check-one:checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check-one:checkbox').each(function() {
                    this.checked = false;
                });
            }

        });

        $(document).ready(function() {
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });

        function update_todays_deal(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.todays_deal') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Todays Deal updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function update_published(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.published') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Published products updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function update_approved(el) {
            if (el.checked) {
                var approved = 1;
            } else {
                var approved = 0;
            }
            $.post('{{ route('products.approved') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                approved: approved
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Product approval update successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function update_featured(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.featured') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Featured products updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function sort_products(el) {
            $('#sort_products').submit();
        }

        function bulk_delete() {
            var data = new FormData($('#sort_products')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('bulk-product-delete') }}",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    }
                }
            });
        }
    </script>
@endsection
