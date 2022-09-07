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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Translation</h1>
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
                    <li class="breadcrumb-item text-dark">Translation</li>
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
            <div class="card card-flush">
                <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                    <div class="col text-center text-md-left">
                        <h5 class="mb-md-0 h6">{{ $language->name }}</h5>
                    </div>
                    <div class="col-md-4">
                        <form class="" id="sort_keys" action="" method="GET">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="search" name="search"
                                    @isset($sort_search) value="{{ $sort_search }}" @endisset
                                    placeholder="{{ translate('Type key & Enter') }}">
                            </div>
                        </form>
                    </div>
                </div>
                <form class="form-horizontal" action="{{ route('languages.key_value_store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $language->id }}">
                    <div class="card-body">
                        <table class="table table-striped table-bordered demo-dt-basic" id="tranlation-table"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="45%">{{ translate('Key') }}</th>
                                    <th width="45%">{{ translate('Value') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lang_keys as $key => $translation)
                                    <tr>
                                        <td>{{ $key + 1 + ($lang_keys->currentPage() - 1) * $lang_keys->perPage() }}</td>
                                        <td class="key">{{ $translation->lang_value }}</td>
                                        <td>
                                            <input type="text" class="form-control value" style="width:100%"
                                                name="values[{{ $translation->lang_key }}]" @if (($traslate_lang = \App\Models\Translation::where('lang', $language->code)->where('lang_key', $translation->lang_key)->latest()->first()) != null)
                                            value="{{ $traslate_lang->lang_value }}"
                                @endif>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="aiz-pagination">
                            {{ $lang_keys->appends(request()->input())->links() }}
                        </div>

                        <div class="form-group mb-0 text-right d-flex justify-content-end m-5">
                            <button type="button" class="btn btn-primary me-5"
                                onclick="copyTranslation()">{{ translate('Copy Translations') }}</button>
                            <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        //translate in one click
        function copyTranslation() {
            $('#tranlation-table > tbody  > tr').each(function(index, tr) {
                $(tr).find('.value').val($(tr).find('.key').text());
            });
        }

        function sort_keys(el) {
            $('#sort_keys').submit();
        }
    </script>
@endsection
