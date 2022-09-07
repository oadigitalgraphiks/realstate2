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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Features Activation</h1>
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
                    <li class="breadcrumb-item text-dark">Activation</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->

    <h4 class="text-center text-muted">{{translate('System')}}</h4>
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid mt-10" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="row g-5 g-xl-8">
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h5 class="mb-0 h6 text-center">{{translate('HTTPS Activation')}}</h5>
                        </div>
                        <div class="card-body text-center">
                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                    <input class="form-check-input" onchange="updateSettings(this, 'FORCE_HTTPS')" type="checkbox" @if( get_setting('FORCE_HTTPS') == "On") checked @endif >
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Maintenance Mode Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                    <input class="form-check-input" onchange="updateSettings(this, 'maintenance_mode')" type="checkbox" @if( get_setting('maintenance_mode') == 1) checked @endif >
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Disable image encoding?')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                    <input class="form-check-input" onchange="updateSettings(this, 'disable_image_optimization')" type="checkbox" @if( get_setting('disable_image_optimization') == 1) checked @endif >
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <h4 class="text-center text-muted mt-4">{{translate('Business Related')}}</h4>

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid mt-10" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="row g-5 g-xl-8">
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Vendor System Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                    <input class="form-check-input" onchange="updateSettings(this, 'vendor_system_activation')" type="checkbox" @if( get_setting('vendor_system_activation') == 1) checked @endif >
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Classified Product')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                    <input class="form-check-input" onchange="updateSettings(this, 'classified_product')" type="checkbox" @if( get_setting('classified_product') == 1) checked @endif >
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Wallet System Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                    <input class="form-check-input" onchange="updateSettings(this, 'wallet_system')" type="checkbox" @if( get_setting('wallet_system') == 1) checked @endif >
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Coupon System Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                    <input class="form-check-input" onchange="updateSettings(this, 'coupon_system')" type="checkbox" @if( get_setting('coupon_system') == 1) checked @endif >
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Pickup Point Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                    <input class="form-check-input" onchange="updateSettings(this, 'pickup_point')" type="checkbox" @if( get_setting('pickup_point') == 1) checked @endif >
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Conversation Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                    <input class="form-check-input" onchange="updateSettings(this, 'conversation_system')" type="checkbox" @if( get_setting('conversation_system') == 1) checked @endif >
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Seller Product Manage By Admin')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                    <input class="form-check-input" onchange="updateSettings(this, 'product_manage_by_admin')" type="checkbox" @if( \App\Models\BusinessSetting::where('type', 'product_manage_by_admin')->first() &&
                                    get_setting('product_manage_by_admin') == 1) checked @endif >
                                </span>
                            </label>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{ translate('After activate this option Cash On Delivery of Seller product will be managed by Admin')}}.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Admin Approval On Seller Product')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                    <input class="form-check-input" onchange="updateSettings(this, 'product_approve_by_admin')" type="checkbox" @if( \App\Models\BusinessSetting::where('type', 'product_approve_by_admin')->first() &&
                                    get_setting('product_approve_by_admin') == 1) checked @endif >
                                </span>
                            </label>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{ translate('After activate this option, Admin approval need to seller product')}}.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Email Verification')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                    <input class="form-check-input" onchange="updateSettings(this, 'email_verification')" type="checkbox" @if( get_setting('email_verification') == 1) checked @endif >
                                </span>
                            </label>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{translate("You need to configure SMTP correctly to enable this feature")}}. <a href="{{ route('smtp_settings.index') }}">{{translate("Configure Now")}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h4 class="text-center text-muted mt-4">{{translate('Payment Related')}}</h4>
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid mt-10" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="row g-5 g-xl-8">
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Paypal Payment Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="clearfix">
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                    <img class="float-left" src="{{ static_asset('assets/img/cards/paypal.png') }}" height="30">
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input class="form-check-input" onchange="updateSettings(this, 'paypal_payment')" type="checkbox" @if( get_setting('paypal_payment') == 1) checked @endif >
                                    </span>
                                </label>
                            </div>
                            <div class="alert text-center" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{ translate('You need to configure Paypal correctly to enable this feature') }}. <a href="{{ route('payment_method.index') }}">{{ translate('Configure Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Stripe Payment Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="clearfix">
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                    <img   class="float-left" src="{{ static_asset('assets/img/cards/stripe.png') }}" height="30">
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input class="form-check-input" onchange="updateSettings(this, 'stripe_payment')" type="checkbox" @if( get_setting('stripe_payment') == 1) checked @endif >
                                    </span>
                                </label>
                            </div>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                You need to configure Stripe correctly to enable this feature. <a href="{{ route('payment_method.index') }}">Configure Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('SSlCommerz Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="clearfix">
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                    <img class="float-left" src="{{ static_asset('assets/img/cards/sslcommerz.png') }}" height="30">
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input class="form-check-input" onchange="updateSettings(this, 'sslcommerz_payment')" type="checkbox" @if( get_setting('sslcommerz_payment') == 1) checked @endif >
                                    </span>
                                </label>
                            </div>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                You need to configure SSlCommerz correctly to enable this feature. <a href="{{ route('payment_method.index') }}">Configure Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid mt-10" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="row g-5 g-xl-8">
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Instamojo Payment Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="clearfix">
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                    <img class="float-left" src="{{ static_asset('assets/img/cards/instamojo.png') }}" height="30">
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input class="form-check-input" onchange="updateSettings(this, 'instamojo_payment')" type="checkbox" @if( get_setting('instamojo_payment') == 1) checked @endif >
                                    </span>
                                </label>
                            </div>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{ translate('You need to configure Instamojo Payment correctly to enable this feature') }}. <a href="{{ route('payment_method.index') }}">{{ translate('Configure Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Razor Pay Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="clearfix">
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                    <img class="float-left" src="{{ static_asset('assets/img/cards/rozarpay.png') }}" height="30">
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input class="form-check-input" onchange="updateSettings(this, 'razorpay')" type="checkbox" @if( get_setting('razorpay') == 1) checked @endif >
                                    </span>
                                </label>
                            </div>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{ translate('You need to configure Razor correctly to enable this feature') }}. <a href="{{ route('payment_method.index') }}">{{ translate('Configure Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('PayStack Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="clearfix">
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                    <img class="float-left" src="{{ static_asset('assets/img/cards/paystack.png') }}" height="30">
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input class="form-check-input" onchange="updateSettings(this, 'paystack')" type="checkbox" @if( get_setting('paystack') == 1) checked @endif >
                                    </span>
                                </label>
                            </div>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{ translate('You need to configure PayStack correctly to enable this feature')  }}. <a href="{{ route('payment_method.index') }}">{{ translate('Configure Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid mt-10" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="row g-5 g-xl-8">
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('VoguePay Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="clearfix">
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                    <img class="float-left" src="{{ static_asset('assets/img/cards/vogue.png') }}" height="30">
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input class="form-check-input" onchange="updateSettings(this, 'voguepay')" type="checkbox" @if( get_setting('voguepay') == 1) checked @endif >
                                    </span>
                                </label>
                            </div>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{ translate('You need to configure VoguePay correctly to enable this feature') }}. <a href="{{ route('payment_method.index') }}">{{ translate('Configure Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Payhere Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="clearfix">
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                    <img class="float-left" src="{{ static_asset('assets/img/cards/payhere.png') }}" height="30">
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input class="form-check-input" onchange="updateSettings(this, 'payhere')" type="checkbox" @if( get_setting('payhere') == 1) checked @endif >
                                    </span>
                                </label>
                            </div>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{ translate('You need to configure VoguePay correctly to enable this feature') }}. <a href="{{ route('payment_method.index') }}">{{ translate('Configure Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Ngenius Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="clearfix">
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                    <img class="float-left" src="{{ static_asset('assets/img/cards/ngenius.png') }}" height="30">
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input class="form-check-input" onchange="updateSettings(this, 'ngenius')" type="checkbox" @if( get_setting('ngenius') == 1) checked @endif >
                                    </span>
                                </label>
                            </div>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{ translate('You need to configure Ngenius correctly to enable this feature') }}. <a href="{{ route('payment_method.index') }}">{{ translate('Configure Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Iyzico Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="clearfix">
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                    <img class="float-left" src="{{ static_asset('assets/img/cards/iyzico.png') }}" height="30">
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input class="form-check-input" onchange="updateSettings(this, 'iyzico')" type="checkbox" @if( get_setting('iyzico') == 1) checked @endif >
                                    </span>
                                </label>
                            </div>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{ translate('You need to configure iyzico correctly to enable this feature') }}. <a href="{{ route('payment_method.index') }}">{{ translate('Configure Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Bkash Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="clearfix">
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                    <img class="float-left" src="{{ static_asset('assets/img/cards/bkash.png') }}" height="30">
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input class="form-check-input" onchange="updateSettings(this, 'bkash')" type="checkbox" @if( get_setting('bkash') == 1) checked @endif >
                                    </span>
                                </label>
                            </div>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{ translate('You need to configure bkash correctly to enable this feature') }}. <a href="{{ route('payment_method.index') }}">{{ translate('Configure Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Nagad Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="clearfix">
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                    <img class="float-left" src="{{ static_asset('assets/img/cards/nagad.png') }}" height="30">
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input class="form-check-input" onchange="updateSettings(this, 'nagad')" type="checkbox" @if( get_setting('nagad') == 1) checked @endif >
                                    </span>
                                </label>
                            </div>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{ translate('You need to configure nagad correctly to enable this feature') }}. <a href="{{ route('payment_method.index') }}">{{ translate('Configure Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Proxy Pay Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="clearfix">
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                    <img class="float-left" src="{{ static_asset('assets/img/cards/proxypay.png') }}" height="30">
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input class="form-check-input" onchange="updateSettings(this, 'proxypay')" type="checkbox" @if( get_setting('proxypay') == 1) checked @endif >
                                    </span>
                                </label>
                            </div>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{ translate('You need to configure proxypay correctly to enable this feature') }}. <a href="{{ route('payment_method.index') }}">{{ translate('Configure Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Amarpay Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="clearfix">
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                    <img class="float-left" src="{{ static_asset('assets/img/cards/aamarpay.png') }}" height="30">
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input class="form-check-input" onchange="updateSettings(this, 'aamarpay')" type="checkbox" @if( get_setting('aamarpay') == 1) checked @endif >
                                    </span>
                                </label>
                            </div>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{ translate('You need to configure amarpay correctly to enable this feature') }}. <a href="{{ route('payment_method.index') }}">{{ translate('Configure Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Authorize Net Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="clearfix">
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                    <img class="float-left" src="{{ static_asset('assets/img/cards/authorizenet.png') }}" height="30">
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input class="form-check-input" onchange="updateSettings(this, 'authorizenet')" type="checkbox" @if( get_setting('authorizenet') == 1) checked @endif >
                                    </span>
                                </label>
                            </div>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{ translate('You need to configure authorize net correctly to enable this feature') }}. <a href="{{ route('payment_method.index') }}">{{ translate('Configure Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Payku Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="clearfix">
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                    <img class="float-left" src="{{ static_asset('assets/img/cards/payku.png') }}" height="30">
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input class="form-check-input" onchange="updateSettings(this, 'payku')" type="checkbox" @if( get_setting('payku') == 1) checked @endif >
                                    </span>
                                </label>
                            </div>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{ translate('You need to configure payku net correctly to enable this feature') }}. <a href="{{ route('payment_method.index') }}">{{ translate('Configure Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Cash Payment Activation')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="clearfix">
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                    <img class="float-left" src="{{ static_asset('assets/img/cards/cod.png') }}" height="30">
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input class="form-check-input" onchange="updateSettings(this, 'cash_payment')" type="checkbox" @if( get_setting('cash_payment') == 1) checked @endif >
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <h4 class="text-center text-muted mt-4">{{translate('Social Media Login')}}</h4>

    <div class="post d-flex flex-column-fluid mt-10" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="row g-5 g-xl-8">
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Facebook login')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                    <input class="form-check-input" onchange="updateSettings(this, 'facebook_login')" type="checkbox" @if( get_setting('facebook_login') == 1) checked @endif >
                                </span>
                            </label>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{ translate('You need to configure Facebook Client correctly to enable this feature') }}. <a href="{{ route('social_login.index') }}">{{ translate('Configure Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Google login')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                    <input class="form-check-input" onchange="updateSettings(this, 'google_login')" type="checkbox" @if( get_setting('google_login') == 1) checked @endif >
                                </span>
                            </label>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{ translate('You need to configure Google Client correctly to enable this feature') }}. <a href="{{ route('social_login.index') }}">{{ translate('Configure Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="mb-0 h6 text-center">{{translate('Twitter login')}}</h3>
                        </div>
                        <div class="card-body text-center">
                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                    <input class="form-check-input" onchange="updateSettings(this, 'twitter_login')" type="checkbox" @if( get_setting('twitter_login') == 1) checked @endif >
                                </span>
                            </label>
                            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                {{ translate('You need to configure Twitter Client correctly to enable this feature') }}. <a href="{{ route('social_login.index') }}">{{ translate('Configure Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
    <script type="text/javascript">
        function updateSettings(el, type){
            if($(el).is(':checked')){
                var value = 1;
            }
            else{
                var value = 0;
            }

            $.post('{{ route('business_settings.update.activation') }}', {_token:'{{ csrf_token() }}', type:type, value:value}, function(data){
                if(data == '1'){
                    AIZ.plugins.notify('success', '{{ translate('Settings updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
