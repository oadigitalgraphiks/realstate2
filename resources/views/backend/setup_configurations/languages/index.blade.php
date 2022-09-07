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
                    <li class="breadcrumb-item text-dark">Languages</li>
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
    <div class="post d-flex flex-column-fluid mt-10" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="row g-5 g-xl-8">
                <div class="col-xl-6">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h5 class="mb-0 h6">{{ translate('Default Language') }}</h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-xl-3">
                                        <label class="col-from-label">{{ translate('Default Language') }}</label>
                                    </div>
                                    <input type="hidden" name="types[]" value="DEFAULT_LANGUAGE">
                                    <div class="col-xl-6">
                                        <select class="form-control demo-select2-placeholder" name="DEFAULT_LANGUAGE">
                                            @foreach (\App\Models\Language::all() as $key => $language)
                                                <option value="{{ $language->code }}" <?php if(env('DEFAULT_LANGUAGE') == $language->code) echo 'selected'?> >{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-3">
                                        <button type="submit" class="btn btn-info">{{translate('Save')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <h5 class="mb-0 h6">{{ translate('Import App Translations') }}</h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('app-translations.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="fv-row mt-5 mb-2">
                                    <label class="form-label">{{ translate('English Trasnlation File') }}</label>
                                    <!--begin::Dropzone-->
                                    <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                        data-toggle="aizuploader" data-type="image">
                                        <!--begin::Message-->
                                        <div class="dz-message needsclick">
                                            <!--begin::Icon-->
                                            <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                            <!--end::Icon-->
                                            <!--begin::Info-->
                                            <input type="hidden" name="lang_file" class="selected-files">
                                            <div class="ms-4">
                                                <h3 class="fs-5 fw-bolder text-gray-900 mb-1">{{translate('Drop files here or click
                                                    to upload')}}.</h3>
                                                <span class="fs-7 fw-bold text-gray-400">{{ translate('Choose app_en.arb file') }}</span>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                    </div>
                                    <!--end::Dropzone-->
                                    <div class="file-preview box sm">
                                    </div>
                                    <div class="col-xl-3 mt-5">
                                        <button type="submit" class="btn btn-info">{{translate('Import')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid mt-10" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Products-->
            <form class="" id="sort_blogs" action="" method="GET">
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>{{translate('Language')}}</h2>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <a href="{{ route('languages.create') }}" class="btn btn-primary">
                                {{ translate('Add New Language') }}
                            </a>
                            <!--end::Add product-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->

                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-center text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">
                                            #
                                        </th>
                                        <th class="min-w-200px">{{ translate('Name') }}</th>
                                        <th class="text-center min-w-75px">{{ translate('Code') }}</th>
                                        <th class="text-center min-w-175px">{{ translate('Flutter App Lang Code') }}</th>
                                        <th class="text-center min-w-150px">{{ translate('RTL') }}</th>
                                        <th class="text-center min-w-100px">{{ translate('Options') }}</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                    <!--begin::Table row-->
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($languages as $key => $language)
                                        <tr>
                                            <!--begin::Checkbox-->
                                            <td class="text-center pe-0">
                                                <span
                                                    class="fw-bolder">{{ ($key+1) + ($languages->currentPage() - 1)*$languages->perPage() }}</span>
                                            </td>
                                            <!--begin::Category=-->
                                            <td>
                                                <div class="d-flex">
                                                    <div class="ms-5">
                                                        <!--begin::Title-->
                                                        <a href="{{route('languages.edit', $language->id)}}"
                                                            class="text-gray-800 text-hover-primary fs-5 fw-bolder mb-1"
                                                            data-kt-ecommerce-category-filter="category_name">
                                                                {{ $language->name }}
                                                        </a>
                                                        <!--end::Title-->
                                                    </div>
                                                </div>
                                            </td>
                                            <!--end::Category=-->
                                            <td class="text-center pe-0">
                                                <span class="fw-bolder">
                                                    {{ $language->code }}
                                                </span>
                                            </td>
                                            <!--end::SKU=-->
                                            <!--begin::Qty=-->
                                            <td class="text-center pe-0" data-order="32">
                                                <span class="fw-bolder ms-3">
                                                    {{ $language->app_lang_code }}
                                                </span>
                                            </td>
                                            <td class="text-center pe-0" data-order="32">
                                                <span class="fw-bolder ms-3">
                                                    <label
                                                    class="form-check form-switch form-check-custom form-check-solid d-block">
                                                    <input class="form-check-input" onchange="update_rtl_status(this)" value="{{ $language->id }}" type="checkbox"
                                                        <?php if($language->rtl == 1) echo "checked";?>>
                                                </label>
                                                </span>
                                            </td>
                                            <!--end::Qty=-->
                                            <!--begin::Price=-->
                                            <td class="text-center">
                                                <a href="{{route('app-translations.export', $language->id)}}"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="{{ translate('arb File Export') }}">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Files/Download.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 8.000000) rotate(-180.000000) translate(-12.000000, -8.000000) " x="11" y="1" width="2" height="14" rx="1"/>
                                                            <path d="M7.70710678,15.7071068 C7.31658249,16.0976311 6.68341751,16.0976311 6.29289322,15.7071068 C5.90236893,15.3165825 5.90236893,14.6834175 6.29289322,14.2928932 L11.2928932,9.29289322 C11.6689749,8.91681153 12.2736364,8.90091039 12.6689647,9.25670585 L17.6689647,13.7567059 C18.0794748,14.1261649 18.1127532,14.7584547 17.7432941,15.1689647 C17.3738351,15.5794748 16.7415453,15.6127532 16.3310353,15.2432941 L12.0362375,11.3779761 L7.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000004, 12.499999) rotate(-180.000000) translate(-12.000004, -12.499999) "/>
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span>
                                                </a>
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="{{route('languages.show', $language->id)}}" title="{{ translate('Translation') }}">
                                                    <i class="las la-language"></i>
                                                </a>
                                                <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="{{route('app-translations.show', $language->id)}}" title="{{ translate('App Translation') }}">
                                                    <i class="las la-language"></i>
                                                </a>
                                                <a href="{{route('languages.edit', $language->id)}}"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="{{ translate('Edit') }}">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Design/Edit.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                                            <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span>
                                                </a>

                                                <a href="#"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm confirm-delete"
                                                    data-href="{{route('languages.destroy', $language->id)}}" title="{{ translate('Delete') }}">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                                fill="black"></path>
                                                            <path opacity="0.5"
                                                                d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                                fill="black"></path>
                                                            <path opacity="0.5"
                                                                d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                                fill="black"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </a>

                                            </td>

                                            <!--end::Action=-->
                                        </tr>
                                    @endforeach
                                    <!--end::Table row-->
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <div class="aiz-pagination">
                            {{ $languages->appends(request()->input())->links() }}
                        </div>
                        <!--end::Card body-->
                    </div>
                </div>
            </form>
            <!--end::Products-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')
    <script type="text/javascript">
        function update_rtl_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('languages.update_rtl_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    location.reload();
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>
@endsection
