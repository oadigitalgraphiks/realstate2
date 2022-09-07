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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Profile</h1>
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
                    <li class="breadcrumb-item text-dark">Profile</li>
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
            <div class="col-lg-6  mx-auto">
                <div class="card card-flush">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <h5 class="mb-0 h6">{{translate('Profile')}}</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PATCH">
                            @csrf
                            <div class="row mb-2">
                                <label class="col-sm-3 col-from-label" for="name">{{translate('Name')}}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="{{translate('Name')}}" name="name" value="{{ Auth::user()->name }}" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-3 col-from-label" for="name">{{translate('Email')}}</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" placeholder="{{translate('Email')}}" name="email" value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-3 col-from-label" for="new_password">{{translate('New Password')}}</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" placeholder="{{translate('New Password')}}" name="new_password">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-sm-3 col-from-label" for="confirm_password">{{translate('Confirm Password')}}</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" placeholder="{{translate('Confirm Password')}}" name="confirm_password">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Avatar')}} <small>(90x90)</small></label>
                                <div class="col-md-9">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                        <input type="hidden" name="avatar" class="selected-files" value="{{ Auth::user()->avatar_original }}">
                                    </div>
                                    <div class="file-preview box sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
