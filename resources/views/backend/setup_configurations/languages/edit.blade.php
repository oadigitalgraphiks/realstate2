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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Languages</h1>
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
                    <li class="breadcrumb-item text-muted">Setup & Configuration</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Language Edit</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <div class="row g-5 g-xl-8">
        <div class="col-xl-6 mx-auto">
            <div class="card card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <h5 class="mb-0 h6">{{translate('Language Information')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('languages.update', $language->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-xl-3">
                                <label for="required kt_ecommerce_add_product_store_template"
                                class="form-label">{{ translate('Name') }}</label>
                            </div>
                            <div class="col-xl-9">
                                <input type="text" class="form-control" name="name" value="{{ $language->name }}" placeholder="{{ translate('Name') }}" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-xl-3">
                                <label for="required kt_ecommerce_add_product_store_template"
                                class="form-label">{{ translate('Code') }}</label>
                            </div>
                            <div class="col-xl-9">
                                @php
                                    $languagesArray = \App\Models\Language::pluck('code')->toarray();
                                    if (($key = array_search($language->code, $languagesArray)) !== false) {
                                        unset($languagesArray[$key]);
                                    }
                                @endphp
                                <select class="form-select mb-2" data-control="select2" name="code" data-live-search="true">
                                    @foreach(\File::files(base_path('public/assets/img/flags')) as $path)
                                        @if(!in_array(pathinfo($path)['filename'],$languagesArray))
                                        <option
                                            value="{{ pathinfo($path)['filename'] }}"
                                            @if($language->code == pathinfo($path)['filename']) selected @endif>
                                            <div class=''><img src='{{ static_asset('assets/img/flags/'.pathinfo($path)['filename'].'.png') }}' class='mr-2'><span>{{ strtoupper(pathinfo($path)['filename']) }}</span></div>
                                        </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-xl-3">
                                <label for="required kt_ecommerce_add_product_store_template"
                                class="form-label">{{ translate('Flutter App Lang Code') }}</label>
                                <code>
                                    <a target="_blank" href="https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes">{{ translate("Links for ISO 639-1 codes")}}</a>
                                </code>
                            </div>
                            <div class="col-xl-9">
                                <input type="text" class="form-control" name="app_lang_code" placeholder="{{ translate('Put ISO 639-1 code for your language') }}" value="{{ $language->app_lang_code }}" required>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
