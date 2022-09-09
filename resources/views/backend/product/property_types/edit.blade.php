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
                        {{ translate('Property Type Information') }}</h1>
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
                        <li class="breadcrumb-item text-muted">Property</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Property Type</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">Edit Property Type</li>
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
                                href="{{ route('property_type.edit', ['id' => $property_type->id, 'lang' => $language->code]) }}">
                                <img src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}" height="11"
                                    class="mr-1">
                                <span>{{ $language->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <br>
                <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10"
                    action="{{ route('property_type.update', $property_type->id) }}" method="POST" enctype="multipart/form-data">
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
                                        class="form-control mb-2" value="{{ $property_type->getTranslation('name', $lang) }}"
                                        required>
                                    <div class="text-muted fs-7">A property_type name is required and recommended to be unique.
                                    </div>

                                </div>

                                <!--begin::Input group-->
                                <div class="fv-row mb-2">
                                    <label for="kt_ecommerce_add_product_store_template"
                                        class="form-label">{{ translate('Parent Property Type') }}</label>
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                        data-placeholder="Select an option" id="parent_id" name="parent_id"
                                        data-live-search="true">
                                        <option value="0">{{ translate('No Parent') }}</option>
                                        @foreach ($property_types as $aproperty_type)
                                            <option value="{{ $aproperty_type->id }}" @if ($property_type->parent_id == $aproperty_type->id) selected @endif>
                                                {{ $aproperty_type->getTranslation('name') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end::Card header-->
                        </div>

                        <!--begin::Media-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h3>Media</h3>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="fv-row mb-2">
                                    <label class="form-label">{{ translate('Icon') }} <b>(120 x 120)</b></label>
                                    <!--begin::Dropzone-->
                                    <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                        data-toggle="aizuploader" data-type="image" >
                                        <!--begin::Message-->
                                        <div class="dz-message needsclick">
                                            <!--begin::Icon-->
                                            <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                            <!--end::Icon-->
                                            <!--begin::Info-->
                                            <input type="hidden" name="icon" class="selected-files"
                                                value="{{ $property_type->icon }}">
                                            <div class="ms-4">
                                                <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Drop files here or click to
                                                    upload.</h3>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                    </div>
                                    <!--end::Dropzone-->
                                    <div class="file-preview box sm">
                                    </div>


                                </div>
                                <div class="text-muted fs-7">
                                    {{ translate('These images are visible in Property Type Page Icon. Use 300x174 sizes images.') }}
                                </div>

                                <div class="fv-row mb-2">
                                    <label class="form-label">{{ translate('Small Banner') }} <b>(768 x 450)</b></label>
                                    <!--begin::Dropzone-->
                                    <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                        data-toggle="aizuploader" data-type="image" >
                                        <!--begin::Message-->
                                        <div class="dz-message needsclick">
                                            <!--begin::Icon-->
                                            <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                            <!--end::Icon-->
                                            <!--begin::Info-->
                                            <input type="hidden" name="small_banner" class="selected-files"
                                                value="{{ $property_type->small_banner }}">
                                            <div class="ms-4">
                                                <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Drop files here or click to
                                                    upload.</h3>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                    </div>
                                    <!--end::Dropzone-->
                                    <div class="file-preview box sm">
                                    </div>


                                </div>
                                <div class="text-muted fs-7">
                                    {{ translate('These images are visible in Property Type Page Icon. Use 768 x 450 sizes images.') }}
                                </div>

                                <div class="fv-row mt-5 mb-2">
                                    <label class="form-label">{{ translate('Banner') }} <b>(3168 x 470)</b></label>
                                    <!--begin::Dropzone-->
                                    <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                        data-toggle="aizuploader" data-type="image" >
                                        <!--begin::Message-->
                                        <div class="dz-message needsclick">
                                            <!--begin::Icon-->
                                            <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                            <!--end::Icon-->
                                            <!--begin::Info-->
                                            <input type="hidden" name="banner" class="selected-files"
                                                value="{{ $property_type->banner }}">
                                            <div class="ms-4">
                                                <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Drop files here or click to
                                                    upload.</h3>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                    </div>
                                    <!--end::Dropzone-->
                                    <div class="file-preview box sm">
                                    </div>


                                </div>
                                <div class="text-muted fs-7">
                                    {{ translate('These images are visible in Property Type Page banner. Use 3168x470 sizes images.') }}
                                </div>
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::Media-->
                        <!--end::General options-->
                        <!--begin::Meta options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{ translate('Meta Options') }}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label">{{ translate('Meta Title') }}</label>
                                    <input type="text" class="form-control mb-2" name="meta_title"
                                        value="{{ $property_type->meta_title }}"
                                        placeholder="{{ translate('Meta Title') }}" />
                                    <div class="text-muted fs-7">Set a meta tag title. Recommended to be simple and precise
                                        keywords.</div>
                                </div>
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label">{{ translate('Meta Description') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <textarea name="meta_description" rows="5"
                                        class="form-control mb-2">{{ $property_type->meta_description }}</textarea>
                                    <!--end::Editor-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set a meta tag description to the property_type for increased
                                        SEO ranking.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Input group-->
                                <div class="mb-10">
                                    <label class="form-label">{{ translate('Slug') }}</label>
                                    <input type="text" class="form-control mb-2" placeholder="{{ translate('Slug') }}"
                                        id="slug" name="slug" value="{{ $property_type->slug }}" />
                                </div>
                            </div>
                            <!--end::Card header-->
                        </div>

                    </div>
                    <!--end::Main column-->
                    <!--begin::Aside column-->
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px">

                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{ translate('Ordering Number') }}</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <input type="number" name="order_level" class="form-control mb-2" id="order_level"
                                    placeholder="{{ translate('Order Level') }}" value="{{ $property_type->order_level }}">
                                <div class="text-muted fs-7">{{ translate('Higher number has high priority') }}</div>
                            </div>
                        </div>

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
                                <label for="kt_ecommerce_add_property_type_store_template"
                                    class="form-label">{{ translate('Property Type') }}</label>
                                <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                    data-placeholder="Select an option" id="kt_ecommerce_add_property_type_store_template"
                                    name="digital" required>
                                    <option value="0" @if ($property_type->digital == '0') selected @endif>{{ translate('Physical') }}</option>
                                    <option value="1" @if ($property_type->digital == '1') selected @endif>{{ translate('Digital') }}</option>
                                </select>
                            </div>
                        </div>

                        @if (get_setting('property_type_wise_commission') == 1)
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
                                        value="{{ $property_type->commision_rate }}">
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
