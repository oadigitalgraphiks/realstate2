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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">All Currencies</h1>
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
                    <li class="breadcrumb-item text-dark">Currencies</li>
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
                        <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                            <h5 class="mb-0 h6">{{translate('System Default Currency')}}</h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('business_settings.update') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-xl-3">
                                        <label class="control-label">{{translate('System Default Currency')}}</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                            data-placeholder="Select an option" name="system_default_currency"
                                            data-live-search="true">
                                            @foreach ($active_currencies as $key => $currency)
                                                <option value="{{ $currency->id }}" <?php if(get_setting('system_default_currency') == $currency->id) echo 'selected'?> >
                                                    {{ $currency->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" name="types[]" value="system_default_currency">
                                    <div class="col-lg-3">
                                        <button class="btn btn-sm btn-primary" type="submit">{{translate('Save')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card card-flush">
                        <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                            <h5 class="mb-0 h6">{{translate('Set Currency Formats')}}</h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('business_settings.update') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="symbol_format">
                                    <div class="col-xl-3">
                                        <label class="control-label">{{translate('Symbol Format')}}</label>
                                    </div>
                                    <div class="col-xl-6">
                                        <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                            data-placeholder="Select an option" name="symbol_format"
                                            data-live-search="true">
                                            <option value="1" @if(get_setting('symbol_format') == 1) selected @endif>[Symbol][Amount]</option>
                                            <option value="2" @if(get_setting('symbol_format') == 2) selected @endif>[Amount][Symbol]</option>
                                            <option value="3" @if(get_setting('symbol_format') == 3) selected @endif>[Symbol] [Amount]</option>
                                            <option value="4" @if(get_setting('symbol_format') == 4) selected @endif>[Amount] [Symbol]</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="decimal_separator">
                                    <div class="col-xl-3">
                                        <label class="control-label">{{translate('Decimal Separator')}}</label>
                                    </div>
                                    <div class="col-xl-6">
                                        <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                            data-placeholder="Select an option" name="decimal_separator"
                                            data-live-search="true">
                                            <option value="1" @if(get_setting('decimal_separator') == 1) selected @endif>1,23,456.70</option>
                                            <option value="2" @if(get_setting('decimal_separator') == 2) selected @endif>1.23.456,70</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="no_of_decimals">
                                    <div class="col-xl-3">
                                        <label class="control-label">{{translate('No of decimals')}}</label>
                                    </div>
                                    <div class="col-xl-6">
                                        <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                            data-placeholder="Select an option" name="no_of_decimals"
                                            data-live-search="true">
                                            <option value="0" @if(get_setting('no_of_decimals') == 0) selected @endif>12345</option>
                                            <option value="1" @if(get_setting('no_of_decimals') == 1) selected @endif>1234.5</option>
                                            <option value="2" @if(get_setting('no_of_decimals') == 2) selected @endif>123.45</option>
                                            <option value="3" @if(get_setting('no_of_decimals') == 3) selected @endif>12.345</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-0 d-flex justify-content-end m-5">
                                    <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
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
                            <h2>{{translate('All Currencies')}}</h2>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                            transform="rotate(45 17.0365 15.1223)" fill="black" />
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <input type="text" class="form-control form-control-solid w-250px ps-14" id="search"
                                    name="search" @isset($sort_search) value="{{ $sort_search }}"
                                    @endisset placeholder="{{ translate('Type & Enter') }}" />
                            </div>
                            <!--end::Search-->
                            <a onclick="currency_modal()" href="#" class="btn btn-primary">
                                {{ translate('Add New Currency') }}
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
                                        <th class="min-w-200px">{{ translate('Currency name') }}</th>
                                        <th class="text-center min-w-75px">{{ translate('Currency symbol') }}</th>
                                        <th class="text-center min-w-175px">{{ translate('Currency code') }}</th>
                                        <th class="text-center min-w-150px">{{translate('Exchange rate')}}(1 USD = ?)</th>
                                        <th class="text-center min-w-100px">{{ translate('Status') }}</th>
                                        <th class="text-center min-w-100px">{{ translate('Options') }}</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                    <!--begin::Table row-->
                                    @foreach ($currencies as $key => $currency)
                                        <tr>
                                            <!--begin::Checkbox-->
                                            <td class="text-center pe-0">
                                                <span
                                                    class="fw-bolder">{{ ($key+1) + ($currencies->currentPage() - 1)*$currencies->perPage() }}</span>
                                            </td>
                                            <!--begin::Category=-->
                                            <td>
                                                <div class="d-flex">
                                                    <div class="ms-5">
                                                        <!--begin::Title-->
                                                            {{$currency->name}}
                                                        <!--end::Title-->
                                                    </div>
                                                </div>
                                            </td>
                                            <!--end::Category=-->
                                            <td class="text-center pe-0">
                                                <span class="fw-bolder">
                                                    {{$currency->symbol}}
                                                </span>
                                            </td>
                                            <!--end::SKU=-->
                                            <!--begin::Qty=-->
                                            <td class="text-center pe-0" data-order="32">
                                                <span class="fw-bolder ms-3">
                                                    {{$currency->code}}
                                                </span>
                                            </td>
                                            <td class="text-center pe-0" data-order="32">
                                                <span class="fw-bolder ms-3">
                                                    {{$currency->exchange_rate}}
                                                </span>
                                            </td>
                                            <td class="text-center pe-0" data-order="32">
                                                <span class="fw-bolder ms-3">
                                                    <label class="form-check form-switch form-check-custom form-check-solid d-block">
                                                    <input class="form-check-input" onchange="update_currency_status(this)" value="{{ $currency->id }}" type="checkbox" <?php if($currency->status == 1) echo "checked";?>>
                                                </label>
                                                </span>
                                            </td>
                                            <!--end::Qty=-->
                                            <!--begin::Price=-->
                                            <td class="text-center">
                                                <a onclick="edit_currency_modal('{{$currency->id}}');" title="{{ translate('Edit') }}"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Design/Edit.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                                            <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span>
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
                            {{ $currencies->appends(request()->input())->links() }}
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

    <!-- Delete Modal -->
    @include('modals.delete_modal')

    <div class="modal fade" id="add_currency_modal" tabindex="-1" aria-labelledby="add_currency_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>

    <div class="modal fade" id="currency_modal_edit" tabindex="-1" aria-labelledby="currency_modal_edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">

        function sort_currencies(el){
            $('#sort_currencies').submit();
        }

        function currency_modal(){
            $.get('{{ route('currency.create') }}',function(data){
                $('#modal-content').html(data);
                $('#add_currency_modal').modal('show');
            });
        }

        function update_currency_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }

            $.post('{{ route('currency.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Currency Status updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function edit_currency_modal(id){
            $.post('{{ route('currency.edit') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
                $('#currency_modal_edit .modal-content').html(data);
                $('#currency_modal_edit').modal('show', {backdrop: 'static'});
            });
        }
    </script>
@endsection
