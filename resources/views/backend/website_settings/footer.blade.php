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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Footer</h1>
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
                    <li class="breadcrumb-item text-dark">Footer Edit</li>
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
            <ul class="nav nav-tabs nav-fill border-light mb-5">
                @foreach (\App\Models\Language::all() as $key => $language)
                <li class="nav-item">
                    <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"
                        href="{{ route('website.footer', ['lang' => $language->code]) }}">
                        <img src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}" height="11"
                            class="mr-1">
                        <span>{{ $language->name }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
            <!--begin::Row-->
            <div class="row g-5 g-xl-8">
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::Feeds Widget 1-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body pb-0">
                            <!--begin::Header-->
                            <div class="align-items-center">
                                <!--begin::User-->
                                <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10"
                                    action="{{ route('business_settings.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="align-items-center flex-grow-1">
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column mb-5">
                                            <span
                                                class="text-gray-900 fs-6 fw-bolder">{{ translate('About Widget')
                                                }}</span>
                                        </div>
                                        <div class="separator"></div>
                                        <!--end::Info-->
                                        <div class="d-flex flex-column">
                                            <label class="form-label">{{ translate('Footer Logo') }}</label>
                                            <!--begin::Dropzone-->
                                            <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                                data-toggle="aizuploader" data-type="image">
                                                <!--begin::Message-->
                                                <div class="dz-message needsclick">
                                                    <!--begin::Icon-->
                                                    <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                    <!--end::Icon-->
                                                    <!--begin::Info-->
                                                    <input type="hidden" name="types[]" value="footer_logo">
                                                    <input type="hidden" name="footer_logo" class="selected-files"
                                                        value="{{ get_setting('footer_logo') }}">
                                                    <div class="ms-4">
                                                        <h3 class="fs-5 fw-bolder text-gray-900 mb-1">
                                                            {{ translate('Drop files here or click to upload') }}.
                                                        </h3>
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                            </div>
                                            <!--end::Dropzone-->
                                            <div class="file-preview box sm">
                                            </div>
                                        </div>

                                        <div class="separator"></div>

                                        <div class="d-flex flex-column">
                                            <div class="mb-5 fv-row">
                                                <label class="form-label">{{ translate('About description') }}
                                                    ({{ translate('Translatable') }})</label>
                                                <input type="hidden" name="types[][{{ $lang }}]"
                                                    value="about_us_description">
                                                <textarea class="aiz-text-editor" name="about_us_description"
                                                    placeholder="Type.." data-min-height="150">
                    {!! get_setting('about_us_description', null, $lang) !!}
                   </textarea>

                                            </div>
                                        </div>

                                        <div class="separator"></div>

                                        <div class="d-flex flex-column mt-5 d-none">
                                            <div class="mb-5 fv-row">
                                                <label
                                                    class="form-label">{{ translate('Play Store Link') }}</label>
                                                <input type="hidden" name="types[]" value="play_store_link">
                                                <input type="text"
                                                    placeholder="{{ translate('Link with') }} http:// {{ translate('or') }} https://"
                                                    id="play_store_link" name="play_store_link"
                                                    class="form-control mb-2"
                                                    value="{{ get_setting('play_store_link') }}">
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column d-none">
                                            <div class="mb-5 fv-row">
                                                <label
                                                    class="form-label">{{ translate('App Store Link') }}</label>
                                                <input type="hidden" name="types[]" value="app_store_link">
                                                <input type="text"
                                                    placeholder="{{ translate('Link with') }} http:// {{ translate('or') }} https://"
                                                    id="app_store_link" name="app_store_link" class="form-control mb-2"
                                                    value="{{ get_setting('app_store_link') }}">
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="submit" id="kt_ecommerce_add_category_submit"
                                                class="btn btn-primary">
                                                <span class="indicator-label">{{ translate('Update') }}</span>
                                                <span class="indicator-progress">{{ translate('Please wait') }}...
                                                    <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <!--end::User-->
                            </div>
                            <!--end::Header-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Feeds Widget 1-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::Feeds Widget 5-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body pb-0">
                            <!--begin::Header-->
                            <div class="align-items-center">
                                <!--begin::User-->
                                <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10"
                                    action="{{ route('business_settings.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="align-items-center flex-grow-1">
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column mb-5">
                                            <span
                                                class="text-gray-900 fs-6 fw-bolder">{{ translate('Contact Info Widget')
                                                }}</span>
                                        </div>
                                        <div class="separator"></div>
                                        <!--end::Info-->
                                        <div class="d-flex flex-column">
                                            <div class="mb-5 fv-row">
                                                <label class="form-label">{{ translate('Contact address') }}
                                                    ({{ translate('Translatable') }})</label>
                                                <input type="hidden" name="types[][{{ $lang }}]"
                                                    value="contact_address">
                                                <input type="text" placeholder="{{ translate('Address') }}"
                                                    id="contact_address" name="contact_address"
                                                    class="form-control mb-2"
                                                    value="{{ get_setting('contact_address', null, $lang) }}">
                                            </div>
                                        </div>

                                        <div class="separator"></div>

                                        <div class="d-flex flex-column mt-5">
                                            <div class="mb-5 fv-row">
                                                <label
                                                    class="form-label">{{ translate('Contact phone') }}</label>
                                                <input type="hidden" name="types[]" value="contact_phone">
                                                <input type="text" placeholder="{{ translate('Phone') }}"
                                                    name="contact_phone" class="form-control mb-2"
                                                    value="{{ get_setting('contact_phone') }}">
                                            </div>
                                        </div>

                                        <div class="separator"></div>

                                        <div class="d-flex flex-column mt-5">
                                            <div class="mb-5 fv-row">
                                                <label
                                                    class="form-label">{{ translate('Contact email') }}</label>
                                                <input type="hidden" name="types[]" value="contact_email">
                                                <input type="text" placeholder="{{ translate('Email') }}"
                                                    name="contact_email" class="form-control mb-2"
                                                    value="{{ get_setting('contact_email') }}">
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="submit" id="kt_ecommerce_add_category_submit"
                                                class="btn btn-primary">
                                                <span class="indicator-label">{{ translate('Update') }}</span>
                                                <span class="indicator-progress">{{ translate('Please wait') }}...
                                                    <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <!--end::User-->
                            </div>
                            <!--end::Header-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Feeds Widget 5-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-8">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::Feeds Widget 1-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body pb-0">
                            <!--begin::Header-->
                            <div class="align-items-center">
                                <!--begin::User-->
                                <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10"
                                    action="{{ route('business_settings.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="align-items-center flex-grow-1">
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column mb-5">
                                            <span
                                                class="text-gray-900 fs-6 fw-bolder">{{ translate('Link Widget One')
                                                }}</span>
                                        </div>
                                        <div class="separator"></div>
                                        <!--end::Info-->
                                        <div class="d-flex flex-column mb-5">
                                            <label class="form-label">{{ translate('Title') }}
                                                ({{ translate('Translatable') }})</label>
                                            <input type="hidden" name="types[]" value="widget_one">
                                            <input type="text"
                                                placeholder="{{ translate('Link with') }} http:// {{ translate('or') }} https://"
                                                id="widget_one" name="widget_one" class="form-control mb-2"
                                                value="{{ get_setting('widget_one') }}">
                                        </div>
                                        <div class="d-flex flex-column mb-5">
                                            <div class="w3-links-target">
                                                <input type="hidden" name="types[][{{ $lang }}]"
                                                    value="widget_one_labels">
                                                <input type="hidden" name="types[]" value="widget_one_links">
                                                @if (get_setting('widget_one_labels', null, $lang) != null)
                                                @foreach (json_decode(get_setting('widget_one_labels', null, $lang),
                                                true) as $key => $value)
                                                <div class="row gutters-5 mb-5">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                placeholder="{{ translate('Label') }}"
                                                                name="widget_one_labels[]"
                                                                value="{{ $value }}">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                placeholder="http://" name="widget_one_links[]"
                                                                value="{{ json_decode(get_setting('widget_one_links'), true)[$key] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button"
                                                            class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger"
                                                            data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="mb-5 w-100">
                                                <button type="button" class="btn btn-light-primary btn-sm"
                                                    data-toggle="add-more" data-content='<div class="row gutters-5 mb-5">
                     <div class="col-4">
                      <div class="form-group">
                       <input type="text" class="form-control" placeholder="{{ translate(' Label') }}"
                                                    name="widget_one_labels[]">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="http://"
                                                    name="widget_one_links[]">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button"
                                                class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger"
                                                data-toggle="remove-parent" data-parent=".row">
                                                <i class="las la-times"></i>
                                            </button>
                                        </div>
                                    </div>' data-target=".w3-links-target">
                                    {{ translate('Add New') }}
                                    </button>
                            </div>
                        </div>
                        <div class="separator"></div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" id="kt_ecommerce_add_category_submit"
                                class="btn btn-primary">
                                <span class="indicator-label">{{ translate('Update') }}</span>
                                <span class="indicator-progress">{{ translate('Please wait') }}...
                                    <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </div>
                    </form>
                    <!--end::User-->
                </div>
                <!--end::Header-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Feeds Widget 1-->
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->
<div id="wrapper" class="my-20">
    <form id="ef_widget" class="form d-flex flex-column gap-7 gap-lg-10"
        action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div id="wrapper_inside" class="col-12">
            @if (get_setting('footer_widget_title', null, $lang) != null)
                @foreach (json_decode(get_setting('footer_widget_title', null, $lang), true) as $key => $value)
                    <div class="row g-5 g-xl-8">
                        <!--begin::Col-->
                        <div class="col-xl-12">
                            <!--begin::Feeds Widget 1-->
                            <div class="card mb-5 mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body pb-0">
                                    <!--begin::Header-->
                                    <div class="align-items-center">
                                        <!--begin::User-->
                                        <div class="align-items-center flex-grow-1">
                                            <!--begin::Info-->
                                            <div class="d-flex  justify-content-between">
                                                <span
                                                    class="text-gray-900 fs-6 fw-bolder">{{ translate('Extra Footer Widget') }}
                                                </span>
                                                <div class="col-auto">
                                                    @if ($key != 0)
                                                        <button type="button"
                                                            class="mb-2 btn btn-icon btn-circle btn-sm btn-light-danger"
                                                            onclick="$(this).parents('div').eq(7).remove();"
                                                            data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="separator"></div>
                                            <!--end::Info-->

                                            <div class="d-flex flex-column mt-5">
                                                <div class="mb-5 fv-row">
                                                    <label
                                                        class="form-label">{{ translate('Title') }}
                                                        ({{ translate('Translatable') }})
                                                    </label>
                                                    <input type="hidden"
                                                        name="types[][{{ $lang }}]"
                                                        value="footer_widget_title">
                                                    <input type="text"
                                                        placeholder="{{ translate('Title') }}" id="title"
                                                        name="footer_widget_title[]" class="form-control mb-2"
                                                        value="{{ $value }}">
                                                </div>
                                            </div>
                                            <div class="separator"></div>

                                            <div class="d-flex flex-column mt-5">
                                                <div class="mb-5 fv-row">
                                                    <label
                                                        class="form-label">{{ translate('Second Title') }}
                                                        ({{ translate('Translatable') }})
                                                    </label>
                                                    <input type="hidden"
                                                        name="types[][{{ $lang }}]"
                                                        value="footer_widget_title2">
                                                    <input type="text"
                                                        placeholder="{{ translate('Title') }}" id="title"
                                                        name="footer_widget_title2[]" class="form-control mb-2"
                                                        value="{{ json_decode(get_setting('footer_widget_title2'), true)[$key] ?? "" }}">
                                                </div>
                                            </div>
                                            <div class="separator"></div>

                                            <div class="d-flex flex-column mt-5">
                                                <div class="mb-5 fv-row">
                                                    <label
                                                        class="form-label">{{ translate('Link') }}

                                                    </label>
                                                    <input type="hidden"
                                                        name="types[]"
                                                        value="footer_widget_link">
                                                    <input type="text"
                                                        placeholder="https://" id="title"
                                                        name="footer_widget_link[]" class="form-control mb-2"
                                                        value="{{ json_decode(get_setting('footer_widget_link'), true)[$key] ?? "" }}">
                                                </div>
                                            </div>
                                            <div class="separator"></div>

                                            <div class="d-flex flex-column mt-5">
                                                <div class="mb-5 fv-row">
                                                    <label class="form-label">{{ translate('Icon') }}
                                                        ({{ translate('Translatable') }})
                                                    </label>
                                                    <div class="form-group">
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                            </div>
                                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                            <input type="hidden" name="types[]" value="footer_widget_images">
                                                            <input type="hidden" name="footer_widget_images[]" class="selected-files" value="{{ json_decode(get_setting('footer_widget_images'), true)[$key] ?? "" }}">
                                                        </div>
                                                        <div class="file-preview box sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="separator"></div>

                                        </div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Header-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Feeds Widget 1-->
                        </div>
                        <!--end::Col-->
                    </div>
                @endforeach
            @endif
        </div>
        <div class="d-flex justify-content-between mb-5">
            <button class="btn btn-primary" data-toggle="add-more" onclick="addWidget();" data-content="">
                {{ translate('Add Widgets') }}
            </button>
            <button form="ef_widget" type="submit" id="kt_ecommerce_add_category_submit"
                class="btn btn-primary">
                <span class="indicator-label">{{ translate('Update') }}</span>
                <span class="indicator-progress">{{ translate('Please wait') }}...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </form>
</div>
<!--begin::Row-->
<div class="row g-5 g-xl-8">
    <!--begin::Col-->
    <div class="col-xl-12">
        <!--begin::Feeds Widget 1-->
        <div class="card mb-5 mb-xl-8">
            <!--begin::Body-->
            <div class="card-body pb-0">
                <!--begin::Header-->
                <div class="align-items-center">
                    <!--begin::User-->
                    <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10"
                        action="{{ route('business_settings.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="align-items-center flex-grow-1">
                            <!--begin::Info-->
                            <div class="d-flex flex-column mb-5">
                                <span
                                    class="text-gray-900 fs-6 fw-bolder">{{ translate('Copyright Widget') }}</span>
                            </div>
                            <div class="separator"></div>
                            <!--end::Info-->
                            <div class="d-flex flex-column">
                                <div class="mb-5 fv-row">
                                    <label class="form-label">{{ translate('Copyright Text') }}
                                        ({{ translate('Translatable') }})</label>
                                    <input type="hidden" name="types[][{{ $lang }}]"
                                        value="frontend_copyright_text">
                                    <textarea class="aiz-text-editor" name="frontend_copyright_text"
                                        placeholder="Type.." data-min-height="200">
                    {!! get_setting('frontend_copyright_text', null, $lang) !!}
                   </textarea>
                                </div>
                            </div>
                            <div class="separator"></div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" id="kt_ecommerce_add_category_submit"
                                    class="btn btn-primary">
                                    <span class="indicator-label">{{ translate('Update') }}</span>
                                    <span class="indicator-progress">{{ translate('Please wait') }}...
                                        <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!--end::User-->
                </div>
                <!--end::Header-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Feeds Widget 1-->
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->
<!--begin::Row-->
<div class="row g-5 g-xl-8">
    <!--begin::Col-->
    <div class="col-xl-12">
        <!--begin::Feeds Widget 1-->
        <div class="card mb-5 mb-xl-8">
            <!--begin::Body-->
            <div class="card-body pb-0">
                <!--begin::Header-->
                <div class="align-items-center">
                    <!--begin::User-->
                    <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10"
                        action="{{ route('business_settings.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="align-items-center flex-grow-1">
                            <!--begin::Info-->
                            <div class="d-flex flex-column mb-5">
                                <span
                                    class="text-gray-900 fs-6 fw-bolder">{{ translate('Social Link Widget') }}</span>
                            </div>
                            <div class="separator"></div>
                            <!--end::Info-->
                            <div class="d-flex flex-column mt-5">
                                <div class="mb-5 fv-row">
                                    <label
                                        class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5">
                                        <span
                                            class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">{{
                                            translate('Show Social Links?') }}</span>
                                        <span
                                            class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                            <input type="hidden" name="types[]" value="show_social_links">
                                            <input class="form-check-input" type="checkbox"
                                                name="show_social_links" @if (get_setting('show_social_links')=='on' )
                                                checked @endif>
                                        </span>
                                    </label>

                                </div>
                            </div>

                            <div class="d-flex flex-column mt-5">
                                <div class="mb-5 fv-row">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text py-5"><i
                                                    class="lab la-facebook-f"></i></span>
                                        </div>
                                        <input type="hidden" name="types[]" value="facebook_link">
                                        <input type="text" class="form-control" placeholder="http://"
                                            name="facebook_link"
                                            value="{{ get_setting('facebook_link') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column mt-5">
                                <div class="mb-5 fv-row">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text py-5"><i
                                                    class="lab la-twitter"></i></span>
                                        </div>
                                        <input type="hidden" name="types[]" value="twitter_link">
                                        <input type="text" class="form-control" placeholder="http://"
                                            name="twitter_link"
                                            value="{{ get_setting('twitter_link') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column mt-5">
                                <div class="mb-5 fv-row">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text py-5"><i
                                                    class="lab la-instagram"></i></span>
                                        </div>
                                        <input type="hidden" name="types[]" value="instagram_link">
                                        <input type="text" placeholder="http://" class="form-control"
                                            name="instagram_link"
                                            value="{{ get_setting('instagram_link') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column mt-5">
                                <div class="mb-5 fv-row">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text py-5"><i
                                                    class="lab la-youtube"></i></span>
                                        </div>
                                        <input type="hidden" name="types[]" value="youtube_link">
                                        <input type="text" placeholder="http://" class="form-control"
                                            name="youtube_link"
                                            value="{{ get_setting('youtube_link') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-column mt-5 d-none">
                                <div class="mb-5 fv-row">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text py-5"><i
                                                    class="lab la-linkedin-in"></i></span>
                                        </div>
                                        <input type="hidden" name="types[]" value="linkedin_link">
                                        <input type="text" placeholder="http://" class="form-control"
                                            name="linkedin_link"
                                            value="{{ get_setting('linkedin_link') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="separator"></div>

                            <div class="d-flex flex-column mt-5">
                                <label
                                    class="form-label">{{ translate('Payment Methods Widget') }}</label>
                                <!--begin::Dropzone-->
                                <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                    data-toggle="aizuploader" data-type="image" data-multiple="true">
                                    <!--begin::Message-->
                                    <div class="dz-message needsclick">
                                        <!--begin::Icon-->
                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                        <!--end::Icon-->
                                        <!--begin::Info-->
                                        <input type="hidden" name="types[]" value="payment_method_images">
                                        <input type="hidden" name="payment_method_images"
                                            class="selected-files"
                                            value="{{ get_setting('payment_method_images') }}">
                                        <div class="ms-4">
                                            <h3 class="fs-5 fw-bolder text-gray-900 mb-1">
                                                {{ translate('Payment Methods') }}.</h3>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                </div>
                                <!--end::Dropzone-->
                                <div class="file-preview box sm">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-10">
                                <button type="submit" id="kt_ecommerce_add_category_submit"
                                    class="btn btn-primary">
                                    <span class="indicator-label">{{ translate('Update') }}</span>
                                    <span class="indicator-progress">{{ translate('Please wait') }}...
                                        <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!--end::User-->
                </div>
                <!--end::Header-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Feeds Widget 1-->
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->
</div>
<!--end::Container-->
</div>
<!--end::Post-->
</div>

