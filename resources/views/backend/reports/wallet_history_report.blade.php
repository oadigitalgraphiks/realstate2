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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Wallet Transaction Report</h1>
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
                    <li class="breadcrumb-item text-muted">Reports</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Transaction Report</li>
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
            <!--begin::Products-->
            <form class="" action="{{ route('wallet-history.index') }}" method="GET">
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <h2>{{ translate('Wallet Transaction Report') }}</h2>
                            </div>
                        </div>
                        <!--begin::Input group-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-filemanager-table-toolbar="base">
                                <!--begin::Input group-->
                                @if(Auth::user()->user_type != 'seller')
                                    <div class="me-5">
                                        <select class="form-select form-select-solid" data-kt-select2="true"
                                            data-placeholder="Select option" name="user_id">
                                            <option value="">{{ translate('Choose User') }}</option>
                                            @foreach ($users_with_wallet as $key => $user)
                                                <option value="{{ $user->id }}" @if($user->id == $user_id) selected @endif>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <!--end::Input-->
                                <div class="mb-6 fv-row me-5">
                                    <input type="text" class="form-control aiz-date-range mb-2"
                                    id="search" name="date_range" @isset($date_range) value="{{ $date_range }}" @endisset placeholder="{{ translate('Select Date') }}">
                                </div>
                                <!--begin::Add customer-->
                                <div class="mb-6 fv-row me-5">
                                <button  class="btn btn-primary" type="submit">
                                <!--end::Svg Icon-->{{translate('Filter')}}</button>
                                </div>
                                <!--end::Add customer-->
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none" data-kt-filemanager-table-toolbar="selected">
                                <div class="fw-bolder me-5">
                                <span class="me-2" data-kt-filemanager-table-select="selected_count"></span>{{translate('Selected')}}</div>
                                <button type="button" class="btn btn-danger" data-kt-filemanager-table-select="delete_selected">{{translate('Delete Selected')}}</button>
                            </div>
                            <!--end::Group actions-->
                        </div>
                        <!--end::Input-->
                        <!--end::Input group-->

                        <!--end::Card title-->
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
                                    <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-200px">#</th>
                                        <th class="min-w-200px">{{ translate('Customer')}}</th>
                                        <th class="min-w-175px">{{  translate('Date') }}</th>
                                        <th class="min-w-175px">{{ translate('Amount')}}</th>
                                        <th class="min-w-175px">{{ translate('Payment Method')}}</th>
                                        <th class="min-w-175px">{{ translate('Approval')}}</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                    <!--begin::Table row-->
                                    @foreach ($wallets as $key => $wallet)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                @if ($wallet->user != null)
                                                <td>{{ $wallet->user->name }}</td>
                                                @else
                                                    <td>{{ translate('User Not found') }}</td>
                                                @endif
                                                <td>{{ date('d-m-Y', strtotime($wallet->created_at)) }}</td>
                                                <td>{{ single_price($wallet->amount) }}</td>
                                                <td>{{ ucfirst(str_replace('_', ' ', $wallet ->payment_method)) }}</td>
                                                <td class="text-right">
                                                    @if ($wallet->offline_payment)
                                                        @if ($wallet->approval)
                                                            <span class="badge badge-inline badge-success">{{translate('Approved')}}</span>
                                                        @else
                                                            <span class="badge badge-inline badge-info">{{translate('Pending')}}</span>
                                                        @endif
                                                    @else
                                                        N/A
                                                    @endif
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
                            {{ $wallets->appends(request()->input())->links() }}
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
