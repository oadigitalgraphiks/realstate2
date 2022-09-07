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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Permission</h1>
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
                    <li class="breadcrumb-item text-dark">Permission Create</li>
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
    <div class="col-lg-8 mx-auto">
        <div class="card card-flush py-2">
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <h5 class="mb-0 h6">{{translate('Permission Information')}}</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('permission.store') }}" method="POST">
                	@csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Menu')}}</label>
                        <div class="col-md-9">
                            <select class="form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Select an option" id="admin_menu_id" name="admin_menu_id" data-live-search="true">
                                <option value="0">{{ translate('No Parent') }}</option>
                                @foreach ($admin_menus as $admin_menu)
                                    <option value="{{ $admin_menu->id }}">{{ $admin_menu->getTranslation('name') }}</option>
                                    @foreach ($admin_menu->childrens as $sub_menu)
                                        <option value="{{ $sub_menu->id }}">- {{ $sub_menu->getTranslation('name') }}</option>
                                        @foreach ($sub_menu->childrens as $sub_menu2)
                                             <option value="{{ $sub_menu2->id }}">-- {{ $sub_menu2->getTranslation('name') }}</option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                            {{-- <select class="form-control aiz-selectpicker" data-live-search="true" name="admin_menu_id" required>
                                <option value="">Please Select</option>
                                @foreach ($admin_menus as $admin_menu)
                                    <option value="{{ $admin_menu->id }}">{{ $admin_menu->getTranslation('name') }}</option>
                                    @foreach ($admin_menu->childrens as $sub_menu)
                                        <option value="{{ $sub_menu->id }}">- {{ $sub_menu->getTranslation('name') }}</option>
                                        @foreach ($sub_menu->childrens as $sub_menu2)
                                             <option value="{{ $sub_menu2->id }}">-- {{ $sub_menu2->getTranslation('name') }}</option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select> --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Name')}}</label>
                        <div class="col-md-9 mb-2">
                            <input type="text" placeholder="{{translate('Name')}}" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Route')}}</label>
                        <div class="col-md-9 mb-2">
                            <input required type="text" placeholder="{{translate('Route')}}" name="route" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Sort')}}</label>
                        <div class="col-md-9 mb-2">
                            <input required type="number" min="1" placeholder="{{translate('Sort')}}" name="sort" class="form-control">
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
@endsection
