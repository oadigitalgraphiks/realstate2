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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Admin Menus</h1>
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
                    <li class="breadcrumb-item text-muted">Sellers</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">{{translate('Menu Information')}}</li>
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
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card card-flush py-4">
                        <div class="card-body p-0">
                            <form class="p-4" action="{{ route('admin_menu.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-2">
                                    <label for="kt_ecommerce_add_product_store_template" class="form-label">{{ translate('Parent Menu') }}</label>
                                    <div class="">
                                        <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                        data-placeholder="Select an option" id="parent_id" name="parent_id"
                                        data-live-search="true">
                                            <option value="0">{{ translate('No Parent') }}</option>
                                            @foreach ($admin_menus as $admin_menu)
                                                <option value="{{ $admin_menu->id }}">{{ $admin_menu->getTranslation('name') }}</option>
                                                @foreach ($admin_menu->childrens as $sub_menu)
                                                    <option value="{{ $sub_menu->id }}">- {{ $sub_menu->getTranslation('name') }}</option>
                                                    @foreach ($sub_menu->childrens as $sub_menu2)
                                                        <option disabled value="{{ $sub_menu2->id }}">-- {{ $sub_menu2->getTranslation('name') }}</option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label for="kt_ecommerce_add_product_store_template" class="form-label">{{ translate('Name') }}</label>
                                    <div class="">
                                        <input type="text" placeholder="{{translate('Name')}}" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label for="kt_ecommerce_add_product_store_template" class="form-label">{{ translate('Icon Class') }}</label>
                                    <div class="">
                                        <textarea type="text" placeholder="{{translate('Icon Class')}}" name="icon_class" class="form-control" rows="5">
                                        </textarea>
                                        <div class="text-danger mt-2 fw-bold text-center">
                                            <span>* {{translate("Leave an empty if save as child menu")}} *</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label for="kt_ecommerce_add_product_store_template" class="form-label">{{ translate('Addon Name') }}</label>
                                    <div class="">
                                        <input type="text" placeholder="{{translate('Addon Name')}}" name="addon_name" class="form-control">
                                        <div class="text-danger mt-2 fw-bold text-center">
                                            <span>* If you have installed the addon then write its <b><u>Unique Identifier</u></b> here otherwise keep its name empty. *</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label for="kt_ecommerce_add_product_store_template" class="form-label">{{ translate('Route') }}</label>
                                    <div class="">
                                        <input type="text" placeholder="{{translate('Route')}}" name="route" class="form-control">
                                        <div class="text-danger mt-2 fw-bold text-center">
                                            <span>* Leave an empty if this menu will have childrens *</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label for="kt_ecommerce_add_product_store_template" class="form-label">{{ translate('Sort') }}</label>
                                    <div class="">
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
    </div>

</div>


@endsection
