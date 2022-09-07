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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Pages</h1>
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
                    <li class="breadcrumb-item text-muted">Website Setup</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Page Create</li>
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
            <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10" action="{{ route('custom-pages.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf

                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin::General options-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ translate('Page Content') }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="mb-5 fv-row">
                                <label class="required form-label">{{ translate('Title') }}</label>
                                <input type="text" placeholder="{{ translate('Title') }}" id="title" name="title"
                                    class="form-control mb-2" required>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <div class="mb-5 fv-row">
                                <label class="required form-label">{{ translate('Link') }}</label>
                                <div class="input-group d-block d-md-flex">
                                    <div class="input-group-prepend "><span
                                            class="input-group-text flex-grow-1">{{ route('home') }}/</span></div>
                                    <input type="text" class="form-control w-100 w-md-auto"
                                        placeholder="{{ translate('Slug') }}" name="slug" required>
                                </div>
                                <small
                                    class="form-text text-muted">{{ translate('Use character, number, hypen only') }}</small>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <div class="mb-5 fv-row">
                                <label class="required form-label">{{ translate('Add Content') }}</label>
                                <textarea class="aiz-text-editor" placeholder="Content.." data-min-height="300"
                                    name="content" required></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ translate('Seo Fields') }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="mb-5 fv-row">
                                <label class="form-label">{{ translate('Meta Title') }}</label>
                                <input type="text" placeholder="{{ translate('Meta Title') }}" id="meta_title"
                                    name="meta_title" class="form-control mb-2">
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <div class="mb-5 fv-row">
                                <label class="form-label">{{ translate('Meta Description') }}</label>
                                <textarea class="form-control" placeholder="{{ translate('Description') }}"
                                    data-min-height="300" name="meta_description"></textarea>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <div class="mb-5 fv-row">
                                <label class="form-label">{{ translate('Keywords') }}</label>
                                <textarea class="form-control" placeholder="{{ translate('Keyword, Keyword') }}"
                                    data-min-height="300" name="keywords"></textarea>
                                <span class="fw-bolder mb-1">{{ translate('Separate with coma') }}.</span>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <div class="fv-row mb-5">
                                <label class="form-label">{{ translate('Meta Image') }}</label>
                                <!--begin::Dropzone-->
                                <div class="dropzone" id="kt_ecommerce_add_product_mediaa" data-toggle="aizuploader"
                                    data-type="image">
                                    <!--begin::Message-->
                                    <div class="dz-message needsclick">
                                        <!--begin::Icon-->
                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                        <!--end::Icon-->
                                        <!--begin::Info-->
                                        <input type="hidden" name="meta_image" class="selected-files">
                                        <div class="ms-4">
                                            <h3 class="fs-5 fw-bolder text-gray-900 mb-1">
                                                {{ translate('Drop files here or click
                                                											to upload') }}.</h3>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                </div>
                                <!--end::Dropzone-->
                                <div class="file-preview box sm">
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                            <span class="indicator-label">{{ translate('Save Changes') }}</span>
                            <span class="indicator-progress">{{ translate('Please wait') }}...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Main column-->
                </div>
            </form>
            <!--end::Container-->
        </div>
    </div>
    <!--end::Post-->
</div>

@endsection
