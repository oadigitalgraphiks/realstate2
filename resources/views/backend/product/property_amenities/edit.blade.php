@extends('backend.layouts.app')

@section('content')

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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                        {{ translate('Property Tour Types Information') }}</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Products</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Property Tour Types</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">Edit Property Tour Types</li>
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
                <!--begin::Post-->
                <ul class="nav nav-tabs nav-fill border-light">
                    @foreach (\App\Models\Language::all() as $key => $language)
                        <li class="nav-item">
                            <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"
                                href="{{ route('property_amenities.edit', ['id' => $property_amenity->id, 'lang' => $language->code]) }}">
                                <img src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}" height="11"
                                    class="mr-1">
                                <span>{{ $language->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <br>
                <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10"
                    action="{{ route('property_amenities.update', $property_amenity->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input name="_method" type="hidden" value="PATCH">
                    <input type="hidden" name="lang" value="{{ $lang }}">
                    @csrf
                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>General</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-5 fv-row">
                                    <label class="required form-label">{{ translate('Property Type Name') }}</label>
                                    <input type="text" placeholder="{{ translate('Name') }}" id="name" name="name"
                                        class="form-control mb-2" value="{{ $property_amenity->getTranslation('name', $lang) }}"
                                        required>
                                    <div class="text-muted fs-7">A property purpose name is required and recommended to be unique.
                                    </div>

                                </div>
                            </div>
                            <!--end::Card header-->
                        </div>

                    </div>
                    <!--end::Main column-->
                    <!--begin::Aside column-->
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px">

                        <div class="card card-flush py-4 d-none">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>{{ translate('Type') }}</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Select store template-->
                                <label for="kt_ecommerce_add_property_amenity_store_template"
                                    class="form-label">{{ translate('Property Tour Type') }}</label>
                                <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                    data-placeholder="Select an option" id="kt_ecommerce_add_property_amenity_store_template"
                                    name="digital" required>
                                    <option value="0" @if ($property_amenity->digital == '0') selected @endif>{{ translate('Physical') }}</option>
                                    <option value="1" @if ($property_amenity->digital == '1') selected @endif>{{ translate('Digital') }}</option>
                                </select>
                            </div>
                        </div>

                        @if (get_setting('property_amenity_wise_commission') == 1)
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{ translate('Commission Rate') }}</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <input type="number" lang="en" min="0" step="0.01"
                                        placeholder="{{ translate('Commission Rate') }}" id="commision_rate"
                                        name="commision_rate" class="form-control"
                                        value="{{ $property_amenity->commision_rate }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    {{-- <div class="text-muted fs-7">{{translate('Higher number has high priority')}}</div> --}}
                                </div>
                            </div>
                        @endif
                        <div class="card card-flush py-4 d-none">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3>{{ translate('Filtering Attributes') }}</h3>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <label for="kt_ecommerce_add_product_store_template"
                                    class="form-label">{{ translate('Filtering Attributes') }}</label>
                                <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                    data-placeholder="Select an option" id="kt_ecommerce_add_product_store_template"
                                    name="filtering_attributes[]">
                                    @foreach (\App\Models\Attribute::all() as $attribute)
                                        <option value="{{ $attribute->id }}">{{ $attribute->getTranslation('name') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">

                            <button type="submit" id="kt_ecommerce_add_property_type_submit" class="btn btn-primary">
                                <span class="indicator-label">{{ translate('Update Changes') }}</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                    <!--end::Aside column-->

                </form>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>



@endsection
@section('script')
    <script src="{{ static_asset('assets/backend/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ static_asset('assets/backend/js/custom/apps/ecommerce/catalog/save-category.js') }}"></script>
@endsection
