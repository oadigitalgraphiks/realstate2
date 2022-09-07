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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Pick-up Points
                </h1>
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
                    <li class="breadcrumb-item text-dark">Pick-up Point Create</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <div class="row g-5 g-xl-8">
        <div class="col-xl-8 mx-auto">
            <div class="card card-flush">
                <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                    <h5 class="mb-0 h6">{{ translate('Pickup Point Information') }}</h5>
                </div>
                <form action="{{ route('pick_up_points.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row mb-5">
                            <label class="col-sm-3 col-from-label" for="name">{{ translate('Name') }}</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="{{ translate('Name') }}" id="name" name="name"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-sm-3 col-from-label" for="address">{{ translate('Location') }}</label>
                            <div class="col-sm-9">
                                <textarea name="address" rows="8" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-sm-3 col-from-label" for="phone">{{ translate('Phone') }}</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="{{ translate('Phone') }}" id="phone" name="phone"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-sm-3 col-from-label">{{ translate('Pickup Point Status') }}</label>
                            <div class="col-sm-3">
                                <label
                                    class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input class="form-check-input" value="1" type="checkbox" name="pick_up_status">
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-sm-3 col-from-label"
                                for="name">{{ translate('Pick-up Point Manager') }}</label>
                            <div class="col-sm-9">
                                <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                    data-placeholder="Select an option" name="staff_id" data-live-search="true" required>
                                    {{-- <select name="staff_id" class="form-control aiz-selectpicker" required> --}}
                                    @foreach (\App\Models\Staff::all() as $staff)
                                        @if ($staff->user != null)
                                            <option value="{{ $staff->id }}">{{ $staff->user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
