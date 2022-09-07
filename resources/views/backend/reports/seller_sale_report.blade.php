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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Seller Based</h1>
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
                    <li class="breadcrumb-item text-muted">Reports</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Selling Report</li>
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
            <form class="" id="sort_sellers" action="{{ route('seller_sale_report.index') }}" method="GET">
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <h2>{{ translate('Seller Based Selling Report') }}</h2>
                            </div>
                        </div>
                        <!--begin::Input group-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <form id="sort_uploads" action="">
                            <div class="d-flex justify-content-end" data-kt-filemanager-table-toolbar="base">
                                <!--begin::Input group-->
                                    <div class="me-5">
                                        <select class="form-select form-select-solid" data-kt-select2="true"
                                            data-placeholder="Select option" name="verification_status">
                                            <option value="1" @if($sort_by == '1') selected @endif>{{ translate('Approved') }}</option>
                                            <option value="0" @if($sort_by == '0') selected @endif>{{ translate('Non Approved') }}</option>
                                        </select>
                                    </div>
                                <!--end::Input-->
                                <!--begin::Add customer-->
                                <button  class="btn btn-primary" type="submit">
                                <!--end::Svg Icon-->{{translate('Filter')}}</button>
                                <!--end::Add customer-->
                            </div>
                            </form>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Input-->
                        <!--end::Input group-->

                        <!--end::Card title-->
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
                                    <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-200px">{{ translate('Seller Name') }}</th>
                                        <th class="min-w-200px">{{ translate('Shop Name') }}</th>
                                        <th class="min-w-200px">{{ translate('Number of Product Sale') }}</th>
                                        <th class="min-w-200px">{{ translate('Order Amount') }}</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                    <!--begin::Table row-->
                                    @foreach ($sellers as $key => $seller)
                                        @if($seller->user != null)
                                            <tr>
                                                <!--begin::Checkbox-->
                                                <td>
                                                    {{ $seller->user->name }}
                                                </td>
                                                <!--end::Checkbox-->
                                                <!--begin::Product=-->
                                                <td>
                                                    <span class="fw-bolder">
                                                        <!--begin::Product name-->
                                                        @if($seller->user->shop != null)
                                                            {{ $seller->user->shop->name }}
                                                        @else
                                                            --
                                                        @endif
                                                    </span>
                                                </td>
                                                <!--end::Product=-->
                                                <!--begin::Product Owner=-->
                                                <td class="text-center pe-0">
                                                    <span class="fw-bolder">
                                                        @php
                                                        $num_of_sale = 0;
                                                        foreach ($seller->user->products as $key => $product) {
                                                            $num_of_sale += $product->num_of_sale;
                                                        }
                                                        @endphp
                                                        {{ $num_of_sale }}
                                                    </span>
                                                </td>
                                                <!--end::Product Owner=-->
                                                <td>
                                                    {{ single_price(\App\Models\OrderDetail::where('seller_id', $seller->user->id)->sum('price')) }}
                                                </td>
                                                <!--end::Action=-->
                                            </tr>
                                        @endif
                                    @endforeach
                                    <!--end::Table row-->
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <div class="aiz-pagination">
                            {{ $sellers->appends(request()->input())->links() }}
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


{{-- <div class="aiz-titlebar text-left mt-2 mb-3">
	<div class=" align-items-center">
       <h1 class="h3">{{translate('Seller Based Selling Report')}}</h1>
	</div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('seller_sale_report.index') }}" method="GET">
                    <div class="form-group row offset-lg-2">
                        <label class="col-md-3 col-form-label">{{translate('Sort by verificarion status')}} :</label>
                        <div class="col-md-5">
                            <select class="from-control aiz-selectpicker" name="verification_status" required>
                               <option value="1" @if($sort_by == '1') selected @endif>{{ translate('Approved') }}</option>
                               <option value="0" @if($sort_by == '0') selected @endif>{{ translate('Non Approved') }}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit">{{ translate('Filter') }}</button>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>{{ translate('Seller Name') }}</th>
                            <th data-breakpoints="lg">{{ translate('Shop Name') }}</th>
                            <th data-breakpoints="lg">{{ translate('Number of Product Sale') }}</th>
                            <th>{{ translate('Order Amount') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sellers as $key => $seller)
                            @if($seller->user != null)
                                <tr>
                                    <td>{{ $seller->user->name }}</td>
                                    @if($seller->user->shop != null)
                                        <td>{{ $seller->user->shop->name }}</td>
                                    @else
                                        <td>--</td>
                                    @endif
                                    <td>
                                        @php
                                            $num_of_sale = 0;
                                            foreach ($seller->user->products as $key => $product) {
                                                $num_of_sale += $product->num_of_sale;
                                            }
                                        @endphp
                                        {{ $num_of_sale }}
                                    </td>
                                    <td>
                                        {{ single_price(\App\Models\OrderDetail::where('seller_id', $seller->user->id)->sum('price')) }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination mt-4">
                    {{ $sellers->links() }}
                </div>
            </div>
        </div>
    </div>
</div> --}}

@endsection
