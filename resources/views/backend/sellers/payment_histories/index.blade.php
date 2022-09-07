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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Payouts</h1>
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
                    <li class="breadcrumb-item text-muted">Sellers</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Payouts</li>
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
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <h2>{{ translate('Seller Payments') }}</h2>
                        </div>
                    </div>
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
                                <tr class="text-center text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                    #
                                    </th>
                                    <th class="min-w-200px">{{ translate('Date') }}</th>
                                    <th class="text-center min-w-175px">{{ translate('Seller') }}</th>
                                    <th class="text-center min-w-175px">{{ translate('Amount') }}</th>
                                    <th class="text-center min-w-75px">{{ translate('Payment Details') }}</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bold text-gray-600">
                                <!--begin::Table row-->
                                @foreach ($payments as $key => $payment)
                                @if (\App\Models\Seller::find($payment->seller_id) != null && \App\Models\Seller::find($payment->seller_id)->user != null)

                                        <tr>
                                            <!--begin::Checkbox-->
                                            <td>
                                                {{ $key+1 }}
                                            </td>
                                            <!--end::Checkbox-->
                                            <!--begin::Product=-->
                                            <td class="text-center">
                                                <span class="fw-bolder">
                                                    <!--begin::Product name-->
                                                    {{ $payment->created_at }}
                                                </span>
                                            </td>
                                            <!--end::Product=-->
                                            <!--begin::Product Owner=-->
                                            <td class="text-center pe-0">
                                                <span class="fw-bolder">
                                                    @if (\App\Models\Seller::find($payment->seller_id) != null)
                                                    {{ \App\Models\Seller::find($payment->seller_id)->user->name }} ({{ \App\Models\Seller::find($payment->seller_id)->user->shop->name }})
                                                @endif
                                                </span>
                                            </td>
                                            <!--end::Product Owner=-->
                                            <!--begin::Customer=-->
                                            <td class="text-center pe-0" data-order="32">
                                                <span class="fw-bolder ms-3">
                                                    {{ single_price($payment->amount) }}
                                                </span>
                                            </td>
                                            <!--end::Customer=-->
                                            <!--begin::rating=-->
                                            <td class="text-center pe-0" data-order="2">
                                                <span>
                                                    {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }} @if ($payment->txn_code != null) (TRX ID : {{ $payment->txn_code }}) @endif
                                                </span>
                                            </td>
                                            <!--end::rating=-->
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
                        {{ $payments->appends(request()->input())->links() }}
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
