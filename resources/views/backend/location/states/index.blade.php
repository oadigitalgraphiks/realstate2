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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">All States</h1>
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
                    <li class="breadcrumb-item text-dark">States</li>
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
        <div class="col-xl-6">
            <!--begin::Post-->
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <!--begin::Container-->
                <div id="kt_content_container" class="container-xxl">
                    <!--begin::Products-->
                    <form class="" id="sort_cities" action="" method="GET">
                        <div class="card card-flush">
                            <!--begin::Card header-->
                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2 class="h3">{{ translate('All States') }}</h2>
                                </div>
                                <!--end::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                        <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                                    rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                <path
                                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <input type="text" class="form-control form-control-solid w-250px ps-14 me-5"
                                            id="sort_state" name="sort_state" @isset($sort_state)
                                            value="{{ $sort_state }}" @endisset
                                            placeholder="{{ translate('Type state name') }}" />

                                        <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                            data-placeholder="Select an Country" id="sort_country" name="sort_country"
                                            data-live-search="true">
                                            <option value="">{{ translate('Select Country') }}</option>
                                            @foreach (\App\Models\Country::where('status', 1)->get() as $country)
                                                <option value="{{ $country->id }}" @if ($sort_country == $country->id) selected @endif
                                                    {{ $sort_country }}>
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Search-->
                                    <button class="btn btn-primary" type="submit">{{ translate('Filter') }}</button>
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
                                                <th class="text-center min-w-75px">{{ translate('Country') }}</th>
                                                <th class="text-center min-w-75px">{{ translate('Show/Hide') }}</th>
                                                <th class="text-center min-w-75px">{{ translate('Options') }}</th>
                                            </tr>
                                            <!--end::Table row-->
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody class="fw-bold text-gray-600">
                                            <!--begin::Table row-->
                                            @foreach ($states as $key => $state)
                                                <tr>
                                                    <!--begin::Checkbox-->
                                                    <td class="text-center pe-0">
                                                        <span
                                                            class="fw-bolder">{{ $key + 1 + ($states->currentPage() - 1) * $states->perPage() }}</span>
                                                    </td>
                                                    <td class="text-center pe-0">
                                                        <span class="fw-bolder">
                                                            <!--begin::Title-->
                                                            {{ $state->name }}
                                                            <!--end::Title-->
                                                        </span>
                                                    </td>
                                                    <td class="text-center pe-0">
                                                        <span class="fw-bolder">
                                                            {{ $state->country->name }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center pe-0" data-order="32">
                                                        <span class="fw-bolder ms-3">
                                                            <label
                                                                class="form-check form-switch form-check-custom form-check-solid d-block">
                                                                <input class="form-check-input"
                                                                    onchange="update_status(this)"
                                                                    value="{{ $state->id }}" type="checkbox"
                                                                    <?php if ($state->status == 1) {
                                                                        echo 'checked';
                                                                    } ?>>
                                                            </label>
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('states.edit', $state->id) }}"
                                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                                <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Design/Edit.svg--><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none"
                                                                        fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24" />
                                                                        <path
                                                                            d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                                            fill="#000000" fill-rule="nonzero"
                                                                            transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) " />
                                                                        <rect fill="#000000" opacity="0.3" x="5" y="20"
                                                                            width="15" height="2" rx="1" />
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <!--end::Table row-->
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <div class="aiz-pagination">
                                    {{ $states->appends(request()->input())->links() }}
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
        <div class="col-xl-6">
            <!--begin::Post-->
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <!--begin::Container-->
                <div id="kt_content_container" class="container-xl">
                    <!--begin::Products-->
                    <!--begin::Main column-->
                    <form action="{{ route('states.store') }}" method="POST">
                        @csrf
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <!--begin::General options-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{ translate('Add New State') }}</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="required form-label">{{ translate('Name') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="name" class="form-control mb-2" placeholder="Name" value=""
                                            required />
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">
                                            {{ translate('A Name is required and recommended to be unique.') }}</div>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="required form-label">{{ translate('Country') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                            data-placeholder="Select an option" name="country_id" data-live-search="true">
                                            <option value=""></option>
                                            @foreach (\App\Models\Country::where('status', 1)->get() as $country)
                                                <option value="{{ $country->id }}">
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::General options-->
                            <div class="d-flex justify-content-end">
                                <!--begin::Button-->
                                <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                    <span class="indicator-label">{{ translate('Save Changes') }}</span>
                                    <span class="indicator-progress">{{ translate('Please wait') }}...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                    </form>
                    <!--end::Main column-->
                    <!--end::Products-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Post-->
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function update_status(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('states.status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Country status updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>
@endsection
