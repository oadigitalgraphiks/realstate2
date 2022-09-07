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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Home Page</h1>
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
                    <li class="breadcrumb-item text-dark">Home Page Edit</li>
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
            <div class="col-xl-10 mx-auto">
                <h2 class="fw-600">{{ translate('Home Page Settings') }}</h2>
                <div class="card card-flush mt-10 mb-10">

                    {{-- Home Slider --}}
                    <div class="card mt-5 d-none">
                        <div class="card-header">
                            <h6 class="mb-0">{{ translate('Home Slider') }}</h6>
                        </div>
                        <div class="card-body">
                            <!--begin::Notice-->
                            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6 mb-10">
                                {{ translate('We have limited banner height to maintain UI. We had to crop from both left & right side in view for different devices to make it responsive. Before designing banner keep these points in mind.') }}
                            </div>
                            <!--end::Notice-->
                            <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>{{ translate('Photos & Links') }}</label>
                                    <div class="home-slider-target">
                                        <input type="hidden" name="types[]" value="home_slider_images">
                                        <input type="hidden" name="types[]" value="home_slider_links">
                                        @if (get_setting('home_slider_images') != null)
                                            @foreach (json_decode(get_setting('home_slider_images'), true) as $key => $value)
                                                <div class="row gutters-5 mt-5">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                                </div>
                                                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                                <input type="hidden" name="types[]" value="home_slider_images">
                                                                <input type="hidden" name="home_slider_images[]" class="selected-files" value="{{ json_decode(get_setting('home_slider_images'), true)[$key] }}">
                                                            </div>
                                                            <div class="file-preview box sm">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md">
                                                        <div class="form-group">
                                                            <input type="hidden" name="types[]" value="home_slider_links">
                                                            <input type="text" class="form-control" placeholder="http://" name="home_slider_links[]" value="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-auto">
                                                        <div class="form-group">
                                                            <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                                                                <i class="las la-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <button
                                        type="button"
                                        class="btn btn-secondary btn-sm mt-5"
                                        data-toggle="add-more"
                                        data-content='
                                        <div class="row gutters-5 mt-5">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-light-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                        </div>
                                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                        <input type="hidden" name="types[]" value="home_slider_images">
                                                        <input type="hidden" name="home_slider_images[]" class="selected-files">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="home_slider_links">
                                                    <input type="text" class="form-control" placeholder="http://" name="home_slider_links[]">
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>'
                                        data-target=".home-slider-target">
                                        {{ translate('Add New') }}
                                    </button>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Home Banner 1 --}}
                    <div class="card d-none">
                        <div class="card-header">
                            <h6 class="mb-0">{{ translate('Home Banner 1 (Max 3)') }}</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>{{ translate('Banner & Links') }}</label>
                                    <div class="home-banner1-target">
                                        <input type="hidden" name="types[]" value="home_banner1_images">
                                        <input type="hidden" name="types[]" value="home_banner1_links">
                                        @if (get_setting('home_banner1_images') != null)
                                            @foreach (json_decode(get_setting('home_banner1_images'), true) as $key => $value)
                                                <div class="row gutters-5 mt-5">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                                </div>
                                                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                                <input type="hidden" name="types[]" value="home_banner1_images">
                                                                <input type="hidden" name="home_banner1_images[]" class="selected-files" value="{{ json_decode(get_setting('home_banner1_images'), true)[$key] }}">
                                                            </div>
                                                            <div class="file-preview box sm">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md">
                                                        <div class="form-group">
                                                            <input type="hidden" name="types[]" value="home_banner1_links">
                                                            <input type="text" class="form-control" placeholder="http://" name="home_banner1_links[]" value="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-auto">
                                                        <div class="form-group">
                                                            <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                                                                <i class="las la-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <button
                                        type="button"
                                        class="btn btn-secondary btn-sm mt-5"
                                        data-toggle="add-more"
                                        data-content='
                                        <div class="row gutters-5 mt-5">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                        </div>
                                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                        <input type="hidden" name="types[]" value="home_banner1_images">
                                                        <input type="hidden" name="home_banner1_images[]" class="selected-files">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="home_banner1_links">
                                                    <input type="text" class="form-control" placeholder="http://" name="home_banner1_links[]">
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>'
                                        data-target=".home-banner1-target">
                                        {{ translate('Add New') }}
                                    </button>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Home Banner 2 --}}
                    <div class="card d-none">
                        <div class="card-header">
                            <h6 class="mb-0">{{ translate('Home Banner 2 (Max 3)') }}</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>{{ translate('Banner & Links') }}</label>
                                    <div class="home-banner2-target">
                                        <input type="hidden" name="types[]" value="home_banner2_images">
                                        <input type="hidden" name="types[]" value="home_banner2_links">
                                        @if (get_setting('home_banner2_images') != null)
                                            @foreach (json_decode(get_setting('home_banner2_images'), true) as $key => $value)
                                                <div class="row gutters-5 mt-5">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                                </div>
                                                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                                <input type="hidden" name="types[]" value="home_banner2_images">
                                                                <input type="hidden" name="home_banner2_images[]" class="selected-files" value="{{ json_decode(get_setting('home_banner2_images'), true)[$key] }}">
                                                            </div>
                                                            <div class="file-preview box sm">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md">
                                                        <div class="form-group">
                                                            <input type="hidden" name="types[]" value="home_banner2_links">
                                                            <input type="text" class="form-control" placeholder="http://" name="home_banner2_links[]" value="{{ json_decode(get_setting('home_banner2_links'), true)[$key] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-auto">
                                                        <div class="form-group">
                                                            <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                                                                <i class="las la-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <button
                                        type="button"
                                        class="btn btn-secondary btn-sm mt-5"
                                        data-toggle="add-more"
                                        data-content='
                                        <div class="row gutters-5 mt-5">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                        </div>
                                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                        <input type="hidden" name="types[]" value="home_banner2_images">
                                                        <input type="hidden" name="home_banner2_images[]" class="selected-files">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="home_banner2_links">
                                                    <input type="text" class="form-control" placeholder="http://" name="home_banner2_links[]">
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>'
                                        data-target=".home-banner2-target">
                                        {{ translate('Add New') }}
                                    </button>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Home categories--}}
                    <div class="card mt-5 d-none">
                        <div class="card-header">
                            <h6 class="mb-0">{{ translate('Home Categories') }}</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>{{ translate('Categories') }}</label>
                                    <div class="home-categories-target">
                                        <input type="hidden" name="types[]" value="home_categories">
                                        @if (get_setting('home_categories') != null)
                                            @foreach (json_decode(get_setting('home_categories'), true) as $key => $home_categorie)
                                                <div class="row gutters-5 mt-5">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <select class="form-select mb-2 js-data-example-ajax" name="home_categories[]" data-live-search="true" data-selected={{ $home_categorie }} required>
                                                                @foreach (\App\Models\Category::where('parent_id', 0)->with('childrenCategories')->get() as $category)
                                                                    <option value="{{ $category->id }}" {{$home_categorie == $category->id ? "selected" : ''}}>{{ $category->getTranslation('name') }}</option>
                                                                    @foreach ($category->childrenCategories as $childCategory)
                                                                        @include('categories.child_category', ['child_category' => $childCategory,"home_categorie" => $home_categorie])
                                                                    @endforeach
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <button
                                        id="homecategories"
                                        type="button"
                                        class="btn btn-secondary btn-sm mt-5"
                                        data-toggle="add-more"
                                        data-content='<div class="row gutters-5 mt-5">
                                            <div class="col">
                                                <div class="fv-row mb-2">
                                                    <select class="form-select mb-2 js-data-example-ajax" data-control="select2" data-hide-search="false"
                                                        data-placeholder="Select an option" id="home_categories" name="home_categories[]"
                                                        data-live-search="true">
                                                        @foreach (\App\Models\Category::all() as $key => $category)
                                                            <option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                                                    <i class="las la-times"></i>
                                                </button>
                                            </div>
                                        </div>'
                                        data-target=".home-categories-target">
                                        {{ translate('Add New') }}
                                    </button>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>

