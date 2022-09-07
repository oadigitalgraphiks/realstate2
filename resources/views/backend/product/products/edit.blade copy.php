@extends('backend.layouts.app')

@section('content')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Product Form</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Home</a>
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
                        <li class="breadcrumb-item text-dark">{{ translate('Edit Product') }}</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center py-1">
                    <!--begin::Button-->
                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">Create</a>
                    <!--end::Button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Container-->
        </div>
        {{-- <div class="card card-flush py-4"> --}}

        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Form-->
                <div class="card card-flush py-4">
                    <ul class="nav nav-tabs nav-fill border-light">
                        @foreach (\App\Models\Language::all() as $key => $language)
                            <li class="nav-item">
                                <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"
                                    href="{{ route('products.admin.edit', ['id' => $product->id, 'lang' => $language->code]) }}">
                                    <img src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}" height="11"
                                        class="mr-1">
                                    <span>{{ $language->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <br>
                <form id="choice_form" class="form d-flex flex-column flex-lg-row gap-7 gap-lg-6"
                    action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="POST">
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="lang" value="{{ $lang }}">
                    @csrf
                    <!--begin::Main column-->

                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-6">
                        <!--begin:::Tabs-->
                        <div class="card card-flush py-4">
                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2 nav nav-tabs nav-fill border-light">
                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                        href="#kt_ecommerce_add_product_general">General</a>
                                </li>
                                <!--end:::Tab item-->
                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                        href="#kt_ecommerce_add_product_advanced">Advanced</a>
                                </li>
                                <!--end:::Tab item-->
                            </ul>
                        </div>
                        <!--end:::Tabs-->
                        <!--begin::Tab content-->
                        <div class="tab-content">
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-6">
                                    <!--begin::General options-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3>General</h3>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-6 fv-row">
                                                <label class="required form-label">{{ translate('Product Name') }}</label>
                                                <input type="text" class="form-control mb-2" name="name"
                                                    placeholder="{{ translate('Product Name') }}" onchange="update_sku()"
                                                    value="{{ $product->getTranslation('name', $lang) }}" required />
                                                <div class="text-muted fs-7">A product name is required and recommended to
                                                    be unique.</div>
                                            </div>
                                            <div class="mb-6 fv-row">
                                                <label class="required form-label">{{ translate('Slug') }}</label>
                                                <input type="text" class="form-control mb-2" name="slug"
                                                    placeholder="{{ translate('Product Name') }}" onchange="update_sku()"
                                                    value="{{ $product->slug }}" required />
                                                <div class="text-muted fs-7">Slug must be unique.</div>
                                            </div>
                                            <div class="row mb-6">
                                                <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                    <label class="required form-label">{{ translate('Unit') }}</label>
                                                    <input type="text" class="form-control mb-2" name="unit"
                                                        placeholder="{{ translate('Unit (e.g. KG, Pc etc)') }}"
                                                        value="{{ $product->getTranslation('unit', $lang) }}" required />
                                                </div>
                                                <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                    <label
                                                        class="required form-label">{{ translate('Minimum Purchase Qty') }}</label>
                                                    <input type="number" lang="en" class="form-control mb-2" name="min_qty"
                                                        value="@if ($product->min_qty <= 1){{ 1 }}@else{{ $product->min_qty }}@endif" min="1" required />
                                                </div>
                                            </div>
                                            <!--begin::Shipping-->
                                                <!--begin::Shipping form-->
                                                <div id="kt_ecommerce_add_product_shipping" class="mt-10">
                                                    <!--begin::Input group-->
                                                    <div class="mb-10 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="form-label">Weight</label>
                                                        <!--end::Label-->
                                                        <!--begin::Editor-->
                                                        <input type="text" name="weight" class="form-control mb-2"
                                                            placeholder="Product weight" value="{{$product->weight}}"  />
                                                        <!--end::Editor-->
                                                        <!--begin::Description-->
                                                        <div class="text-muted fs-7">Set a product weight in kilograms (kg).
                                                        </div>
                                                        <!--end::Description-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row">
                                                        <!--begin::Label-->
                                                        <label class="form-label">Dimension</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <div class="d-flex flex-wrap flex-sm-nowrap gap-3">
                                                            <input type="number" name="width" class="form-control mb-2"
                                                                placeholder="Width (w)" value="{{$product->width}}" />
                                                            <input type="number" name="height" class="form-control mb-2"
                                                                placeholder="Height (h)" value="{{$product->height}}" />
                                                            <input type="number" name="length" class="form-control mb-2"
                                                                placeholder="Lengtn (l)" value="{{$product->length}}" />
                                                        </div>
                                                        <!--end::Input-->
                                                        <!--begin::Description-->
                                                        <div class="text-muted fs-7">Enter the product dimensions in
                                                            centimeters (cm).</div>
                                                        <!--end::Description-->
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end::Shipping form-->
                                            <!--end::Shipping-->
                                            <div>
                                                <label
                                                    class="form-label">{{ translate('Product Description') }}</label>
                                                <textarea class="aiz-text-editor"
                                                    name="description">{{ $product->getTranslation('description', $lang) }}</textarea>
                                                <div class="text-muted fs-7">Set a description to the product for better
                                                    visibility.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::General options-->

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
                                                <label class="form-label">{{ translate('Thumbnail Image') }} <b>({{env('THUMBNAIL_IMAGE_WIDTH')}} x {{env('THUMBNAIL_IMAGE_HEIGHT')}})</b></label>
                                                <!--begin::Dropzone-->
                                                <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                                    data-toggle="aizuploader" data-type="image">
                                                    <!--begin::Message-->
                                                    <div class="dz-message needsclick">
                                                        <!--begin::Icon-->
                                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                        <!--end::Icon-->
                                                        <!--begin::Info-->
                                                        <input type="hidden" name="thumbnail_img" class="selected-files"
                                                            value="{{ $product->thumbnail_img }}">
                                                        <div class="ms-4">
                                                            <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Click to upload</h3>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                </div>
                                                <!--end::Dropzone-->
                                                <div class="file-preview box sm">
                                                </div>


                                            </div>
                                            <div class="text-muted fs-7">This image is visible in all product box. Use
                                                {{env('THUMBNAIL_IMAGE_WIDTH')}} x {{env('THUMBNAIL_IMAGE_HEIGHT')}} sizes image.
                                                <br>Keep some blank space around main object of your image as we had to crop
                                                <br> some edge in different devices to make it responsive.
                                            </div>
                                            <div class="fv-row mt-5 mb-2">
                                                <label class="form-label">{{ translate('Gallery Images') }} <b>({{env('GRALLERY_IMAGE_WIDTH')}} x {{env('GRALLERY_IMAGE_HEIGHT')}})</b></label>
                                                <!--begin::Dropzone-->
                                                <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                                    data-toggle="aizuploader" data-type="image" data-multiple="true">
                                                    <!--begin::Message-->
                                                    <div class="dz-message needsclick">
                                                        <!--begin::Icon-->
                                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                        <!--end::Icon-->
                                                        <!--begin::Info-->
                                                        <input type="hidden" name="photos" class="selected-files"
                                                            value="{{ $product->photos }}">
                                                        <div class="ms-4">
                                                            <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Click to upload.</h3>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                </div>
                                                <!--end::Dropzone-->
                                                <div class="file-preview box sm">
                                                </div>
                                            </div>
                                            <div class="text-muted fs-7">
                                                These images are visible in product details page gallery. Use {{env('GRALLERY_IMAGE_WIDTH')}} x {{env('GRALLERY_IMAGE_HEIGHT')}}  sizes images.
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::Media-->
                                    <!--begin::Video-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3>{{ translate('Product Videos') }}</h3>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-2">
                                                <label for="kt_ecommerce_add_product_store_template"
                                                    class="form-label">{{ translate('Video Provider') }}</label>
                                                <select class="form-select mb-2" data-control="select2"
                                                    data-hide-search="true" data-placeholder="Select an option"
                                                    id="video_provider" name="video_provider">
                                                    <option value="youtube" <?php if ($product->video_provider == 'youtube') {
                                                            echo 'selected';
                                                        } ?>>{{ translate('Youtube') }}
                                                    </option>
                                                    <option value="dailymotion" <?php if ($product->video_provider == 'dailymotion') {
                                                            echo 'selected';
                                                        } ?>>
                                                        {{ translate('Dailymotion') }}</option>
                                                    <option value="vimeo" <?php if ($product->video_provider == 'vimeo') {
                                                            echo 'selected';
                                                        } ?>>{{ translate('Vimeo') }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="fv-row mb-2">
                                                <label class="form-label">{{ translate('Video Link') }}</label>
                                                <input type="text" class="form-control mb-2" name="video_link"
                                                    placeholder="{{ translate('Video Link') }}"
                                                    value="{{ $product->video_link }}">
                                                <div class="text-muted fs-7">
                                                    {{ translate("Use proper link without extra parameter. Don't use short share link/embeded iframe code.") }}
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::Video-->

                                    <!--begin::PDF-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3>{{ translate('PDF Specification') }}</h3>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-2">
                                                <!--begin::Dropzone-->
                                                <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                                    data-toggle="aizuploader" data-multiple="true" data-type="document">
                                                    <!--begin::Message-->
                                                    <div class="dz-message needsclick">
                                                        <!--begin::Icon-->
                                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                        <!--end::Icon-->
                                                        <!--begin::Info-->
                                                        <input type="hidden" name="pdf" class="selected-files"
                                                            value="{{ $product->pdf }}">
                                                        <div class="ms-4">
                                                            <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Click to upload.</h3>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                </div>
                                                <!--end::Dropzone-->
                                                <div class="file-preview box sm">
                                                </div>
                                            </div>

                                            <!--end::Input group-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">
                                                {{ translate('These images are visible in product details page gallery. Use 600x600 sizes images.') }}
                                            </div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::PDF-->
                                    <!--begin::Today's & Flash DeaL-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3>{{ translate('Todays / Flash Deals') }}</h3>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-2">
                                                <!--begin::Dropzone-->
                                                <label
                                                    class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mb-5">
                                                    <span
                                                        class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">{{ translate('Todays Deal') }}</span>
                                                    <input class="form-check-input" type="checkbox" name="todays_deal"
                                                        value="1" @if ($product->todays_deal == 1) checked @endif>
                                                </label>
                                            </div>
                                            <div class="text-muted fs-7">
                                                {{ translate('Add this product on Todays deal') }}</div>
                                            <br><br>
                                            <div class="card-title">
                                                <h3>{{ translate('Flash Deals') }}</h3>
                                            </div>
                                            <div class="col-md-12 fv-row fv-plugins-icon-container">
                                                <div class="fv-row mb-2">
                                                    <label for="kt_ecommerce_add_product_store_template"
                                                        class="form-label">{{ translate('Add To Flash') }}</label>
                                                    <select class="form-select mb-2" data-control="select2"
                                                        data-hide-search="true" data-placeholder="Select an option"
                                                        name="flash_deal_id" id="flash_deal">
                                                        <option value="">Choose Flash Title</option>
                                                        @foreach (\App\Models\FlashDeal::where('status', 1)->get() as $flash_deal)
                                                            <option value="{{ $flash_deal->id }}"
                                                                @if ($product->flash_deal_product && $product->flash_deal_product->flash_deal_id == $flash_deal->id) selected @endif>
                                                                {{ $flash_deal->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                    <div class="fv-row mb-2">
                                                        <label class="form-label">{{ translate('Discount') }}</label>
                                                        <input type="number" name="flash_discount"
                                                            value="{{ $product->flash_deal_product ? $product->flash_deal_product->discount : '0' }}"
                                                            min="0" step="1" class="form-control mb-2">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                    <div class="fv-row mb-2">
                                                        <label
                                                            class="form-label">{{ translate('Discount Type') }}</label>
                                                        <select class="form-select mb-2" name="flash_discount_type"
                                                            data-control="select2" data-hide-search="true"
                                                            data-placeholder="Select an option">
                                                            <option value="amount" @if ($product->flash_deal_product && $product->flash_deal_product->discount_type == 'amount') selected @endif>
                                                                {{ translate('Flat') }}
                                                            </option>
                                                            <option value="percent" @if ($product->flash_deal_product && $product->flash_deal_product->discount_type == 'percent') selected @endif>
                                                                {{ translate('Percent') }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--end::Card header-->
                                            </div>

                                            <!--end::Card header-->
                                        </div>
                                        <!--End::Today's & Flash DeaL-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Tab pane-->
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-6">
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3>{{ translate('Product Variation') }}</h3>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="mb-6 fv-row row">
                                                <div class="col-md-10 fv-row fv-plugins-icon-container">
                                                    <label class="form-label">{{ translate('Colors') }}</label>
                                                    <select class="form-select mb-2" data-control="select2"
                                                        data-placeholder="Select an option" data-allow-clear="true"
                                                        name="colors[]" id="colors" multiple {{count(json_decode($product->colors)) > 0 ? '' : 'disabled' }} >
                                                        @foreach (\App\Models\Color::orderBy('name', 'asc')->get() as $key => $color)
                                                            <option value="{{ $color->code }}" <?php if (in_array($color->code, json_decode($product->colors))) {
                                                                        echo 'selected';
                                                                    } ?>>
                                                                <span><span
                                                                        class='size-15px d-inline-block mr-2 rounded border'
                                                                        style='background:{{ $color->code }}'></span><span>
                                                                        {{ $color->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2 fv-row fv-plugins-icon-container">
                                                    <p>&nbsp;</p>
                                                    <label
                                                        class="form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="colors_active" value="1" <?php if (count(json_decode($product->colors)) > 0) {
                                                                    echo 'checked';
                                                                } ?>>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mb-6 fv-row row">
                                                <label class="form-label">{{ translate('Attributes') }}</label>
                                                <select class="form-select mb-2" data-control="select2"
                                                    data-placeholder="Select an option" data-allow-clear="true"
                                                    name="choice_attributes[]" id="choice_attributes" multiple>
                                                    @foreach (\App\Models\Attribute::all() as $key => $attribute)
                                                        <option value="{{ $attribute->id }}" @if ($product->attributes != null && in_array($attribute->id, json_decode($product->attributes, true))) selected @endif>
                                                            {{ $attribute->getTranslation('name') }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <div class="text-muted fs-7">
                                                    {{ translate('Choose the attributes of this product and then input values of each attribute') }}
                                                </div>
                                                <br>
                                            </div>
                                            <div class="customer_choice_options" id="customer_choice_options">
                                                @foreach (json_decode($product->choice_options) as $key => $choice_option)
                                                    <div class="mb-6 fv-row row">
                                                        <div class="col-md-3">
                                                            <input type="hidden" name="choice_no[]"
                                                                value="{{ $choice_option->attribute_id }}">
                                                            <input type="text" class="form-control" name="choice[]" value="{{ optional(\App\Models\Attribute::find($choice_option->attribute_id))->getTranslation('name') }}" placeholder="{{ translate('Choice Title') }}" readonly>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select class="form-select mb-2 attribute_choice"
                                                                data-control="select2" data-placeholder="Select an option"
                                                                data-allow-clear="true"
                                                                name="choice_options_{{ $choice_option->attribute_id }}[]"
                                                                id="choice_options" multiple>
                                                                @foreach (\App\Models\AttributeValue::where('attribute_id', $choice_option->attribute_id)->get() as $row)
                                                                    <option value="{{ $row->value }}"
                                                                        @if (in_array($row->value, $choice_option->values)) selected @endif>
                                                                        {{ $row->value }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>

                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    @if (addon_is_activated("warehouse") == true)
                                        <div class="card card-flush py-4">
                                            <!--begin::Card header-->
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h3>{{ translate('Warehouse') }}</h3>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="mb-6 fv-row">
                                                    <label class="required form-label">{{ translate('Warehouse') }}</label>
                                                    <select class="form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Select an option" id="warehouse_id" name="warehouse_id" data-live-search="true">
                                                    <option value="0">{{ translate('No Parent') }}</option>
                                                    @foreach (App\Models\Warehouse::where('status',1)->get() as $warehouse)
                                                        <option value="{{ $warehouse->id }}" >
                                                            {{ $warehouse->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                    <!--end::Description-->
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <!--begin::Pricing-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3>{{ translate('Product Price + Stock') }}</h3>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="mb-6 fv-row">
                                                <label class="required form-label">{{ translate('Unit price') }}</label>
                                                <input type="number" lang="en" min="0" value="{{ $product->unit_price }}"
                                                    step="0.01" placeholder="{{ translate('Unit price') }}"
                                                    name="unit_price" class="form-control mb-2" required>
                                                <div class="text-muted fs-7">Set the product price.</div>
                                                <!--end::Description-->
                                            </div>
                                            @php
                                                $start_date = date('d-m-Y H:i:s', $product->discount_start_date);
                                                $end_date = date('d-m-Y H:i:s', $product->discount_end_date);
                                            @endphp
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
                                                            data-separator=" to " autocomplete="off" @if($product->discount_start_date && $product->discount_end_date) value="{{ $start_date.' to '.$end_date }}" @endif>
                                                    </div>

                                                    <!--begin::Input group-->
                                                    <div class="fv-row w-100 flex-md-root pb-5">
                                                        <!--begin::Label-->
                                                        <label
                                                            class="form-label">{{ translate('Discount Type') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Select2-->
                                                        <select class="form-select mb-2" name="discount_type"
                                                            data-control="select2" data-hide-search="true"
                                                            data-placeholder="Select an option">
                                                            <option value="amount" <?php if ($product->discount_type == 'amount') echo "selected"; ?>>{{ translate('Flat') }}</option>
                                                            <option value="percent" <?php if ($product->discount_type == 'percent') echo "selected"; ?>>{{ translate('Percent') }}</option>
                                                        </select>
                                                        <!--end::Select2-->
                                                        <!--begin::Description-->
                                                        <div class="text-muted fs-7">
                                                            {{ translate('Set the product discount type') }}.</div>
                                                        <!--end::Description-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row w-100 flex-md-root">
                                                        <!--begin::Label-->
                                                        <label class="form-label">{{ translate('Discount Amount') }}
                                                            (%)</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="number" lang="en" min="0" step="0.01"
                                                            placeholder="{{ translate('Discount') }}" name="discount"
                                                            class="form-control mb-2" value="{{ $product->discount }}" required>
                                                        <!--end::Input-->
                                                        <!--begin::Description-->
                                                        <div class="text-muted fs-7">
                                                            {{ translate('Set the product VAT about') }}.</div>
                                                        <!--end::Description-->
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                            <!--end:Discount-->
                                            <!--begin::Tax-->
                                            <div id="show-hide-div">
                                                <div class="row mb-6">
                                                    <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                        <label
                                                            class="required form-label">{{ translate('Quantity') }}</label>
                                                        <input type="number" class="form-control mb-2" lang="en" min="0"
                                                            value="{{ optional($product->stocks->first())->qty }}"
                                                            step="1" placeholder="{{ translate('Quantity') }}"
                                                            name="current_stock" required />
                                                    </div>
                                                    <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                        <label class=" form-label">{{ translate('SKU') }}</label>
                                                        <input type="text" placeholder="{{ translate('sku') }}"
                                                            name="sku" class="form-control mb-2"
                                                            value="{{ optional($product->stocks->first())->sku }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-6">
                                                <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                    <label
                                                        class="required form-label">{{ translate('External link') }}</label>
                                                    <input type="text" class="form-control mb-2" name="external_link"
                                                        placeholder="{{ translate('Leave it blank if you do not use external site link') }}"
                                                        value="{{ $product->external_link }}" />
                                                    <div class="text-muted fs-7">
                                                        {{ translate('Leave it blank if you do not use external site link') }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                    <label
                                                        class="required form-label">{{ translate('External link button text') }}</label>
                                                    <input type="text"
                                                        placeholder="{{ translate('External link button text') }}"
                                                        name="external_link_btn" class="form-control mb-2"
                                                        value="{{ $product->external_link_btn }}">
                                                    <div class="text-muted fs-7">
                                                        {{ translate('Leave it blank if you do not use external site link') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="sku_combination" id="sku_combination">

                                            </div>
                                            <!--end::Input group-->


                                            <!--begin::Tax-->
                                            @foreach (\App\Models\Tax::where('tax_status', 1)->get() as $tax)
                                                <div class="card-title">
                                                    <h3>{{ $tax->name }}</h3>
                                                    <input type="hidden" value="{{ $tax->id }}" name="tax_id[]">
                                                </div>
                                                @php
                                                    $tax_amount = 0;
                                                    $tax_type = '';
                                                    foreach ($tax->product_taxes as $row) {
                                                        if ($product->id == $row->product_id) {
                                                            $tax_amount = $row->tax;
                                                            $tax_type = $row->tax_type;
                                                        }
                                                    }
                                                @endphp
                                                <div class="d-flex flex-wrap gap-5">
                                                    <!--begin::Input group-->

                                                    <div class="fv-row w-100 flex-md-root">
                                                        <!--begin::Label-->
                                                        <label
                                                            class="required form-label">{{ translate('Tax Type') }}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Select2-->
                                                        <select class="form-select mb-2" name="tax_type[]"
                                                            data-control="select2" data-hide-search="true"
                                                            data-placeholder="Select an option">
                                                            <option value="amount" @if ($tax_type == 'amount') selected @endif>
                                                                {{ translate('Flat') }}
                                                            </option>
                                                            <option value="percent" @if ($tax_type == 'percent') selected @endif>
                                                                {{ translate('Percent') }}
                                                            </option>
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
                                                        <input type="number" lang="en" min="0" value="{{ $tax_amount }}"
                                                            step="0.01" placeholder="{{ translate('Tax') }}" name="tax[]"
                                                            class="form-control mb-2" required>
                                                        <!--end::Input-->
                                                        <!--begin::Description-->
                                                        <div class="text-muted fs-7">Set the product VAT about.</div>
                                                        <!--end::Description-->
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end:Tax-->
                                            @endforeach
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::Pricing-->
                                    <!--begin::Variations-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3>Variations</h3>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class=""
                                                data-kt-ecommerce-catalog-add-product="auto-options">
                                                <div class="mb-6">
                                                    <!--begin::Heading-->
                                                    <div class="mb-3">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-5 fw-bold">
                                                            <span class="required">{{ translate('Stock Visibility State') }}</span>
                                                        </label>

                                                    </div>
                                                    <!--end::Heading-->
                                                    <!--begin::Row-->
                                                    <div
                                                        class="fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
                                                        <!--begin::Radio group-->
                                                        <div class="btn-group w-100" data-kt-buttons="true"
                                                            data-kt-buttons-target="[data-kt-button]">
                                                            <!--begin::Radio-->
                                                            <label
                                                                class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success {{$product->stock_visibility_state == 'quantity' ? 'active' : '' }}"
                                                                data-kt-button="true">
                                                                <input class="btn-check" type="radio"
                                                                    name="stock_visibility_state" value="quantity"
                                                                    @if ($product->stock_visibility_state == 'quantity') checked @endif>
                                                                {{ translate('Show Stock Quantity') }}</label>
                                                            <label
                                                                class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success {{$product->stock_visibility_state == 'text' ? 'active' : '' }}"
                                                                data-kt-button="true">
                                                                <!--begin::Input-->
                                                                <input class="btn-check" type="radio"
                                                                    name="stock_visibility_state" value="text"
                                                                    @if ($product->stock_visibility_state == 'text') checked @endif>
                                                                <!--end::Input-->
                                                                {{ translate('Show Stock With Text Only') }}
                                                            </label>
                                                            <!--end::Radio-->
                                                            <!--begin::Radio-->
                                                            <label
                                                                class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success {{$product->stock_visibility_state == 'hide' ? 'active' : '' }}"
                                                                data-kt-button="true">
                                                                <!--begin::Input-->
                                                                <input class="btn-check" type="radio"
                                                                    name="stock_visibility_state" value="hide"
                                                                    @if ($product->stock_visibility_state == 'hide') checked @endif>
                                                                <!--end::Input-->
                                                                {{ translate('Hide Stock') }}
                                                            </label>

                                                        </div>
                                                        <!--end::Radio group-->
                                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    </div>
                                                    <!--end::Row-->
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::Variations-->

                                    <!--begin::Meta options-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3>{{ translate('SEO Meta Tags') }}</h3>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label">{{ translate('Meta Title') }}</label>
                                                <input type="text" class="form-control mb-2" name="meta_title"
                                                    value="{{ $product->meta_title }}" placeholder="Meta tag name" />
                                                <div class="text-muted fs-7">Set a meta tag title. Recommended to be simple
                                                    and precise keywords.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label">{{ translate('Description') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea class="aiz-text-editor"
                                                    name="meta_description">{{ $product->meta_description }}</textarea>
                                                <!--end::Editor-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">
                                                    {{ translate('Set a meta tag description to the product for increased SEO ranking') }}.
                                                </div>
                                                <!--end::Description-->
                                            </div>
                                            <div class="fv-row mb-2">
                                                <!--begin::Dropzone-->
                                                <label class="form-label">{{ translate('Meta Images') }}</label>
                                                <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                                    data-toggle="aizuploader" data-type="image">
                                                    <!--begin::Message-->
                                                    <div class="dz-message needsclick">
                                                        <!--begin::Icon-->
                                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                        <!--end::Icon-->
                                                        <!--begin::Info-->
                                                        <input type="hidden" name="meta_img" class="selected-files"
                                                            value="{{ $product->meta_img }}">
                                                        <div class="ms-4">
                                                            <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Click to upload</h3>
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
                                    <!--end::Meta options-->
                                </div>
                            </div>
                            <!--end::Tab pane-->
                        </div>
                        <!--end::Tab content-->


                    </div>
                    <!--end::Main column-->

                    <div class="d-flex flex-column gap-7 gap-lg-6 w-100 w-lg-300px">
                        <!--begin::Category & tags-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h3>Product Details</h3>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <label class="form-label">{{ translate('Categories') }}</label>
                                <select class="form-select mb-2" data-control="select2" data-placeholder="Select an option"
                                    data-allow-clear="true" name="category_id" id="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if ($product->category_id == $category->id) selected @endif>
                                            {{ $category->getTranslation('name') }}</option>
                                        @foreach ($category->childrenCategories as $childCategory)
                                            @include('categories.child_category', ['child_category' => $childCategory])
                                        @endforeach
                                    @endforeach
                                </select>

                                <div class="text-muted fs-7 mb-7">Add product to a category.</div>
                                <a href="{{ route('categories.create') }}" class="btn btn-light-primary btn-sm mb-10">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none">
                                            <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1"
                                                transform="rotate(-90 11 18)" fill="black" />
                                            <rect x="6" y="11" width="12" height="2" rx="1" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->Create new category
                                </a>
                                <br>
                                <label class="form-label">{{ translate('Brand') }}</label>
                                <select class="form-select mb-2" data-control="select2" data-placeholder="Select an option"
                                    data-allow-clear="true" name="brand_id" id="brand_id">
                                    <option value="">{{ translate('Select Brand') }}</option>
                                    @foreach (\App\Models\Brand::all() as $brand)
                                        <option value="{{ $brand->id }}" @if ($product->brand_id == $brand->id) selected @endif>
                                            {{ $brand->getTranslation('name') }}</option>
                                    @endforeach
                                </select>
                                <div class="text-muted fs-7 mb-7">Add product to a brand.</div>

                                <a href="{{ route('brands.index') }}" class="btn btn-light-primary btn-sm mb-10">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none">
                                            <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1"
                                                transform="rotate(-90 11 18)" fill="black" />
                                            <rect x="6" y="11" width="12" height="2" rx="1" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->Create new Brand
                                </a>
                                <!--begin::Label-->
                                <label class="form-label d-block">Tags</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input id="kt_ecommerce_add_product_tags" class="form-control mb-2" name="tags[]"
                                    placeholder="{{ translate('Type & add tag') }}"
                                    value="{{ $product->tags }}">
                                <div class="text-muted fs-7">
                                    <span class="text-danger"> {{ translate('Type & hit enter add tag') }}.</span>
                                    {{ translate('This is used for search. Input those words by which customer can find this product.') }}
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h3>{{ translate('Cash On Delivery') }}</h3>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                @if (get_setting('cash_payment') == '1')
                                    <div class="mb-4">
                                        <label
                                            class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mb-5">
                                            <span
                                                class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">{{ translate('Status') }}</span>
                                            <input class="form-check-input" type="checkbox" name="cash_on_delivery"
                                                value="1" @if ($product->cash_on_delivery == 1) checked @endif>
                                        </label>
                                    @else
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">
                                            {{ translate('Cash On Delivery option is disabled. Activate this feature from here') }}
                                            <a href="{{ route('activation.index') }}"
                                                class="aiz-side-nav-link {{ areActiveRoutes(['shipping_configuration.index', 'shipping_configuration.edit', 'shipping_configuration.update']) }}">
                                                <span
                                                    class="aiz-side-nav-text">{{ translate('Cash Payment Activation') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h3> {{ translate('Shipping Configuration') }}</h3>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                @if (get_setting('shipping_type') == 'product_wise_shipping')
                                    <div class="mb-4">
                                        <!--begin::Option-->
                                        <label
                                            class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mb-5">
                                            <span
                                                class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">{{ translate('Free Shipping') }}</span>
                                            <input class="form-check-input" type="radio" name="shipping_type"
                                                checked="checked" value="free" @if ($product->shipping_type == 'free') checked @endif>
                                        </label>
                                        <!--end::Option-->
                                        <!--begin::Option-->
                                        <label
                                            class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mb-5">
                                            <span
                                                class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">{{ translate('Flat Rate') }}</span>
                                            <input class="form-check-input" type="radio" name="shipping_type"
                                                value="flat_rate" @if ($product->shipping_type == 'flat_rate') checked @endif>
                                        </label>

                                        <div class="col-md-12 fv-row fv-plugins-icon-container flat_rate_shipping_div"
                                            style="display: none">
                                            <label class=" form-label">{{ translate('Shipping cost') }}</label>
                                            <input type="number" lang="en" min="0" value="{{ $product->shipping_cost }}"
                                                step="0.01" placeholder="{{ translate('Shipping cost') }}"
                                                name="flat_shipping_cost" class="form-control mb-2" required>
                                        </div>
                                        <label
                                            class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                            <span
                                                class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">{{ translate('Is Product Quantity Mulitiply') }}</span>
                                            <input class="form-check-input" type="checkbox" name="is_quantity_multiplied"
                                                value="1" @if ($product->is_quantity_multiplied == 1) checked @endif>
                                        </label>
                                    </div>
                                @else
                                    <div class="mb-4">
                                        <p>
                                            {{ translate('Product wise shipping cost is disable. Shipping cost is configured from here') }}
                                            <a href="{{ route('shipping_configuration.index') }}"
                                                class="aiz-side-nav-link {{ areActiveRoutes(['shipping_configuration.index', 'shipping_configuration.edit', 'shipping_configuration.update']) }}">
                                                <span
                                                    class="aiz-side-nav-text">{{ translate('Shipping Configuration') }}</span>
                                            </a>
                                        </p>
                                    </div>
                                @endif
                            </div>
                            <!--end::Card body-->
                        </div>
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h3> {{ translate('Low Stock Quantity Warning') }}</h3>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <div class="mb-4">
                                    <!--begin::Option-->
                                    <label for="kt_ecommerce_add_product_store_template"
                                        class="form-label">{{ translate('Quantity') }}</label>
                                    <input type="number" name="low_stock_quantity"
                                        value="{{ $product->low_stock_quantity }}" min="0" step="1"
                                        class="form-control mb-2">

                                    <!--end::Option-->
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>

                        @if (addon_is_activated('pos_system'))
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h3>{{ translate('Barcode') }}</h3>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="mb-4">
                                        <!--begin::Option-->
                                        <label for="kt_ecommerce_add_product_store_template"
                                            class="form-label">{{ translate('Barcode') }}</label>
                                        <input type="text" class="form-control mb-2" name="barcode"
                                            placeholder="{{ translate('Barcode') }}"
                                            value="{{ $product->barcode }}">

                                        <!--end::Option-->
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                        @endif
                        @if (addon_is_activated('club_point'))
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h3>{{ translate('Set Point') }}</h3>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="mb-4">
                                        <!--begin::Option-->
                                        <label for="kt_ecommerce_add_product_store_template"
                                            class="form-label">{{ translate('Set Point') }}</label>
                                        <input type="number" lang="en" min="0" value="0" step="1"
                                            placeholder="{{ translate('1') }}" name="earn_point"
                                            class="form-control mb-2">

                                        <!--end::Option-->
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                        @endif
                        @if (addon_is_activated('refund_request'))
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h3>{{ translate('Refundable') }}</h3>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="mb-4">
                                        <label
                                            class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mb-5">
                                            <span
                                                class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">{{ translate('Refundable') }}</span>
                                            <input class="form-check-input" type="checkbox" name="refundable" value="1"
                                                @if ($product->refundable == 1) checked @endif>
                                        </label>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                        @endif

                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h3>{{ translate('Estimate Shipping Time') }}</h3>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <div class="mb-4">
                                    <!--begin::Option-->
                                    <label for="kt_ecommerce_add_product_store_template"
                                        class="form-label">{{ translate('Shipping Days') }}</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control mb-2" name="est_shipping_days"
                                            value="{{ $product->est_shipping_days }}" min="1" step="1"
                                            placeholder="{{ translate('Shipping Days') }}">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                id="inputGroupPrepend">{{ translate('Days') }}</span>
                                        </div>
                                    </div>

                                    <!--end::Option-->
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>

                        <!--end::Template settings-->
                    </div>



                    <!--end::Form-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
        {{-- </div> --}}
    </div>
    <div class="container mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-end">
                <button type="submit" name="button" value="draft" id="kt_ecommerce_add_product_submit"
                    class="btn btn-warning mx-2">
                    <span class="indicator-label">{{ translate('Save As Draft') }}s</span>
                    <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                <button type="submit" name="button" value="unpublish" id="kt_ecommerce_add_product_submit"
                    class="btn btn-primary mx-2">
                    <span class="indicator-label">{{ translate('Save & Unpublish') }}</span>
                    <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                <button type="submit" name="button" value="publish" id="kt_ecommerce_add_product_submit"
                    class="btn btn-success mx-2">
                    <span class="indicator-label">{{ translate('Save & Publish') }}</span>
                    <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                <!--end::Button-->
            </div>
        </div>
    </div>
    </form>



@endsection

@section('script')
    <script src="{{ static_asset('assets/backend/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ static_asset('assets/backend/js/custom/apps/ecommerce/catalog/save-product.js') }}"></script>
    <script type="text/javascript">
        $('form').bind('submit', function(e) {
            // Disable the submit button while evaluating if the form should be submitted
            // $("button[type='submit']").prop('disabled', true);
            $("button[type='submit']").hide();

            var valid = true;

            if (!valid) {
                e.preventDefault();

                // Reactivate the button if the form was not submitted
                // $("button[type='submit']").button.prop('disabled', false);
                $("button[type='submit']").show();
            }
        });

        $(document).ready(function() {
            show_hide_shipping_div();
        });

        $("[name=shipping_type]").on("change", function() {
            show_hide_shipping_div();
        });

        function show_hide_shipping_div() {
            var shipping_val = $("[name=shipping_type]:checked").val();

            $(".flat_rate_shipping_div").hide();

            if (shipping_val == 'flat_rate') {
                $(".flat_rate_shipping_div").show();
            }
        }

        function add_more_customer_choice_option(i, name) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '{{ route('products.add-more-choice-option') }}',
                data: {
                    attribute_id: i
                },
                success: function(data) {
                    var obj = JSON.parse(data);
                    $('#customer_choice_options').append('\
                    <div class="mb-6 fv-row row">\
                        <div class="col-md-3">\
                            <input type="hidden" name="choice_no[]" value="' + i + '">\
                            <input type="text" class="form-control" name="choice[]" value="'+ name +'" placeholder="{{ translate('Choice Title') }}" readonly>\
                        </div>\
                        <div class="col-md-8">\
                            <select class="form-select mb-2 attribute_choice" data-control="select2" data-hide-search="false" data-live-search="true" name="choice_options_' + i + '[]" multiple>\
                                ' + obj + '\
                            </select>\
                        </div>\
                    </div>');
                    $(".attribute_choice").select2();
                    AIZ.plugins.bootstrapSelect('refresh');
                }
            });
        }

        $('input[name="colors_active"]').on('change', function() {
            if (!$('input[name="colors_active"]').is(':checked')) {
                $('#colors').prop('disabled', true);
                AIZ.plugins.bootstrapSelect('refresh');
            } else {
                $('#colors').prop('disabled', false);
                AIZ.plugins.bootstrapSelect('refresh');
            }
            update_sku();
        });

        $(document).on("change", ".attribute_choice", function() {
            update_sku();
        });

        $('#colors').on('change', function() {
            update_sku();
        });

        function delete_row(em) {
            $(em).closest('.form-group').remove();
            update_sku();
        }

        function delete_variant(em) {
            $(em).closest('.variant').remove();
        }

        function update_sku() {
            $.ajax({
                type: "POST",
                url: '{{ route('products.sku_combination_edit') }}',
                data: $('#choice_form').serialize(),
                success: function(data) {
                    $('#sku_combination').html(data);
                    AIZ.uploader.previewGenerate();
                    AIZ.plugins.fooTable();
                    if (data.length > 1) {
                        $('#show-hide-div').hide();
                    } else {
                        $('#show-hide-div').show();
                    }
                }
            });
        }

        AIZ.plugins.tagify();

        $(document).ready(function() {
            update_sku();

            $('.remove-files').on('click', function() {
                $(this).parents(".col-md-4").remove();
            });
        });

        $('#choice_attributes').on('change', function() {
            $.each($("#choice_attributes option:selected"), function(j, attribute) {
                flag = false;
                $('input[name="choice_no[]"]').each(function(i, choice_no) {
                    if ($(attribute).val() == $(choice_no).val()) {
                        flag = true;
                    }
                });
                if (!flag) {
                    add_more_customer_choice_option($(attribute).val(), $(attribute).text());
                }
            });

            var str = @php echo $product->attributes @endphp;

            $.each(str, function(index, value) {
                flag = false;
                $.each($("#choice_attributes option:selected"), function(j, attribute) {
                    if (value == $(attribute).val()) {
                        flag = true;
                    }
                });
                if (!flag) {
                    $('input[name="choice_no[]"][value="'+ value +'"]').parent().parent().remove();
                }
            });

            update_sku();
        });
    </script>

@endsection
