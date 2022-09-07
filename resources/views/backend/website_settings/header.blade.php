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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Header</h1>
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
                        <li class="breadcrumb-item text-dark">Header Edit</li>
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
                <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10"
                    action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{ translate('Website Header') }}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <div class="fv-row mt-5 mb-2">
                                    <label class="form-label">{{ translate('Header Logo') }}</label>
                                    <!--begin::Dropzone-->
                                    <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                        data-toggle="aizuploader" data-type="image">
                                        <!--begin::Message-->
                                        <div class="dz-message needsclick">
                                            <!--begin::Icon-->
                                            <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                            <!--end::Icon-->
                                            <!--begin::Info-->
                                            <input type="hidden" name="types[]" value="header_logo">
                                            <input type="hidden" name="header_logo" class="selected-files" value="{{ get_setting('header_logo') }}">
                                            <div class="ms-4">
                                                <h3 class="fs-5 fw-bolder text-gray-900 mb-1">
                                                    {{ translate('Drop files here or click to upload') }}.
                                                </h3>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                    </div>
                                    <!--end::Dropzone-->
                                    <div class="file-preview box sm">
                                    </div>

                                </div>
                                <div class="fv-row mt-5 mb-2">
                                    <label
                                        class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5">
                                        <span
                                            class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">{{ translate('Show Language Switcher?') }}</span>
                                        <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                            <input type="hidden" name="types[]" value="show_language_switcher">
                                            <input class="form-check-input" type="checkbox" name="show_language_switcher"
                                                @if (get_setting('show_language_switcher') == 'on') checked @endif>
                                        </span>
                                    </label>
                                </div>
                                <div class="fv-row mt-5 mb-2">
                                    <label
                                        class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5">
                                        <span
                                            class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">{{ translate('Show Currency Switcher?') }}</span>
                                        <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                            <input type="hidden" name="types[]" value="show_currency_switcher">
                                            <input class="form-check-input" type="checkbox" name="show_currency_switcher"
                                                @if (get_setting('show_currency_switcher') == 'on') checked @endif>
                                        </span>
                                    </label>
                                </div>
                                <div class="fv-row mt-5 mb-2">
                                    <label
                                        class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5">
                                        <span
                                            class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">{{ translate('Enable stikcy header?') }}</span>
                                        <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                            <input type="hidden" name="types[]" value="header_stikcy">
                                            <input class="form-check-input" type="checkbox" name="header_stikcy"
                                                @if (get_setting('header_stikcy') == 'on') checked @endif>
                                        </span>
                                    </label>
                                </div>
                                <div class="fv-row mt-5 mb-2">
                                    <label class="form-label">{{ translate('Topbar Banner') }}</label>
                                    <!--begin::Dropzone-->
                                    <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                        data-toggle="aizuploader" data-type="image">
                                        <!--begin::Message-->
                                        <div class="dz-message needsclick">
                                            <!--begin::Icon-->
                                            <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                            <!--end::Icon-->
                                            <!--begin::Info-->
                                            <input type="hidden" name="types[]" value="topbar_banner">
                                            <input type="hidden" name="topbar_banner" class="selected-files">
                                            <div class="ms-4">
                                                <h3 class="fs-5 fw-bolder text-gray-900 mb-1">
                                                    {{ translate('Drop files here or click
                                                                                                    to upload') }}.
                                                </h3>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                    </div>
                                    <!--end::Dropzone-->
                                    <div class="file-preview box sm">
                                    </div>
                                </div>
                                <div class="fv-row mt-5 mb-2">
                                    <div class="mb-5 fv-row">
                                        <label class="form-label">{{ translate('Topbar Banner Link') }}</label>
                                        <input type="hidden" name="types[]" value="topbar_banner_link">
                                        <input type="text"
                                            placeholder="{{ translate('Link with') }} http:// {{ translate('or') }} https://"
                                            id="topbar_banner_link" name="topbar_banner_link" class="form-control mb-2"
                                            value="{{ get_setting('topbar_banner_link') }}">
                                    </div>
                                </div>
                                <div class="fv-row mt-5 mb-2">
                                    <div class="mb-5 fv-row">
                                        <label class=" form-label">{{ translate('Help line number') }}</label>
                                        <input type="hidden" name="types[]" value="helpline_number">
                                        <input type="text" placeholder="{{ translate('Help line number') }}"
                                            id="helpline_number" name="helpline_number" class="form-control mb-2"
                                            value="{{ get_setting('helpline_number') }}">
                                    </div>
                                </div>
                                <div class="fv-row mt-5 mb-2">
                                    <div class="mb-5 fv-row header-nav-menu">
                                        <label class="required form-label">{{ translate('Header Nav Menu') }}</label>
                                        <input type="hidden" name="types[]" value="header_menu_labels">
                                        <input type="hidden" name="types[]" value="header_menu_links">
                                        @if (get_setting('header_menu_labels') != null)
                                            @foreach (json_decode(get_setting('header_menu_labels'), true) as $key => $value)
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <input type="text" placeholder="{{ translate('Label') }}"
                                                                name="header_menu_labels[]" value="{{ $value }}"
                                                                class="form-control mb-2">
                                                        </div>
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="form-group">
                                                            <input type="text"
                                                                placeholder="{{ translate('Link with') }} http:// {{ translate('or') }} https://"
                                                                name="header_menu_links[]"
                                                                value="{{ json_decode(App\Models\BusinessSetting::where('type', 'header_menu_links')->first()->value, true)[$key] }}"
                                                                class="form-control mb-2 text-gray">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button"
                                                            class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger"
                                                            data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more"
                                        data-content='<div class="row gutters-5">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control mb-2" placeholder="{{ translate('Label') }}" name="header_menu_labels[]">
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="form-group">
                                                <input type="text" class="form-control mb-2" placeholder="{{ translate('Link with') }} http:// {{ translate('or') }} https://" name="header_menu_links[]">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                                                <i class="las la-times"></i>
                                            </button>
                                        </div>
                                    </div>' data-target=".header-nav-menu">
                                        {{ translate('Add New') }}
                                    </button>
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
                        </div>
                        <!--end::Main column-->
                    </div>
                </form>
                <!--end::Container-->
            </div>
        </div>
        <!--end::Post-->
    </div>

@endsection