<script>
    function addWidget() {
        $('#wrapper_inside').append($('#widget_var').html());
        AIZ.plugins.textEditor();
    }
</script>

<script id="widget_var" type="text/template">
    <div class="row g-5 g-xl-8">
        <!--begin::Col-->
        <div class="col-xl-12">
            <!--begin::Feeds Widget 1-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body pb-0">
                    <!--begin::Header-->
                    <div class="align-items-center">
                        <!--begin::User-->

                            <div class="align-items-center flex-grow-1">
                                <!--begin::Info-->
                                <div class="d-flex justify-content-between">
                                    <span
                                        class="text-gray-900 fs-6 fw-bolder">{{ translate('Extra Footer Widget') }}
                                    </span>
                                    <div class="col-auto">
                                        <button type="button"
                                            class="mb-2 btn btn-icon btn-circle btn-sm btn-light-danger" onclick="$(this).parents('div').eq(7).remove();"
                                            data-toggle="remove-parent" data-parent=".row">
                                            <i class="las la-times"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="separator"></div>
                                <!--end::Info-->
                                <div class="d-flex flex-column mt-5">
                                    <div class="mb-5 fv-row">
                                        <label class="form-label">{{ translate('Title') }}
                                            ({{ translate('Translatable') }})</label>
                                        <input type="hidden" name="types[][{{ $lang }}]" value="footer_widget_title">
                                        <input type="text" placeholder="{{ translate('Title') }}" id="title" name="footer_widget_title[]" class="form-control mb-2" >
                                    </div>
                                </div>
                                <div class="separator"></div>

                                <div class="d-flex flex-column mt-5">
                                    <div class="mb-5 fv-row">
                                        <label class="form-label">{{ translate('Second Title') }}</label>
                                        <input type="hidden" name="types[][{{ $lang }}]" value="footer_widget_title2">
                                        <input type="text" placeholder="{{ translate('Title') }}" id="title" name="footer_widget_title2[]" class="form-control mb-2" >
                                    </div>
                                </div>
                                <div class="separator"></div>

                                <div class="d-flex flex-column mt-5">
                                    <div class="mb-5 fv-row">
                                        <label
                                            class="form-label">{{ translate('Link') }}
                                            ({{ translate('Translatable') }})
                                        </label>
                                        <input type="hidden"
                                            name="types[]"
                                            value="footer_widget_link">
                                        <input type="text"
                                            placeholder="https://" id="title"
                                            name="footer_widget_link[]" class="form-control mb-2">
                                    </div>
                                </div>
                                <div class="separator"></div>

                                <div class="d-flex flex-column">
                                    <div class="mb-5 fv-row">
                                        <div class="d-flex flex-column mt-5">
                                            <div class="mb-5 fv-row">
                                                <label class="form-label">{{ translate('Icon') }}
                                                    ({{ translate('Translatable') }})
                                                </label>
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                        </div>
                                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                        <input type="hidden" name="types[]" value="footer_widget_images">
                                                        <input type="hidden" name="footer_widget_images[]" class="selected-files">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="separator"></div>

                            </div>

                        <!--end::User-->
                    </div>
                    <!--end::Header-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Feeds Widget 1-->
        </div>
        <!--end::Col-->
    </div>
</script>


@endsection
