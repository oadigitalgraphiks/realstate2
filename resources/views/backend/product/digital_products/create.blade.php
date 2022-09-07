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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                        {{ translate('New Digital Product') }}</h1>
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
                        <li class="breadcrumb-item text-dark">{{ translate('Add New Digital Product') }}</li>
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
                <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10"
                action="{{route('digitalproducts.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="added_by" value="admin">
                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <div class="row g-5 g-xl-8">
                            <div class="g-5 col-xl-8">
                                <!--begin::General options-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{ translate('General') }}</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label">{{ translate('Product Name') }}</label>
                                            <input type="text" placeholder="{{ translate('Name') }}" id="name"
                                                name="name" class="form-control mb-2" required>
                                        </div>

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-2">
                                            <label for="kt_ecommerce_add_product_store_template"
                                                class="form-label">{{ translate('Category') }}</label>
                                            <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                                data-placeholder="Select an option" id="category_id" name="category_id"
                                                data-live-search="true">
                                                <option value="0">{{ translate('No Category Select') }}</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->getTranslation('name') }}
                                                    </option>
                                                    @foreach ($category->childrenCategories as $childCategory)
                                                        @include('categories.child_category', ['child_category' =>
                                                        $childCategory])
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-5 fv-row">
                                            <label class="form-label">{{ translate('Tags') }}</label>
                                            <input id="kt_ecommerce_add_product_tags" class="form-control mb-2"
                                                name="tags[]"
                                                placeholder="{{ translate('Type & hit enter to add a tag') }}" >
                                            <div class="text-muted fs-7">
                                                {{ translate('This is used for search. Input those words by which customer can find this product.') }}
                                            </div>
                                        </div>
                                        <!--begin::Discount options-->
                                        <div class="card-title">
                                            <h3>{{ translate('Discount') }}</h3>
                                        </div>
                                        <div class="d-flex flex-wrap gap-5">

                                            <div class="mb-6 fv-row">
                                                <label class="required form-label"
                                                    for="start_date">{{ translate('Discount Date Range') }}</label>
                                                <input type="text" class="form-control aiz-date-range mb-2"
                                                    name="date_range" placeholder="{{ translate('Select Date') }}"
                                                    data-time-picker="true" data-format="DD-MM-Y HH:mm:ss"
                                                    data-separator=" to " autocomplete="off">
                                            </div>

                                            <!--begin::Input group-->

                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">{{ translate('Discount Type') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Select2-->
                                                <select class="form-select mb-2" name="discount_type" data-control="select2"
                                                    data-hide-search="true" data-placeholder="Select an option">
                                                    <option value="amount">{{ translate('Flat') }}</option>
                                                    <option value="percent" >{{ translate('Percent') }}</option>
                                                </select>
                                                <!--end::Select2-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">{{translate('Set the product discount type')}}.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">{{translate('Discount Amount')}} (%)</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="number" lang="en" min="0"
                                                step="0.01" placeholder="{{ translate('Discount') }}" name="discount" class="form-control mb-2" required>
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">
                                                    {{ translate('Set the product VAT about') }}.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end:Discount-->
                                        <!--end::Row-->
                                        <!--end::Input group-->
                                    </div>

                                    <!--begin::Meta options-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>{{ translate('Product Information') }}</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label">{{ translate('Description') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="aiz-text-editor" name="description"></textarea>
                                                {{-- <div id="kt_ecommerce_add_product_description" name="description"
                                                    class="min-h-100px mb-2"></div> --}}
                                                <!--end::Editor-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--begin::Row-->

                                    <!--begin::Media-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3>{{ translate('Media') }}</h3>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-2">
                                                <label class="form-label">{{ translate('Product File') }}</label>
                                                <!--begin::Dropzone-->
                                                <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                                    data-toggle="aizuploader">
                                                    <!--begin::Message-->
                                                    <div class="dz-message needsclick">
                                                        <!--begin::Icon-->
                                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                        <!--end::Icon-->
                                                        <!--begin::Info-->
                                                        <input type="hidden" name="file" class="selected-files">
                                                        <div class="ms-4">
                                                            <h3 class="fs-5 fw-bolder text-gray-900 mb-1">
                                                                {{ translate('Click to upload') }}.
                                                            </h3>
                                                            <span
                                                                class="fs-7 fw-bold text-gray-400">{{ translate('Upload File') }}</span>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                </div>
                                                <!--end::Dropzone-->
                                                <div class="file-preview box sm">
                                                </div>
                                            </div>
                                            <div class="fv-row mt-5 mb-2">
                                                <label class="form-label">{{ translate('Images') }}</label>
                                                <!--begin::Dropzone-->
                                                <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                                    data-toggle="aizuploader" data-type="image" data-multiple="true">
                                                    <!--begin::Message-->
                                                    <div class="dz-message needsclick">
                                                        <!--begin::Icon-->
                                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                        <!--end::Icon-->
                                                        <!--begin::Info-->
                                                        <input type="hidden" name="photos" class="selected-files">
                                                        <div class="ms-4">
                                                            <h3 class="fs-5 fw-bolder text-gray-900 mb-1">
                                                                {{ translate('Click to upload') }}.
                                                            </h3>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                </div>
                                                <!--end::Dropzone-->
                                                <div class="file-preview box sm">
                                                </div>


                                            </div>
                                            <div class="fv-row mt-5 mb-2">
                                                <label class="form-label">{{ translate('Thumbnail Image') }}
                                                    (290x300)</label>
                                                <!--begin::Dropzone-->
                                                <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                                    data-toggle="aizuploader" data-type="image">
                                                    <!--begin::Message-->
                                                    <div class="dz-message needsclick">
                                                        <!--begin::Icon-->
                                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                        <!--end::Icon-->
                                                        <!--begin::Info-->
                                                        <input type="hidden" name="thumbnail_img" class="selected-files">
                                                        <div class="ms-4">
                                                            <h3 class="fs-5 fw-bolder text-gray-900 mb-1">
                                                                {{ translate('Click to upload') }}.
                                                            </h3>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                </div>
                                                <!--end::Dropzone-->
                                                <div class="file-preview box sm">
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::Media-->

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
                                                <!--begin::Label-->
                                                <label class="form-label">{{ translate('Meta Title') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control mb-2" name="meta_title"
                                                    placeholder="{{ translate('Meta Title') }}"/>
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">
                                                    {{ translate('Set a meta tag title. Recommended to be simple and
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            precise keywords.') }}
                                                </div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label
                                                    class="form-label">{{ translate('Meta Description') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea name="meta_description" rows="5"
                                                    class="form-control mb-2"></textarea>
                                                <!--end::Editor-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">{{translate("Set a meta tag description to the category for
                                                    increased SEO ranking")}}.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <div class="fv-row mt-5 mb-2">
                                                <label class="form-label">{{ translate('Meta Image') }}</label>
                                                <!--begin::Dropzone-->
                                                <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                                    data-toggle="aizuploader" data-type="image">
                                                    <!--begin::Message-->
                                                    <div class="dz-message needsclick">
                                                        <!--begin::Icon-->
                                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                        <!--end::Icon-->
                                                        <!--begin::Info-->
                                                        <input type="hidden" name="meta_img" class="selected-files">
                                                        <div class="ms-4">
                                                            <h3 class="fs-5 fw-bolder text-gray-900 mb-1">
                                                                {{ translate('Click to upload') }}.
                                                            </h3>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                </div>
                                                <!--end::Dropzone-->
                                                <div class="file-preview box sm">
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                    </div>

                                    <div class="d-flex justify-content-end">

                                        <button type="submit" id="kt_ecommerce_add_category_submit"
                                            class="btn btn-primary">
                                            <span class="indicator-label">{{ translate('Save') }}</span>
                                            <span class="indicator-progress">{{translate('Please wait')}}...
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                </div>
                                <!--end::Main column-->
                            </div>
                            <div class="g-5 col-xl-4">
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{ translate('Price') }}</h2>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-5 fv-row">
                                            <label class="required form-label">{{ translate('Unit price') }}</label>
                                            <input type="number" lang="en" min="0" step="0.01"
                                                placeholder="{{ translate('Unit price') }}" id="unit_price"
                                                name="unit_price" class="form-control mb-2" required>
                                        </div>

                                        <div class="mb-5 fv-row">
                                            <label class="required form-label">{{ translate('Purchase price') }}</label>
                                            <input type="number" lang="en" min="0" step="0.01"
                                                placeholder="{{ translate('Purchase price') }}" id="purchase_price"
                                                name="purchase_price" class="form-control mb-2" required>
                                        </div>

                                        {{-- @foreach (\App\Models\Tax::where('tax_status', 1)->get() as $tax) --}}
                                        <div class="card-title">
                                            <h3>{{ translate('Tax') }}</h3>
                                        </div>
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->

                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ translate('Tax Type') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Select2-->
                                                <select class="form-select mb-2" name="tax_type" data-control="select2"
                                                    data-hide-search="true" data-placeholder="Select an option">
                                                    <option value="amount" >{{ translate('Flat') }}</option>
                                                    <option value="percent" >{{ translate('Percent') }}</option>
                                                </select>
                                                <!--end::Select2-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Set the product tax type.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="form-label">VAT Amount (%)</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="number" lang="en" min="0" step="0.01" placeholder="{{ translate('Tax') }}" name="tax" class="form-control mb-2" required>
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">
                                                    {{ translate('Set the product VAT about') }}.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end:Tax-->

                                        {{-- @endforeach --}}

                                    </div>
                                    <!--end::Card header-->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Container-->
            </div>
            <!--end::Post-->
        </div>
    </div>
@endsection

@section('script')

    <script src="{{ static_asset('assets/backend/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ static_asset('assets/backend/js/custom/apps/ecommerce/catalog/save-product.js') }}"></script>

@endsection
