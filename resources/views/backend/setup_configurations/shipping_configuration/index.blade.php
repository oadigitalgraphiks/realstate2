@extends('backend.layouts.app')

@section('content')

<!--begin::Content-->
<div class="d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Shipping Method</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route("admin.dashboard") }}" class="text-muted text-hover-primary">Home</a>
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
                    <li class="breadcrumb-item text-muted">Setup & Configuration</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Shipping Method</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="row g-5 g-xl-8">
                <div class="col-lg-6">
                    <div class="card card-flush">
                        <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                            <h5 class="mb-0 h6">{{translate('Select Shipping Method')}}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('shipping_configuration.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="type" value="shipping_type">
                                <div class="radio mar-btm mb-5">
                                    <input id="product-shipping" class="magic-radio" type="radio" name="shipping_type" value="product_wise_shipping" <?php if(get_setting('shipping_type') == 'product_wise_shipping') echo "checked";?>>
                                    <label for="product-shipping">
                                        <span>{{translate('Product Wise Shipping Cost')}}</span>
                                        <span></span>
                                    </label>
                                </div>
                                <div class="radio mar-btm mb-5">
                                    <input id="flat-shipping" class="magic-radio" type="radio" name="shipping_type" value="flat_rate" <?php if(get_setting('shipping_type') == 'flat_rate') echo "checked";?>>
                                    <label for="flat-shipping">{{translate('Flat Rate Shipping Cost')}}</label>
                                </div>
                                <div class="radio mar-btm mb-5">
                                    <input id="seller-shipping" class="magic-radio" type="radio" name="shipping_type" value="seller_wise_shipping" <?php if(get_setting('shipping_type') == 'seller_wise_shipping') echo "checked";?>>
                                    <label for="seller-shipping">{{translate('Seller Wise Flat Shipping Cost')}}</label>
                                </div>
                                <div class="radio mar-btm mb-5">
                                    <input id="area-shipping" class="magic-radio" type="radio" name="shipping_type" value="area_wise_shipping" <?php if(get_setting('shipping_type') == 'area_wise_shipping') echo "checked";?>>
                                    <label for="area-shipping">{{translate('Area Wise Flat Shipping Cost')}}</label>
                                </div>
                                <div class="form-group mb-0 text-right">
                                    <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-flush">
                        <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                            <h5 class="mb-0 h6">{{translate('Note')}}</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    1. {{ translate('Product Wise Shipping Cost calulation: Shipping cost is calculate by addition of each product shipping cost') }}.
                                </li>
                                <li class="list-group-item">
                                    2. {{ translate('Flat Rate Shipping Cost calulation: How many products a customer purchase, doesn\'t matter. Shipping cost is fixed') }}.
                                </li>
                                <li class="list-group-item">
                                    3. {{ translate('Seller Wise Flat Shipping Cost calulation: Fixed rate for each seller. If customers purchase 2 product from two seller shipping cost is calculated by addition of each seller flat shipping cost') }}.
                                </li>
                                <li class="list-group-item">
                                    4. {{ translate('Area Wise Flat Shipping Cost calulation: Fixed rate for each area. If customers purchase multiple products from one seller shipping cost is calculated by the customer shipping area. To configure area wise shipping cost go to ') }} <a href="{{ route('cities.index') }}">{{ translate('Shipping Cities') }}</a>.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-5 g-xl-8">
                <div class="col-lg-6">
                    <div class="card card-flush">
                        <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                            <h5 class="mb-0 h6">{{translate('Flat Rate Cost')}}</h5>
                        </div>
                        <form action="{{ route('shipping_configuration.update') }}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <input type="hidden" name="type" value="flat_rate_shipping_cost">
                            <div class="form-group">
                                <div class="col-lg-12 mb-5">
                                    <input class="form-control" type="text" name="flat_rate_shipping_cost" value="{{ get_setting('flat_rate_shipping_cost') }}">
                                </div>
                            </div>
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-flush">
                        <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                            <h5 class="mb-0 h6">{{translate('Note')}}</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    {{ translate('1. Flat rate shipping cost is applicable if Flat rate shipping is enabled.') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-5 g-xl-8">
                <div class="col-lg-6">
                    <div class="card card-flush">
                        <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                            <h5 class="mb-0 h6">{{translate('Shipping Cost for Admin Products')}}</h5>
                        </div>
                        <form action="{{ route('shipping_configuration.update') }}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <input type="hidden" name="type" value="shipping_cost_admin">
                            <div class="form-group">
                                <div class="col-lg-12 mb-5">
                                    <input class="form-control" type="text" name="shipping_cost_admin" value="{{ get_setting('shipping_cost_admin') }}">
                                </div>
                            </div>
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-flush">
                        <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                            <h5 class="mb-0 h6">{{translate('Note')}}</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    {{ translate('1. Shipping cost for admin is applicable if Seller wise shipping cost is enabled.') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
