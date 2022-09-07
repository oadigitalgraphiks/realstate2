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
                        {{ translate('Category Information') }}</h1>
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
                        <li class="breadcrumb-item text-dark">Add Category</li>
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
                <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10" action="{{ route('categories.store') }}"
                    method="POST" enctype="multipart/form-data">
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
                                    <label class="required form-label">{{ translate('Category Name') }}</label>
                                    <input type="text" placeholder="{{ translate('Name') }}" id="name" name="name"
                                        class="form-control mb-2" required>
                                    <div class="text-muted fs-7">A category name is required and recommended to be unique.
                                    </div>

                                </div>

                                <!--begin::Input group-->
                                <div class="fv-row mb-2">
                                    <label for="kt_ecommerce_add_product_store_template"
                                        class="form-label">{{ translate('Parent Category') }}</label>
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                        data-placeholder="Select an option" id="parent_id" name="parent_id"
                                        data-live-search="true">
                                        <option value="0">{{ translate('No Parent') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->getTranslation('name') }}
                                            </option>
                                            @foreach ($category->childrenCategories as $childCategory)
                                                @include('categories.child_category', ['child_category' => $childCategory])
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
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
                                            data-toggle="aizuploader" data-type="image">
                                            <!--begin::Message-->
                                            <div class="dz-message needsclick">
                                                <!--begin::Icon-->
                                                <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                <!--end::Icon-->
                                                <!--begin::Info-->
                                                <input type="hidden" name="icon" class="selected-files">
                                                <div class="ms-4">
                                                    <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Drop files here or click
                                                        to upload.</h3>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                        </div>
                                        <!--end::Dropzone-->
                                        <div class="file-preview box sm">
                                        </div>


                                    </div>
                                    <div class="text-muted fs-7">
                                        {{ translate('These images are visible in Category Page Icon. Use 300 x 174 sizes images.') }}
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
                                                <input type="hidden" name="small_banner" class="selected-files">
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
                                        {{ translate('These images are visible in Category Page Icon. Use 768 x 450 sizes images.') }}
                                    </div>

                                    <div class="fv-row mt-5 mb-2">
                                        <label class="form-label">{{ translate('Banner') }} <b>(3168 x 470)</b></label>
                                        <!--begin::Dropzone-->
                                        <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                            data-toggle="aizuploader" data-type="image">
                                            <!--begin::Message-->
                                            <div class="dz-message needsclick">
                                                <!--begin::Icon-->
                                                <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                <!--end::Icon-->
                                                <!--begin::Info-->
                                                <input type="hidden" name="banner" class="selected-files">
                                                <div class="ms-4">
                                                    <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Drop files here or click
                                                        to upload.</h3>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                        </div>
                                        <!--end::Dropzone-->
                                        <div class="file-preview box sm">
                                        </div>


                                    </div>
                                    <div class="text-muted fs-7">
                                        {{ translate('These images are visible in Category Page banner. Use (3168 x 470) sizes images.') }}
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
                                        <!--begin::Label-->
                                        <label class="form-label">{{ translate('Meta Title') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control mb-2" name="meta_title"
                                            placeholder="{{ translate('Meta Title') }}" />
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Set a meta tag title. Recommended to be simple and
                                            precise keywords.</div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label">{{ translate('Meta Description') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <textarea name="meta_description" rows="5" class="form-control mb-2"></textarea>
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Set a meta tag description to the category for
                                            increased SEO ranking.</div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Input group-->

                                </div>
                                <!--end::Card header-->
                            </div>
                            <div class="d-flex justify-content-end">

                                <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                    <span class="indicator-label">{{ translate('Save Changes') }}</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
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
                                        placeholder="{{ translate('Order Level') }}">
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
                                    <label for="kt_ecommerce_add_category_store_template"
                                        class="form-label">{{ translate('Category Type') }}</label>
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                        data-placeholder="Select an option" id="kt_ecommerce_add_category_store_template"
                                        name="digital">
                                        <option value="0">{{ translate('Physical') }}</option>
                                        <option value="1">{{ translate('Digital') }}</option>
                                    </select>
                                </div>
                            </div>

                            @if (get_setting('category_wise_commission') == 1)
                                <div class="card card-flush py-4">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{ translate('Commission Rate') }}</h2>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <input type="number" lang="en" min="0" step="0.01"
                                            placeholder="{{ translate('Commission Rate') }}" id="commision_rate"
                                            name="commision_rate" class="form-control">
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
                                            <option value="{{ $attribute->id }}">
                                                {{ $attribute->getTranslation('name') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--end::Aside column-->

                    </div>
                </form>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>

@endsection
@section('script')
    <script src="{{ static_asset('assets/backend/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ static_asset('assets/backend/js/custom/apps/ecommerce/catalog/save-category.js') }}"></script>
@endsection
