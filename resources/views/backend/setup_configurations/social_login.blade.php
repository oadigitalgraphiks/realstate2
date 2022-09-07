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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Social Login</h1>
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
                    <li class="breadcrumb-item text-dark">All Social Logins</li>
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
                <div class="col-md-6">
                    <div class="card card-flush">
                        <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                            <h5 class="mb-0 h6">{{ translate('Google Login Credential') }}</h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="GOOGLE_CLIENT_ID">
                                    <div class="col-lg-3">
                                        <label class="col-from-label">{{ translate('Client ID') }}</label>
                                    </div>
                                    <div class="col-md-7 mb-5">
                                        <input type="text" class="form-control" name="GOOGLE_CLIENT_ID"
                                            value="{{ env('GOOGLE_CLIENT_ID') }}"
                                            placeholder="{{ translate('Google Client ID') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="GOOGLE_CLIENT_SECRET">
                                    <div class="col-lg-3">
                                        <label class="col-from-label">{{ translate('Client Secret') }}</label>
                                    </div>
                                    <div class="col-md-7 mb-5">
                                        <input type="text" class="form-control" name="GOOGLE_CLIENT_SECRET"
                                            value="{{ env('GOOGLE_CLIENT_SECRET') }}"
                                            placeholder="{{ translate('Google Client Secret') }}" required>
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
                    <div class="card card-flush">
                        <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                            <h5 class="mb-0 h6">{{ translate('Facebook Login Credential') }}</h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="FACEBOOK_CLIENT_ID">
                                    <div class="col-lg-3">
                                        <label class="col-from-label">{{ translate('App ID') }}</label>
                                    </div>
                                    <div class="col-md-7 mb-5">
                                        <input type="text" class="form-control" name="FACEBOOK_CLIENT_ID"
                                            value="{{ env('FACEBOOK_CLIENT_ID') }}"
                                            placeholder="{{ translate('Facebook Client ID') }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="FACEBOOK_CLIENT_SECRET">
                                    <div class="col-lg-3">
                                        <label class="col-from-label">{{ translate('App Secret') }}</label>
                                    </div>
                                    <div class="col-md-7 mb-5">
                                        <input type="text" class="form-control" name="FACEBOOK_CLIENT_SECRET"
                                            value="{{ env('FACEBOOK_CLIENT_SECRET') }}"
                                            placeholder="{{ translate('Facebook Client Secret') }}" required>
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

            <div class="row g-5 g-xl-8 mt-5">
                <div class="col-md-6">
                    <div class="card card-flush">
                        <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                            <h5 class="mb-0 h6">{{ translate('Twitter Login Credential') }}</h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="TWITTER_CLIENT_ID">
                                    <div class="col-lg-3">
                                        <label class="col-from-label">{{ translate('Client ID') }}</label>
                                    </div>
                                    <div class="col-md-7 mb-5">
                                        <input type="text" class="form-control" name="TWITTER_CLIENT_ID"
                                            value="{{ env('TWITTER_CLIENT_ID') }}"
                                            placeholder="{{ translate('Twitter Client ID') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="TWITTER_CLIENT_SECRET">
                                    <div class="col-lg-3">
                                        <label class="col-from-label">{{ translate('Client Secret') }}</label>
                                    </div>
                                    <div class="col-md-7 mb-5">
                                        <input type="text" class="form-control" name="TWITTER_CLIENT_SECRET"
                                            value="{{ env('TWITTER_CLIENT_SECRET') }}"
                                            placeholder="{{ translate('Twitter Client Secret') }}" required>
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
