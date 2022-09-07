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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Analytics</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
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
                    <li class="breadcrumb-item text-dark">Analytics</li>
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
            <div class="row g-5 g-xl-8">
                <div class="col-xl-6">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h5 class="mb-0 h6">{{ translate('Facebook Pixel Setting') }}</h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('facebook_pixel.update') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <label class="col-from-label">{{ translate('Facebook Pixel') }}</label>
                                    </div>
                                    <div class="col-md-7">
                                        <label
                                            class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                            <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                                <input class="form-check-input" value="1" name="facebook_pixel"
                                                    type="checkbox" @if (get_setting('facebook_pixel') == 1) checked @endif>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="FACEBOOK_PIXEL_ID">
                                    <div class="col-lg-3">
                                        <label class="col-from-label">{{ translate('Facebook Pixel ID') }}</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="FACEBOOK_PIXEL_ID"
                                            value="{{ env('FACEBOOK_PIXEL_ID') }}"
                                            placeholder="{{ translate('Facebook Pixel ID') }}" required>
                                    </div>
                                </div>
                                <div class="form-group mb-0 text-right">
                                    <button type="submit" class="btn btn-sm btn-primary">{{ translate('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-gray-light card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h5 class="mb-0 h6">
                                {{ translate('Please be carefull when you are configuring Facebook pixel.') }}</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group mar-no">
                                <li class="list-group-item text-dark">1.
                                    {{ translate('Log in to Facebook and go to your Ads Manager account') }}.</li>
                                <li class="list-group-item text-dark">2.
                                    {{ translate('Open the Navigation Bar and select Events Manager') }}.</li>
                                <li class="list-group-item text-dark">3.
                                    {{ translate('Copy your Pixel ID from underneath your Site Name and paste the number into Facebook Pixel ID field') }}.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h5 class="mb-0 h6">{{ translate('Google Analytics Setting') }}</h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('google_analytics.update') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <label class="col-from-label">{{ translate('Google Analytics') }}</label>
                                    </div>
                                    <div class="col-md-7">
                                        <label
                                            class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                            <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                                <input value="1" type="checkbox" class="form-check-input"
                                                    @if (get_setting('google_analytics') == 1) checked @endif>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="TRACKING_ID">
                                    <div class="col-lg-3">
                                        <label class="col-from-label">{{ translate('Tracking ID') }}</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="TRACKING_ID"
                                            value="{{ env('TRACKING_ID') }}"
                                            placeholder="{{ translate('Tracking ID') }}" required>
                                    </div>
                                </div>
                                <div class="form-group mb-0 text-right">
                                    <button type="submit" class="btn btn-sm btn-primary">{{ translate('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
