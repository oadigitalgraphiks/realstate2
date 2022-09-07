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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Flash Deals</h1>
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
                        <li class="breadcrumb-item text-muted">Marketing</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">Flash Deal Create</li>
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
                    action="{{ route('flash_deals.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{ translate('Flash Deal Information') }}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-5 fv-row">
                                    <label class="required form-label">{{ translate('Title') }}</label>
                                    <input type="text" placeholder="{{ translate('Title') }}" id="title" name="title"
                                        class="form-control mb-2" onkeyup="makeSlug(this.value)" required>
                                </div>

                                <div class="mb-5 fv-row">
                                    <label class="required form-label">{{ translate('Background Color') }}
                                        <small>(Hexa-code)</small></label>
                                    <input type="text" placeholder="{{ translate('#FFFFFF') }}" id="background_color"
                                        name="background_color" class="form-control mb-2" required>
                                </div>

                                <!--begin::Input group-->
                                <div class="fv-row mb-2">
                                    <label for="required kt_ecommerce_add_product_store_template"
                                        class="form-label">{{ translate('Text Color') }}</label>
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                        data-placeholder="Select an option" id="text_color" name="text_color"
                                        data-live-search="true">
                                        <option value="">{{ translate('Select One') }}</option>
                                        <option value="white">{{ translate('White') }}</option>
                                        <option value="dark">{{ translate('Dark') }}</option>
                                    </select>
                                </div>

                                <div class="fv-row mt-5 mb-2">
                                    <label class="form-label">{{ translate('Banner') }}</label>
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
                                                <h3 class="fs-5 fw-bolder text-gray-900 mb-1">
                                                    {{ translate('Drop files here or click
                                                                                                    to upload') }}.
                                                </h3>
                                                <span
                                                    class="fs-7 fw-bold text-gray-400">{{ translate('Banner Image size') }}
                                                    <small>(1920x500)</small> <br>
                                                    {{ translate('This image is shown as cover banner in flash deal details page.') }}
                                                </span>
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

                                <div class="mb-6 fv-row">
                                    <label class="form-label" for="start_date">{{ translate('Date') }}</label>
                                    <input type="text" class="form-control aiz-date-range mb-2" name="date_range"
                                        placeholder="{{ translate('Select Date') }}" data-time-picker="true"
                                        data-format="DD-MM-Y HH:mm:ss" data-separator=" to " autocomplete="off">
                                </div>


                                <div class="fv-row mb-2">
                                    <label for="required kt_ecommerce_add_product_store_template"
                                        class="form-label">{{ translate('Products') }}</label>
                                    <select class="form-select mb-2 js-data-example-ajax" data-control="select2"
                                        data-hide-search="false" data-placeholder="Select an option" name="products[]"
                                        id="products" data-live-search="true" multiple="multiple" data-select>

                                    </select>
                                    <div
                                        class="notice d-flex bg-light-danger rounded border-danger border border-dashed p-6">
                                        <span class="fs-7 fw-bold">
                                            {{ translate('If any product has discount or exists in another flash deal, the discount will be replaced by this discount & time limit.') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="fv-row mb-2 form-group">
                                    <div class="table-responsive" id="discount_table">

                                    </div>
                                </div>

                            </div>

                            <div class="d-flex justify-content-end">

                                <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                    <span class="indicator-label">{{ translate('Save') }}</span>
                                    <span class="indicator-progress">{{ translate('Please wait') }}...
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
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {

            $(".js-data-example-ajax").select2({
                ajax: {
                    url: "{{ route('flash_deal.search') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;
                        // console.log(data);
                        // console.log(data.data[0].items);
                        // console.log(params);
                        // return
                        return {
                            results: data.items,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a product',
                minimumInputLength: 1,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });

            function formatRepo(repo) {
                if (repo.loading) {
                    return repo.text;
                }

                var $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'></div>" +
                    "<div class='select2-result-repository__description'></div>" +
                    "</div>" +
                    "</div>"
                );

                $container.find(".select2-result-repository__title").text(repo.name);
                // $container.find(".select2-result-repository__description").text(repo.description);

                return $container;
            }

            function formatRepoSelection(repo) {
                return repo.name || repo.text;
            }

            $('#products').on('change', function() {
                var product_ids = $('#products').val();
                if (product_ids.length > 0) {
                    $.post('{{ route('flash_deals.product_discount') }}', {
                        _token: '{{ csrf_token() }}',
                        product_ids: product_ids
                    }, function(data) {
                        $('#discount_table').html(data);
                        AIZ.plugins.fooTable();
                    });
                } else {
                    $('#discount_table').html(null);
                }
            });
        });
    </script>
@endsection