{{-- Home Brands --}}
                    {{-- About --}}
                    <div class="card mt-5">
                        <div class="card-header">
                            <h6 class="mb-0">{{ translate('Home Brands') }}</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="home-widget-section-brand">
                                        @if (get_setting("home_widget_section_brand_image") != null)
                                            @foreach (json_decode(get_setting("home_widget_section_brand_image", null, $lang),true) as $key=> $home_widget_section_brand_image)
                                                <div class="row gutters-5 mt-5">
                                                    <div class="col-md-5 mt-5">
                                                        <div class="form-group">
                                                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}<b>(1000 x 750)</b></div>
                                                                </div>
                                                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                                <input type="hidden" name="types[][{{ $lang }}]" value="home_widget_section_brand_image">
                                                                <input type="hidden" name="home_widget_section_brand_image[]" class="selected-files" value="{{ $home_widget_section_brand_image}}">
                                                            </div>
                                                            <div class="file-preview box sm">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 mt-5">
                                                        <div class="form-group">
                                                            <input type="hidden" name="types[][{{ $lang }}]" value="home_widget_section_brand_title">
                                                            <input type="text" class="form-control" placeholder="Title" name="home_widget_section_brand_title[]" value="{{ json_decode(get_setting('home_widget_section_brand_title', null, $lang),true)[$key] ?? "" }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 mt-5">
                                                        <div class="form-group">
                                                            <input type="hidden" name="types[][{{ $lang }}]" value="home_widget_section_brand_btn_text">
                                                            <input type="text" class="form-control" placeholder="Button Text" name="home_widget_section_brand_btn_text[]" value="{{ json_decode(get_setting('home_widget_section_brand_btn_text', null, $lang),true)[$key] ?? "" }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 mt-5">
                                                        <div class="form-group">
                                                            <input type="hidden" name="types[][{{ $lang }}]" value="home_widget_section_brand_btn_link">
                                                            <input type="text" class="form-control" placeholder="https://" name="home_widget_section_brand_btn_link[]" value="{{ json_decode(get_setting('home_widget_section_brand_btn_link', null, $lang),true)[$key] ?? "" }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-auto">
                                                        <div class="form-group">
                                                            <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                                                                <i class="las la-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <button
                                        id="home-widget-section-brand"
                                        type="button"
                                        class="btn btn-secondary btn-sm mt-5"
                                        data-toggle="add-more"
                                        data-content='<div class="row gutters-5 mt-5">
                                            <div class="col-md-5 mt-5">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}<b>(1000 x 750)</b></div>
                                                        </div>
                                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                        <input type="hidden" name="types[]" value="home_widget_section_brand_image">
                                                        <input type="hidden" name="home_widget_section_brand_image[]" class="selected-files">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5 mt-5">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="home_widget_section_brand_title">
                                                    <input type="text" class="form-control" placeholder="Title" name="home_widget_section_brand_title[]" >
                                                </div>
                                            </div>
                                            <div class="col-md-5 mt-5">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="home_widget_section_brand_btn_text">
                                                    <input type="text" class="form-control" placeholder="Button Text" name="home_widget_section_brand_btn_text[]" >
                                                </div>
                                            </div>
                                            <div class="col-md-5 mt-5">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="home_widget_section_brand_btn_link">
                                                    <input type="text" class="form-control" placeholder="https://" name="home_widget_section_brand_btn_link[]" >
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>'
                                        data-target=".home-widget-section-brand">
                                        {{ translate('Add New') }}
                                    </button>
                                </div>
                                <div class="d-flex justify-content-end mt-5">
                                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-5">
                        <div class="card-header">
                            <h6 class="mb-0">{{ translate("Home First Ad's Banner") }}</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="home-ads-banner-first-target">
                                        @if (json_decode(get_setting('home_ads_first_banner_heading'), true) != null)
                                            @foreach (json_decode(get_setting('home_ads_first_banner_heading'), true) as $key => $home_ads_first_banner)
                                                @if ($home_ads_first_banner != null)
                                                    <div class="row gutters-5 mt-5">
                                                        <div class="col-md">
                                                            <div class="form-group">
                                                                <input type="hidden" name="types[]" value="home_ads_first_banner_heading">
                                                                <input type="text" class="form-control" placeholder="Heading" name="home_ads_first_banner_heading[]" value="{{ json_decode(get_setting('home_ads_first_banner_heading'), true)[$key] ?? "" }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md">
                                                            <div class="form-group">
                                                                <input type="hidden" name="types[]" value="home_ads_first_banner_text">
                                                                <input type="text" class="form-control" placeholder="Text" name="home_ads_first_banner_text[]" value="{{ json_decode(get_setting('home_ads_first_banner_text'), true)[$key] ?? "" }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                                                                <i class="las la-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <button
                                        id="home-ads-banner-first-target"
                                        type="button"
                                        class="btn btn-secondary btn-sm mt-5"
                                        data-toggle="add-more"
                                        data-content='<div class="row gutters-5 mt-5">
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="home_ads_first_banner_heading">
                                                    <input type="text" class="form-control" placeholder="Heading" name="home_ads_first_banner_heading[]" >
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="home_ads_first_banner_text">
                                                    <input type="text" class="form-control" placeholder="Text" name="home_ads_first_banner_text[]" >
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                                                    <i class="las la-times"></i>
                                                </button>
                                            </div>
                                        </div>'
                                        data-target=".home-ads-banner-first-target">
                                        {{ translate('Add New') }}
                                    </button>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- marquee --}}
                    <div class="card mt-5">
                        <div class="card-header">
                            <h6 class="mb-0">{{ translate("Home Second Ad's Banner") }}</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="home-ads-banner-target">
                                        @foreach (json_decode(get_setting('home_ads_banner_heading'), true) as $key => $home_ads_banner)
                                            @if ($home_ads_banner != null)
                                                <div class="row gutters-5 mt-5">
                                                    <div class="col-md">
                                                        <div class="form-group">
                                                            <input type="hidden" name="types[]" value="home_ads_banner_heading">
                                                            <input type="text" class="form-control" placeholder="Heading" name="home_ads_banner_heading[]" value="{{ json_decode(get_setting('home_ads_banner_heading'), true)[$key] ?? "" }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md">
                                                        <div class="form-group">
                                                            <input type="hidden" name="types[]" value="home_ads_banner_text">
                                                            <input type="text" class="form-control" placeholder="Text" name="home_ads_banner_text[]" value="{{ json_decode(get_setting('home_ads_banner_text'), true)[$key] ?? "" }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <button
                                        id="home-ads-banner-target"
                                        type="button"
                                        class="btn btn-secondary btn-sm mt-5"
                                        data-toggle="add-more"
                                        data-content='<div class="row gutters-5 mt-5">
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="home_ads_banner_heading">
                                                    <input type="text" class="form-control" placeholder="Heading" name="home_ads_banner_heading[]" >
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="home_ads_banner_text">
                                                    <input type="text" class="form-control" placeholder="Heading" name="home_ads_banner_text[]" >
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                                                    <i class="las la-times"></i>
                                                </button>
                                            </div>
                                        </div>'
                                        data-target=".home-ads-banner-target">
                                        {{ translate('Add New') }}
                                    </button>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- About --}}
                    <div class="card mt-5">
                        <div class="card-header">
                            <h6 class="mb-0">{{ translate('Our Story') }}</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="home-about-target">
                                        <div class="row gutters-5 mt-5">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}<b>(1000 x 750)</b></div>
                                                        </div>
                                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                        <input type="hidden" name="types[]" value="home_about_images">
                                                        <input type="hidden" name="home_about_images" class="selected-files" value="{{ get_setting('home_about_images') }}">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="home_about_heading">
                                                    <input type="text" class="form-control" placeholder="Text" name="home_about_heading" value="{{ get_setting('home_about_heading', null, $lang) ?? "" }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-5">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="home_about_description">
                                                    <textarea name="home_about_description" class="form-control" cols="30" rows="10">{{ get_setting('home_about_description',null,$lang) }}</textarea>
                                                    {{-- <textarea class="aiz-text-editor" data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
                                                    name="home_about_description" placeholder="Description" data-min-height="150">{{ get_setting('home_about_description',null,$lang) }}</textarea> --}}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-5">
                                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-5">
                        <div class="card-header">
                            <h6 class="mb-0">{{ translate('What we do') }}</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="home-about-target">
                                        <div class="row gutters-5 mt-5">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}<b>(1000 x 750)</b></div>
                                                        </div>
                                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                        <input type="hidden" name="types[]" value="home_about_second_images">
                                                        <input type="hidden" name="home_about_second_images" class="selected-files" value="{{ get_setting('home_about_second_images') }}">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse GIF')}}<b>(400 x 400)</b></div>
                                                        </div>
                                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                        <input type="hidden" name="types[]" value="home_about_second_gif">
                                                        <input type="hidden" name="home_about_second_gif" class="selected-files" value="{{ get_setting('home_about_second_gif') }}">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="home_about_second_heading">
                                                    <input type="text" class="form-control" placeholder="Text" name="home_about_second_heading" value="{{ get_setting('home_about_second_heading', null, $lang) ?? "" }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-5">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="home_about_second_description">
                                                    <textarea name="home_about_second_description" class="form-control"  cols="30" rows="10">{{ get_setting('home_about_second_description',null,$lang) }}</textarea>
                                                    {{-- <textarea class="aiz-text-editor" data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
                                                    name="home_about_second_description" placeholder="Description" data-min-height="150"></textarea> --}}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-5">
                                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- social widget --}}
                    <div class="card mt-5">
                        <div class="card-header">
                            <h6 class="mb-0">{{ translate('Social Widget') }}</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="home-about-target">
                                        <div class="row gutters-5 mt-5">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="home_social_heading">
                                                    <input type="text" class="form-control" placeholder="Heading" name="home_social_heading" value="{{ get_setting('home_social_heading', null, $lang) ?? "" }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="home_social_second_heading">
                                                    <input type="text" class="form-control" placeholder="Heading Second" name="home_social_second_heading" value="{{ get_setting('home_social_second_heading', null, $lang) ?? "" }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="home_social_button_title">
                                                    <input type="text" class="form-control" placeholder="Button Text" name="home_social_button_title" value="{{ get_setting('home_social_button_title', null, $lang) ?? "" }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-5">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="home_social_link">
                                                    <input type="text" class="form-control" placeholder="https://" name="home_social_link" value="{{ get_setting('home_social_link', null, $lang) ?? "" }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-5">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="home_social_description">
                                                    <input name="home_social_description" class="form-control" value="{{ get_setting('home_social_description',null,$lang) }}">
                                                    {{-- <textarea class="aiz-text-editor" data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
                                                    name="home_social_description" placeholder="Description" data-min-height="150">{{ get_setting('home_social_description',null,$lang) }}</textarea> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-5">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="home_social_second_description">
                                                    <input type="text" class="form-control" name="home_social_second_description" value="{{ get_setting('home_social_second_description', null, $lang) ?? "" }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="home-ads-banner-target">
                                        @if(json_decode(get_setting('home_social_images'), true) != null)
                                            @foreach (json_decode(get_setting('home_social_images'), true) as $key => $home_social_images)
                                                @if ($home_social_images != null)
                                                    <div class="row gutters-5 mt-5">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input type="hidden" name="types[]" value="home_social_images_link">
                                                                <input type="text" class="form-control" placeholder="https://" name="home_social_images_link[]" value="{{ json_decode(get_setting('home_social_images_link'), true)[$key] ?? "" }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}<b>(640 x 640)</b></div>
                                                                    </div>
                                                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                                    <input type="hidden" name="types[]" value="home_social_images">
                                                                    <input type="hidden" name="home_social_images[]" class="selected-files" value="{{ $home_social_images }}">
                                                                </div>
                                                                <div class="file-preview box sm">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                                                                <i class="las la-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <button
                                        id="home-ads-banner-target"
                                        type="button"
                                        class="btn btn-secondary btn-sm mt-5"
                                        data-toggle="add-more"
                                        data-content='<div class="row gutters-5 mt-5">
                                            <div class="row gutters-5 mt-5">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="hidden" name="types[]" value="home_social_images_link">
                                                        <input type="text" class="form-control" placeholder="https://" name="home_social_images_link[]" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}<b>(640 x 640)</b></div>
                                                            </div>
                                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                            <input type="hidden" name="types[]" value="home_social_images">
                                                            <input type="hidden" name="home_social_images[]" class="selected-files" >
                                                        </div>
                                                        <div class="file-preview box sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>'
                                        data-target=".home-ads-banner-target">
                                        {{ translate('Add New') }}
                                    </button>
                                </div>
                                <div class="d-flex justify-content-end mt-5">
                                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Home Banner 3 --}}
                    <div class="card d-none">
                        <div class="card-header">
                            <h6 class="mb-0">{{ translate('Home Banner 3 (Max 3)') }}</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>{{ translate('Banner & Links') }}</label>
                                    <div class="home-banner3-target">
                                        <input type="hidden" name="types[]" value="home_banner3_images">
                                        <input type="hidden" name="types[]" value="home_banner3_links">
                                        @if (get_setting('home_banner3_images') != null)
                                            @foreach (json_decode(get_setting('home_banner3_images'), true) as $key => $value)
                                                <div class="row gutters-5 mt-5">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                                </div>
                                                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                                <input type="hidden" name="types[]" value="home_banner3_images">
                                                                <input type="hidden" name="home_banner3_images[]" class="selected-files" value="{{ json_decode(get_setting('home_banner3_images'), true)[$key] }}">
                                                            </div>
                                                            <div class="file-preview box sm">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md">
                                                        <div class="form-group">
                                                            <input type="hidden" name="types[]" value="home_banner3_links">
                                                            <input type="text" class="form-control" placeholder="http://" name="home_banner3_links[]" value="{{ json_decode(get_setting('home_banner3_links'), true)[$key] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-auto">
                                                        <div class="form-group">
                                                            <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                                                                <i class="las la-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <button
                                        type="button"
                                        class="btn btn-secondary btn-sm mt-5"
                                        data-toggle="add-more"
                                        data-content='
                                        <div class="row gutters-5 mt-5">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                        </div>
                                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                        <input type="hidden" name="types[]" value="home_banner3_images">
                                                        <input type="hidden" name="home_banner3_images[]" class="selected-files">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="home_banner3_links">
                                                    <input type="text" class="form-control" placeholder="http://" name="home_banner3_links[]">
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>'
                                        data-target=".home-banner3-target">
                                        {{ translate('Add New') }}
                                    </button>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Top 10 --}}
                    <div class="card d-none">
                        <div class="card-header">
                            <h6 class="mb-0">{{ translate('Top 10') }}</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="fv-row mb-2">
                                    <label for="kt_ecommerce_add_product_store_template"
                                        class="form-label">{{ translate('Top Categories (Max 10)') }}</label>
                                        <input type="hidden" name="types[]" value="top10_categories">
                                        {{-- @dd(json_decode(get_setting('top10_categories'))) --}}
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                        data-placeholder="Select an option" id="top10_categories" name="top10_categories[]"
                                        data-live-search="true" multiple>
                                        {{-- where('parent_id', 0)->with('childrenCategories') --}}
                                        @foreach (\App\Models\Category::all() as $category)
                                            <option value="{{ $category->id }}"
                                                @if(get_setting('top10_categories') != null)
                                                    @if(in_array($category->id,json_decode(get_setting('top10_categories'))) == true)
                                                        selected
                                                    @endif
                                                @endif  >{{ $category->getTranslation('name') }}
                                            </option>
                                            {{-- @foreach ($category->childrenCategories as $childCategory)
                                                @include('categories.child_category', ['child_category' => $childCategory,'top10_categories' => json_decode(get_setting('top10_categories'))])
                                            @endforeach --}}
                                        @endforeach
                                    </select>
                                </div>

                                <div class="fv-row mb-2">
                                    <label for="kt_ecommerce_add_product_store_template"
                                        class="form-label">{{ translate('Top Brands (Max 10)') }}</label>
                                    <input type="hidden" name="types[]" value="top10_brands">
                                    <select class="form-select mb-2" multiple data-control="select2" data-hide-search="false"
                                        data-placeholder="Select an option" id="top10_brands" name="top10_brands[]"
                                        data-live-search="true" data-selected="{{ get_setting('top10_brands') }}">
                                        @foreach (\App\Models\Brand::all() as $key => $brand)
                                            <option value="{{ $brand->id }}"
                                                @if(get_setting('top10_brands') != null)
                                                    @if(in_array($brand->id,json_decode(get_setting('top10_brands'))) == true)
                                                        selected
                                                    @endif
                                                @endif>{{ $brand->getTranslation('name') }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
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


@section('script')
    <script type="text/javascript">
		$(document).ready(function(){
			$('.js-data-example-ajax').select2();

			$("#homecategories").on("click",function(){
				$('.js-data-example-ajax').select2();
			});
		    AIZ.plugins.bootstrapSelect('refresh');
		});
        function infocontent() {
            $('.home-about-target').append($('#homeabout').html());
            AIZ.plugins.textEditor();
        }
    </script>
@endsection
<script id="homeabout" type="text/template">
    <div class="row gutters-5 mt-5">
        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group" data-toggle="aizuploader" data-type="image">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}<b>(1000 x 750)</b></div>
                    </div>

                    <input type="hidden" name="types[]" value="home_about_images">
                    <input type="hidden" name="home_about_images[]" class="selected-files">
                </div>
                <div class="file-preview box sm">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group" data-toggle="aizuploader" data-type="image">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Gif Browse')}}<b>(400 x 400)</b></div>
                    </div>
                    <input type="hidden" name="types[]" value="home_about_gif">
                    <input type="hidden" name="home_about_gif[]" class="selected-files">
                </div>
                <div class="file-preview box sm">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="hidden" name="types[][{{ $lang }}]" value="home_about_heading">
                <input type="text" class="form-control" placeholder="Text" name="home_about_heading[]">
            </div>
        </div>
        <div class="col-md-auto">
            <div class="form-group">
                <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                    <i class="las la-times"></i>
                </button>
            </div>
        </div>
        <div class="col-md mt-5">
            <div class="form-group">
                <input type="hidden" name="types[][{{ $lang }}]" value="home_about_description">
                <textarea class="aiz-text-editor" data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
                name="home_about_description[]" placeholder="Description" data-min-height="150">

                </textarea>
            </div>
        </div>

    </div>
</script>
