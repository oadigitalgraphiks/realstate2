@extends('backend.layouts.app')
@section('content')
    @php
    $lang = Session::get('locale') ?? env('DEFAULT_LANGUAGE');
    @endphp


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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Sliders</h1>
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
                        <li class="breadcrumb-item text-dark">All Sliders / Create Slider</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>

        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <div class="row">

                    <div class="col-md-7">
                        <div class="card card-flush">
                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                <div class="col text-md-left">
                                    <h5 class="mb-md-0 h6">{{ translate('Sliders') }}</h5>
                                </div>
                                <div class="col-md-4">
                                    <form class="" id="sort_sliders" action="" method="GET">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" id="search" name="search"
                                                @isset($sort_search) value="{{ $sort_search }}" @endisset
                                                placeholder="{{ translate('Type name & Enter') }}">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ translate('Title1') }}</th>
                                                <th>{{ translate('Image') }}</th>
                                                <th>{{ translate('Status') }}</th>
                                                <th class="text-right">{{ translate('Options') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sliders as $key => $slider)
                                                <tr>
                                                    <td>{{ $slider->id }}</td>
                                                    <td>{{ $slider->getTranslation('title1') }}</td>
                                                    <td>
                                                        <img src="{{ uploaded_asset($slider->photo) }}"
                                                            alt="{{ translate('slider photo') }}" class="h-50px">
                                                    </td>
                                                    <td style="text-transform: uppercase">
                                                        <label
                                                            class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                                            <span
                                                                class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                                                <input class="form-check-input" onchange="updatestatus(this)" type="checkbox"
                                                                    {{ $slider->status == 1 ? 'checked' : '' }} value="{{ $slider->id }}">
                                                            </span>
                                                        </label>
                                                    </td>
                                                    <td class="text-right">
                                                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                            href="{{ route('slider.edit', ['id' => $slider->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                                            title="{{ translate('Edit') }}">
                                                            <i class="las la-edit"></i>
                                                        </a>
                                                        <a href="#"
                                                            class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                            data-href="{{ route('slider.destroy', $slider->id) }}"
                                                            title="{{ translate('Delete') }}">
                                                            <i class="las la-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="aiz-pagination">
                                    {{ $sliders->appends(request()->input())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-flush">
                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                <h5 class="mb-0 h6">{{ translate('Add New Slider') }}</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('slider.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="name">{{ translate('Title1') }}</label>
                                       <textarea type="text" placeholder="{{translate('Title1')}}" id="title1" name="title1" class="form-control"   autofocus></textarea>
                                    </div>
                                    <div class="form-group mb-3 d-none">
                                        <label for="name">{{ translate('Title2') }}</label>
                                        <input type="text" placeholder="{{ translate('Title2') }}" name="title2"
                                            class="form-control">
                                    </div>
                                    <div class="form-group mb-3 d-none">
                                        <label for="name">{{ translate('Button Text') }}</label>
                                        <input type="text" placeholder="{{ translate('Button Text') }}" name="button_text"
                                            class="form-control">
                                    </div>
                                    <div class="form-group mb-3 d-none">
                                        <label for="name">{{ translate('Link With') }}</label>
                                        <select class="form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Select an option" id="type" name="type"
                                            data-live-search="true">
                                            <option value="">{{ translate('Link with') }}</option>
                                            <option value="category">{{ translate('Categories') }}</option>
                                            <option value="brand">{{ translate('Brands') }}</option>
                                            <option value="custom">{{ translate('Custom') }}</option>
                                        </select>
                                    </div>
                                    {{-- categories --}}
                                    <div class="form-group mb-3" id="category_row" style="display: none">
                                        <label for="name">{{ translate('Select Category') }}</label>
                                        <select class="form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Select an option" id="category_id" name="category_id"
                                            data-live-search="true">
                                            <option value="">{{ translate('No Parent') }}</option>
                                            @foreach ($categories as $acategory)
                                                <option value="{{ $acategory->id }}">
                                                    {{ $acategory->getTranslation('name') }} </option>
                                                @foreach ($acategory->childrenCategories as $childCategory)
                                                    <option value="{{ $childCategory->id }}">-
                                                        {{ $childCategory->getTranslation('name') }}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- brands --}}
                                    <div class="form-group" id="brand_row" style="display: none">
                                        <label for="name">{{ translate('Select Brand') }}</label>
                                        <select class="form-select mb-2" data-control="select2" data-hide-search="false"data-placeholder="Select an option" id="brand_id" name="brand_id"
                                            data-live-search="true">
                                            <option value="">{{ translate('Select Brand') }}</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">
                                                    {{ $brand->getTranslation('name', $lang) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- custom link --}}
                                    <div class="form-group" id="custom_row" style="display: none">
                                        <label for="name">{{ translate('URL') }}</label>
                                        <input type="text" name="link" class="form-control" id="name"
                                            placeholder="{{ translate('Custom URL') }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">{{ translate('Sorting Id') }}</label>
                                        <input type="number" placeholder="0" name="sorting_id" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">{{ translate('Photo') }}
                                            <small>({{ env('SLIDER_IMAGE_WIDTH') }}x{{ env('SLIDER_IMAGE_HEIGHT') }})</small></label>
                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                    {{ translate('Browse') }}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                            <input type="hidden" name="photo" class="selected-files">
                                        </div>
                                        <div class="file-preview box sm">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">{{ translate('Mobile Photo') }}
                                            <small>({{ env('MOBILE_SILDER_IMAGE_WIDTH') }}x{{ env('MOBILE_SILDER_IMAGE_HEIGHT') }})<small></label>
                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                    {{ translate('Browse') }}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                            <input type="hidden" name="mobile_photo" class="selected-files">
                                        </div>
                                        <div class="file-preview box sm">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 text-right">
                                        <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
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

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')

    <script type="text/javascript">
        $('#type').on('change', function() {
            //alert();
            if ($('#type').val() == 'category') {
                $('#category_row').css('display', 'block');
                $('#brand_row').css('display', 'none');
                $('#custom_row').css('display', 'none');
            } else if ($('#type').val() == 'brand') {
                $('#category_row').css('display', 'none');
                $('#brand_row').css('display', 'block');
                $('#custom_row').css('display', 'none');

            } else if ($('#type').val() == 'custom') {
                console.log($('#type').val());
                $('#category_row').css('display', 'none');
                $('#brand_row').css('display', 'none');
                $('#custom_row').css('display', 'block');
            }
            AIZ.plugins.bootstrapSelect('refresh');
        });

        function updatestatus(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('slider.status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Published slider updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }


        function sort_sliders(el) {
            $('#sort_sliders').submit();
        }
    </script>
@endsection
