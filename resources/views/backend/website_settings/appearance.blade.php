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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Appearance</h1>
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
                    <li class="breadcrumb-item text-muted">Website Setup</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Appearance Edit</li>
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
        <div id="kt_content_container" class="container-xl w-1000px">

            <!--begin::Main column-->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <!--begin::General options-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{ translate('General') }}</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10"
                        action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body pt-0">
                            <div class="mb-5 fv-row">
                                <label class="form-label">{{ translate('Frontend Website Name') }}</label>
                                <input type="hidden" name="types[]" value="website_name">
                                <input type="text" placeholder="{{ translate('Website Name') }}" id="website_name"
                                    name="website_name" class="form-control mb-2"
                                    value="{{ get_setting('website_name') }}">
                            </div>

                            <div class="mb-5 fv-row">
                                <label class="form-label">{{ translate('Site Motto') }}</label>
                                <input type="hidden" name="types[]" value="site_motto">
                                <input type="text" placeholder="{{ translate('Best eCommerce Website') }}" id="site_motto"
                                    name="site_motto" class="form-control mb-2" value="{{ get_setting('site_motto') }}">
                            </div>

                            <div class="fv-row mt-5 mb-2">
                                <label class="form-label">{{ translate('Site Icon') }}</label>
                                <!--begin::Dropzone-->
                                <div class="dropzone" id="kt_ecommerce_add_product_mediaa" data-toggle="aizuploader"
                                    data-type="image">
                                    <!--begin::Message-->
                                    <div class="dz-message needsclick">
                                        <!--begin::Icon-->
                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                        <!--end::Icon-->
                                        <!--begin::Info-->
                                        <input type="hidden" name="types[]" value="site_icon">
                                        <input type="hidden" name="site_icon" class="selected-files"
                                            value="{{ get_setting('site_icon') }}">
                                        <div class="ms-4">
                                            <h3 class="fs-5 fw-bolder text-gray-900 mb-1">
                                                {{ translate('Website favicon. 32x32 .png') }}.</h3>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                </div>
                                <!--end::Dropzone-->
                                <div class="file-preview box sm">
                                </div>
                            </div>

                            <div class="mb-5 fv-row">
                                <label class="form-label">{{ translate('Website Base Color') }}</label>
                                <input type="hidden" name="types[]" value="base_color">
                                <input type="text" placeholder="#377dff" id="base_color" name="base_color"
                                    class="form-control mb-2" value="{{ get_setting('base_color') }}">
                            </div>

                            <div class="mb-5 fv-row">
                                <label class="form-label">{{ translate('Website Base Hover Color') }}</label>
                                <input type="hidden" name="types[]" value="base_hov_color">
                                <input type="text" placeholder="#377dff" id="base_hov_color" name="base_hov_color"
                                    class="form-control mb-2" value="{{ get_setting('base_hov_color') }}">
                            </div>

                            <div class="d-flex justify-content-end">

                                <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                    <span class="indicator-label">{{ translate('Update') }}</span>
                                    <span class="indicator-progress">{{ translate('Please wait') }}...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                    </form>
                    <!--end::Card body-->

                    <div class="separator"></div>

                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{ translate('Global SEO') }}</h2>
                        </div>
                    </div>
                    <!--begin::Card body-->
                    <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10"
                        action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body pt-0">
                            <div class="mb-5 fv-row">
                                <label class="form-label">{{ translate('Meta Title') }}</label>
                                <input type="hidden" name="types[]" value="meta_title">
                                <input type="text" placeholder="{{ translate('Title') }}" id="meta_title"
                                    name="meta_title" class="form-control mb-2" value="{{ get_setting('meta_title') }}">
                            </div>

                            <div class="mb-5 fv-row">
                                <label class="form-label">{{ translate('Meta description') }}</label>
                                <input type="hidden" name="types[]" value="meta_description">
                                <input type="text" placeholder="{{ translate('Description') }}" id="meta_description"
                                    name="meta_description" class="form-control mb-2"
                                    value="{{ get_setting('meta_description') }}">
                            </div>

                            <div class="mb-5 fv-row">
                                <label class="form-label">{{ translate('Keywords') }}</label>
                                <input type="hidden" name="types[]" value="meta_keywords">
                                <input type="text" placeholder="{{ translate('Keyword, Keyword') }}" id="meta_keywords"
                                    name="meta_keywords" class="form-control mb-2"
                                    value="{{ get_setting('meta_keywords') }}">
                                <div class="ms-4">
                                    <span class="fw-bolder mb-1">{{ translate('Separate with coma') }}</span>
                                </div>
                            </div>

                            <div class="fv-row mt-5 mb-2">
                                <label class="form-label">{{ translate('Meta Image') }}</label>
                                <!--begin::Dropzone-->
                                <div class="dropzone" id="kt_ecommerce_add_product_mediaa" data-toggle="aizuploader"
                                    data-type="image">
                                    <!--begin::Message-->
                                    <div class="dz-message needsclick">
                                        <!--begin::Icon-->
                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                        <!--end::Icon-->
                                        <!--begin::Info-->
                                        <input type="hidden" name="types[]" value="meta_image">
                                        <input type="hidden" name="meta_image" class="selected-files"
                                            value="{{ get_setting('meta_image') }}">
                                        <!--end::Info-->
                                        <div class="ms-4">
                                            <h3 class="fs-5 fw-bolder text-gray-900 mb-1">{{ translate('Meta Image') }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Dropzone-->
                                <div class="file-preview box sm">
                                </div>
                            </div>

                            <div class="mb-5 fv-row">
                                <label class="form-label">{{ translate('Website Base Color') }}</label>
                                <input type="hidden" name="types[]" value="base_color">
                                <input type="text" placeholder="#377dff" id="base_color" name="base_color"
                                    class="form-control mb-2" value="{{ get_setting('base_color') }}">
                            </div>

                            <div class="mb-5 fv-row">
                                <label class="form-label">{{ translate('Website Base Hover Color') }}</label>
                                <input type="hidden" name="types[]" value="base_hov_color">
                                <input type="text" placeholder="#377dff" id="base_hov_color" name="base_hov_color"
                                    class="form-control mb-2" value="{{ get_setting('base_hov_color') }}">
                            </div>

                            <div class="d-flex justify-content-end">

                                <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                    <span class="indicator-label">{{ translate('Update') }}</span>
                                    <span class="indicator-progress">{{ translate('Please wait') }}...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                    </form>
                    <!--end::Card body-->

                    <div class="separator"></div>

                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{ translate('Cookies Agreement') }}</h2>
                        </div>
                    </div>
                    <!--begin::Card body-->
                    <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10"
                        action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body pt-0">

                            <div class="mb-5 fv-row">
                                <label class="form-label">{{ translate('Cookies Agreement Text') }}</label>
                                <input type="hidden" name="types[]" value="cookies_agreement_text">
                                <textarea data-buttons='[["font", ["bold"]],["insert", ["link"]]]' class="aiz-text-editor"
                                    data-button name="cookies_agreement_text" placeholder="Type.." data-min-height="200">
              {!! get_setting('cookies_agreement_text') !!}
             </textarea>
                            </div>

                            <div class="fv-row mt-5 mb-2">
                                <label
                                    class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5">
                                    <span
                                        class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">{{ translate('Show Cookies Agreement?') }}</span>
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input type="hidden" name="types[]" value="show_cookies_agreement">
                                        <input class="form-check-input" type="checkbox" name="show_cookies_agreement"
                                            @if (get_setting('show_cookies_agreement') == 'on') checked @endif>
                                    </span>
                                </label>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                    <span class="indicator-label">{{ translate('Update') }}</span>
                                    <span class="indicator-progress">{{ translate('Please wait') }}...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                    </form>
                    <!--end::Card body-->

                    <div class="separator"></div>

                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{ translate('Website Popup') }}</h2>
                        </div>
                    </div>
                    <!--begin::Card body-->
                    <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10"
                        action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body pt-0">

                            <div class="fv-row mt-5 mb-2">
                                <label
                                    class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5">
                                    <span
                                        class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">{{ translate('Show website popup?') }}</span>
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input type="hidden" name="types[]" value="show_cookies_agreement">
                                        <input class="form-check-input" type="checkbox" name="show_cookies_agreement"
                                            @if (get_setting('show_cookies_agreement') == 'on') checked @endif>
                                    </span>
                                </label>
                            </div>

                            <div class="mb-5 fv-row">
                                <label class="form-label">{{ translate('Popup content') }}</label>
                                <input type="hidden" name="types[]" value="website_popup_content">
                                <textarea class="aiz-text-editor" name="website_popup_content" placeholder="Type.."
                                    data-min-height="200">
              {!! get_setting('website_popup_content') !!}
             </textarea>
                            </div>

                            <div class="fv-row mt-5 mb-2">
                                <label
                                    class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5">
                                    <span
                                        class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">{{ translate('Show Subscriber form?') }}</span>
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input type="hidden" name="types[]" value="show_subscribe_form">
                                        <input class="form-check-input" type="checkbox" name="show_subscribe_form"
                                            @if (get_setting('show_subscribe_form') == 'on') checked @endif>
                                    </span>
                                </label>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                    <span class="indicator-label">{{ translate('Update') }}</span>
                                    <span class="indicator-progress">{{ translate('Please wait') }}...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                    </form>
                    <!--end::Card body-->

                    <div class="separator"></div>

                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{ translate('Custom Script') }}</h2>
                        </div>
                    </div>
                    <!--begin::Card body-->
                    <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10"
                        action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body pt-0">

                            <div class="mb-5 fv-row">
                                <label
                                    class="form-label">{{ translate('Header custom script - before </head>') }}</label>
                                <input type="hidden" name="types[]" value="header_script">
                                <script>
                                    & #10;...&# 10;
                                </script>"
                                    data-min-height="200">
              {!! get_setting('header_script') !!}
             </textarea>
                            </div>

                            <div class="mb-5 fv-row">
                                <label
                                    class="form-label">{{ translate('Footer custom script - before </body>') }}</label>
                                <input type="hidden" name="types[]" value="footer_script">
                                <script>
                                    & #10;...&# 10;
                                </script>"
                                    data-min-height="200">
              {!! get_setting('footer_script') !!}
             </textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                    <span class="indicator-label">{{ translate('Update') }}</span>
                                    <span class="indicator-progress">{{ translate('Please wait') }}...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                    </form>
                    <!--end::Card body-->

                </div>
                <!--end::Main column-->
            </div>
            <!--end::Main column-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>

@endsection
