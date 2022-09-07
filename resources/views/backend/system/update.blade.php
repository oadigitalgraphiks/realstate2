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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Role</h1>
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
                    <li class="breadcrumb-item text-muted">System</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Update</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <div class="row">
        <div class="col-lg-8 col-xxl-6 mx-auto">
            <div class="card card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <h3 class="h6 mb-0">{{ translate('Update your system') }}</h3>
                    <span>{{ translate('Current verion') }}: {{ get_setting('current_version') }}</span>
                </div>
                <div class="card-body">
                    <div class="alert alert-info mb-5">
                        <ul class="mb-0">
                            <li class="">
                                {{ translate('Make sure your server has matched with all requirements.') }}
                                <a href="{{ route('system_server') }}">{{ translate('Check Here') }}</a>
                            </li>
                            <li class="">{{ translate('Download latest version from codecanyon.') }}</li>
                            <li class="">
                                {{ translate('Extract downloaded zip. You will find updates.zip file in those extraced files.') }}
                            </li>
                            <li class="">{{ translate('Upload that zip file here and click update now.') }}
                            </li>
                            <li class="">
                                {{ translate('If you are using any addon make sure to update those addons after updating.') }}
                            </li>
                            <li class="">
                                {{ translate('Please turn off maintenance mode before updating.') }}</li>
                        </ul>
                    </div>
                    <form action="{{ route('update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row gutters-5">
                            <div class="col-md">
                                <div class="input-group " data-toggle="aizuploader" data-type="archive">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="update_zip" value="" class="selected-files">
                                </div>
                                <div class="file-preview box"></div>
                            </div>
                            <div class="col-md-auto">
                                <button type="submit"
                                    class="btn btn-primary btn-block">{{ translate('Update Now') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
