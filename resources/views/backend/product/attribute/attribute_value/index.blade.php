@extends('backend.layouts.app')

@section('content')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Attribute Values</h1>
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
                        <li class="breadcrumb-item text-muted">Catalog</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">Attribute Values</li>
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
        <div class="row g-5 g-xl-8">
            <div class="g-5 col-xl-6">
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="container-xxl">
                        <!--begin::Products-->
                        <div class="card card-flush">
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5"
                                    id="kt_ecommerce_products_table">
                                    <!--begin::Table head-->
                                    <thead>
                                        <!--begin::Table row-->
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="min-w-auto text-center">#</th>
                                            <th class="min-w-auto">{{ translate('Value') }}</th>
                                            <th class="text-end min-w-auto">{{ translate('Options') }}</th>
                                        </tr>
                                        <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                        <!--begin::Table row-->
                                        @foreach ($all_attribute_values as $key => $attribute_value)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-5">
                                                            <!--begin::Title-->
                                                            {{$key+1}}
                                                            <!--end::Title-->
                                                        </div>
                                                    </div>
                                                </td>
                                                <!--begin::Category=-->
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-5">
                                                            <!--begin::Title-->
                                                            <a href="{{ route('edit-attribute-value', ['id' => $attribute_value->id]) }}"
                                                                class="text-gray-800 text-hover-primary fs-5 fw-bolder"
                                                                data-kt-ecommerce-product-filter="product_name">{{ $attribute_value->value }}</a>
                                                            <!--end::Title-->
                                                        </div>
                                                    </div>
                                                </td>
                                                <!--end::Category=-->
                                                <!--begin::Action=-->
                                                <td class="text-end">
                                                    <div class="text-end">
                                                        <a href="{{ route('edit-attribute-value', ['id' => $attribute_value->id]) }}"
                                                            class="menu-link px-3">
                                                            <div class="badge badge-light-success">{{ translate('Edit') }}</div>
                                                        </a>
                                                        <a href="{{route('destroy-attribute-value', $attribute_value->id)}}"
                                                            class="menu-link px-3" data-kt-ecommerce-product-filter="delete_row">
                                                            <div class="badge badge-light-danger">{{ translate('Delete') }}</div>
                                                        </a>
                                                    </div>
                                                </td>
                                                <!--end::Action=-->
                                            </tr>
                                        @endforeach
                                        <!--end::Table row-->
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Products-->
                    </div>
                    <!--end::Container-->
                </div>
            </div>
            <div class="g-5 g-xl-8 px-10 col-xl-6">
                <!--begin::Main column-->
                <form action="{{ route('store-attribute-value') }}" method="POST">
                    @csrf
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{ translate('Add New Attribute Value') }}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{ translate('Attribute Name') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="hidden" name="attribute_id" value="{{ $attribute->id }}">
                                    <input type="text" name="name" class="form-control mb-2" placeholder="Attribute name"
                                        value="{{ $attribute->name }}" readonly/>
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">
                                        {{ translate('A attribute name is required and recommended to be unique.') }}
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">{{ translate('Attribute Value') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="value" class="form-control mb-2" placeholder="Attribute Value"
                                        value="" required />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">
                                        {{ translate('A attribute name is required and recommended to be unique.') }}
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::General options-->
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                <span class="indicator-label">{{ translate('Save Changes') }}</span>
                                <span class="indicator-progress">{{ translate('Please wait') }}...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                </form>
                <!--end::Main column-->
            </div>
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->


@endsection


@section('modal')
@include('modals.delete_modal')
@endsection
