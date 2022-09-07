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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">General Settings</h1>
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
                    <li class="breadcrumb-item text-dark">General Setting</li>
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
        <div id="kt_content_container" class="container-xl w-700px">
            <!--begin::Main column-->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <!--begin::General options-->
                <div class="card card-flush py-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h1 class="mb-0 h6">{{translate('General Settings')}}</h1>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('business_settings.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="fv-row mb-2">
                                    <label for="kt_ecommerce_add_product_store_template"
                                class="form-label">{{translate('System Name')}}</label>
                                    <div class="col-sm-12">
                                        <input type="hidden" name="types[]" value="site_name">
                                        <input type="text" name="site_name" class="form-control" value="{{ get_setting('site_name') }}">
                                    </div>
                                </div>
                                <div class="fv-row mb-2">
                                    <label for="kt_ecommerce_add_product_store_template"
                                class="form-label">{{translate('System Logo - White')}}</label>
                                    <div class="col-sm-12">
                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose Files') }}</div>
                                            <input type="hidden" name="types[]" value="system_logo_white">
                                            <input type="hidden" name="system_logo_white" value="{{ get_setting('system_logo_white') }}" class="selected-files">
                                        </div>
                                        <div class="file-preview box sm"></div>
                                        <small>{{ translate('Will be used in admin panel side menu') }}</small>
                                    </div>
                                </div>
                                <div class="fv-row mb-2">
                                    <label for="kt_ecommerce_add_product_store_template"
                                class="form-label">{{translate('System Logo - Black')}}</label>
                                    <div class="col-sm-12">
                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose Files') }}</div>
                                            <input type="hidden" name="types[]" value="system_logo_black">
                                            <input type="hidden" name="system_logo_black" value="{{ get_setting('system_logo_black') }}" class="selected-files">
                                        </div>
                                        <div class="file-preview box sm"></div>
                                        <small>{{ translate('Will be used in admin panel topbar in mobile + Admin login page') }}</small>
                                    </div>
                                </div>
                                <div class="fv-row mb-2">

                                    <label for="kt_ecommerce_add_product_store_template"
                                class="form-label">{{translate('System Timezone')}}</label>
                                    <div class="col-sm-12">
                                        <input type="hidden" name="types[]" value="timezone">
                                        <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                        data-placeholder="Select an option" id="timezone" name="timezone"
                                        data-live-search="true">
                                        {{-- <select name="timezone" class="form-control aiz-selectpicker" data-live-search="true"> --}}
                                            @foreach (timezones() as $key => $value)
                                                <option value="{{ $value }}" @if (app_timezone() == $value)
                                                    selected
                                                @endif>{{ $key }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="fv-row mb-2">

                                    <label for="kt_ecommerce_add_product_store_template"
                                class="form-label">{{translate('Admin login page background')}}</label>
                                    <div class="col-sm-12">
                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose Files') }}</div>
                                            <input type="hidden" name="types[]" value="admin_login_background">
                                            <input type="hidden" name="admin_login_background" value="{{ get_setting('admin_login_background') }}" class="selected-files">
                                        </div>
                                        <div class="file-preview box sm"></div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
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
