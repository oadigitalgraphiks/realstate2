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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Blog Edit</h1>
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
                    <li class="breadcrumb-item text-muted">Blogs</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Blog Edit</li>
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
            <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10" action="{{ route('blog.update',$blog->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin::General options-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{translate('Blog Information')}}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <div class="mb-5 fv-row">
                                <label class="required form-label">{{ translate('Blog Title') }}</label>
                                <input type="text" placeholder="{{ translate('Blog Title') }}" id="title" name="title"
                                    class="form-control mb-2" onkeyup="makeSlug(this.value)" value="{{ $blog->title }}" required>
                            </div>

                            <!--begin::Input group-->
                            <div class="fv-row mb-2">
                                <label for="kt_ecommerce_add_product_store_template"
                                    class="form-label required">{{ translate('Category') }}</label>
                                <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                    data-placeholder="Select an option" id="category_id" name="category_id"
                                    data-live-search="true" @if($blog->category != null)
                                    data-selected="{{ $blog->category->id }}"
                                    @endif>
                                    <option value="0">{{ translate('No Parent') }}</option>
                                    <option>--</option>
                                    @foreach ($blog_categories as $category)
                                    <option value="{{ $category->id }}" {{$blog->category_id == $category->id ? "selected" : ""}}>
                                        {{ $category->category_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">{{ translate('Slug') }}</label>
                                <input type="text" placeholder="{{ translate('Slug') }}" id="slug" name="slug"
                                    class="form-control mb-2" value="{{ $blog->slug }}" required>
                            </div>
                            <div class="fv-row mt-5 mb-2">
                                <label class="form-label">{{ translate('Thumbnail Image') }} (1103 x 906) </label>
                                <!--begin::Dropzone-->
                                <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                    data-toggle="aizuploader" data-type="image">
                                    <!--begin::Message-->
                                    <div class="dz-message needsclick">
                                        <!--begin::Icon-->
                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                        <!--end::Icon-->
                                        <!--begin::Info-->
                                        <input type="hidden" name="thumbnail_img" class="selected-files" value="{{ $blog->thumbnail_img }}">
                                        <div class="ms-4">
                                            <h3 class="fs-5 fw-bolder text-gray-900 mb-1">{{translate('Drop files here or click
                                                to upload')}}.</h3>
                                            <span class="fs-7 fw-bold text-gray-400">{{translate('Thumbnail Size')}}  <small>(1103 x 906)</small> </span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                </div>
                                <!--end::Dropzone-->
                                <div class="file-preview box sm">
                                </div>

                            </div>
                            <div class="fv-row mt-5 mb-2">
                                <label class="form-label">{{ translate('Banner') }} <b>(1500 x 699)</b></label>
                                <!--begin::Dropzone-->
                                <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                    data-toggle="aizuploader" data-type="image">
                                    <!--begin::Message-->
                                    <div class="dz-message needsclick">
                                        <!--begin::Icon-->
                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                        <!--end::Icon-->
                                        <!--begin::Info-->
                                        <input type="hidden" name="banner" class="selected-files" value="{{ $blog->banner }}">
                                        <div class="ms-4">
                                            <h3 class="fs-5 fw-bolder text-gray-900 mb-1">{{translate('Drop files here or click
                                                to upload')}}.</h3>
                                            <span class="fs-7 fw-bold text-gray-400">{{translate('Banner Size')}}  <small>(1500 x 699)</small> </span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                </div>
                                <!--end::Dropzone-->
                                <div class="file-preview box sm">
                                </div>

                            </div>
                            {{-- <div class="text-muted fs-7">
                                {{ translate('These images are visible in Category Page banner. Use 600x600 sizes images.') }}
                            </div> --}}

                            <div class="mb-5 fv-row d-none">
                                <label class="required form-label">{{ translate('Short Description') }}</label>
                                <textarea name="short_description" rows="2" class="aiz-text-editor">{{ $blog->short_description }}</textarea>
                            </div>

                            <div class="mb-5 fv-row">
                                <label class="form-label">{{ translate('Description') }}</label>
                                <textarea name="description" rows="5" class="aiz-text-editor">{{ $blog->description }}</textarea>
                            </div>
                        </div>

                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{translate('Seo')}}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->

                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-5 fv-row">
                                    <label class="form-label">{{ translate('Meta Title') }}</label>
                                    <input type="text" name="meta_title" placeholder="{{translate('Meta Title')}}"
                                        class="form-control mb-2" value="{{ $blog->meta_title }}">
                                </div>

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
                                                <h3 class="fs-5 fw-bolder text-gray-900 mb-1">{{translate('Drop files here or click
                                                    to upload')}}.</h3>
                                                <span class="fs-7 fw-bold text-gray-400">{{translate('Meta image size')}}<small>(200x200)+</small></span>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                    </div>
                                    <!--end::Dropzone-->
                                    <div class="file-preview box sm">
                                    </div>

                                </div>
                                {{-- <div class="text-muted fs-7">
                                    {{ translate('These images are visible in Category Page banner. Use 600x600 sizes images.') }}
                                </div> --}}

                                <div class="mb-5 fv-row">
                                    <label class="form-label">{{ translate('Meta Description') }}</label>
                                    <textarea name="meta_description" rows="5" class="form-control">{{ $blog->meta_description }}</textarea>
                                </div>

                                <div class="mb-5 fv-row">
                                    <label class="form-label">{{ translate('Meta Keywords') }}</label>
                                    <input type="text" name="meta_keywords" id="meta_keywords" placeholder="{{translate('Meta Keywords')}}"
                                        class="form-control mb-2" value="{{ $blog->meta_keywords }}">
                                </div>

                            </div>
                        </div>

                        <div class="d-flex justify-content-end">

                            <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                <span class="indicator-label">{{ translate('Save Changes') }}</span>
                                <span class="indicator-progress">{{translate('Please wait')}}...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                    <!--end::Main column-->
                </div>
            </form>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
@endsection

@section('script')
<script>
    function makeSlug(val) {
        let str = val;
        let output = str.replace(/\s+/g, '-').toLowerCase();
        $('#slug').val(output);
    }
</script>
@endsection
