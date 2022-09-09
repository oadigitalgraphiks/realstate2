@extends('backend.layouts.app')

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
               
            
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                        {{ translate('Property Bed Information') }}</h1>
                
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
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
                        <li class="breadcrumb-item text-muted">Property Bed</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">Edit Property Bed</li>
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
                                href="{{ route('property_bed.edit', ['id' => $property_bed->id, 'lang' => $language->code]) }}">
                                <img src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}" height="11"
                                    class="mr-1">
                                <span>{{ $language->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <br>
                <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10"
                    action="{{ route('property_bed.update', $property_bed->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf                    
                    <input type="hidden" name="lang" value="{{ $lang }}">
                
                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>General</h2>
                                </div>
                            </div>

                            <div class="card-body pt-0">
                                <div class="mb-5 fv-row">
                                    <label class="required form-label">{{ translate('Property Bed Name') }}</label>
                                    <input type="text" placeholder="{{ translate('Name') }}" id="name" name="name"
                                        class="form-control mb-2" value="{{ $property_bed->getTranslation('name', $lang) }}"
                                        required>
                                    <div class="text-muted fs-7">A property_bed name is required and recommended to be unique.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--begin::Media-->
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3>Media</h3>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="fv-row mb-2">
                                    <label class="form-label">{{ translate('Icon') }} <b>(120 x 120)</b></label>
                                    <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                        data-toggle="aizuploader" data-type="image" >
                                        <div class="dz-message needsclick">
                                            <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                            <input type="hidden" name="icon" class="selected-files"
                                                value="{{ $property_bed->icon }}">
                                            <div class="ms-4">
                                                <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="file-preview box sm"></div>
                                </div>
                                <div class="text-muted fs-7">
                                    {{ translate('These images are visible in Property Type Page Icon. Use 300x174 sizes images.') }}
                                </div>
                            </div>
                        </div>

                       
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{ translate('Meta Options') }}</h2>
                                </div>
                            </div>
                          
                            <div class="card-body pt-0">
                                <div class="mb-10">
                                    <label class="form-label">{{ translate('Meta Title') }}</label>
                                    <input type="text" class="form-control mb-2" name="meta_title"
                                        value="{{ $property_bed->meta_title }}"
                                        placeholder="{{ translate('Meta Title') }}" />
                                    <div class="text-muted fs-7">Set a meta tag title. Recommended to be simple and precise keywords.</div>
                                </div>

                                <div class="mb-10">
                                    <label class="form-label">{{ translate('Meta Description') }}</label>
                                    <textarea name="meta_description" rows="5"
                                        class="form-control mb-2">{{ $property_bed->meta_description }}</textarea>
                                    <div class="text-muted fs-7">Set a meta tag description to the property_bed for increased SEO ranking.</div>
                                </div>
                                <div class="mb-10">
                                    <label class="form-label">{{ translate('Slug') }}</label>
                                    <input type="text" class="form-control mb-2" placeholder="{{translate('Slug')}}" id="slug" name="slug" value="{{ $property_bed->slug }}"/>
                                </div>
                            </div>
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
                                    placeholder="{{ translate('Order Level') }}" value="{{ $property_bed->order_level }}">
                                <div class="text-muted fs-7">{{ translate('Higher number has high priority') }}</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" id="kt_ecommerce_add_property_bed_submit" class="btn btn-primary">
                                <span class="indicator-label">{{ translate('Update Changes') }}</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ static_asset('assets/backend/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ static_asset('assets/backend/js/custom/apps/ecommerce/catalog/save-category.js') }}"></script>
@endsection
