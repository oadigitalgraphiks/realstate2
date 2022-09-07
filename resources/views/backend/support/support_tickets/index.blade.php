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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Support Desk</h1>
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
                    <li class="breadcrumb-item text-muted">Support</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Support Desk</li>
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
            <form class="" id="sort_blogs" action="" method="GET">
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>{{ translate('Support Desk') }}</h2>
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
                                    name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset
                                    placeholder="{{ translate('Type ticket code & Enter') }}" />
                            </div>
                            <!--end::Search-->
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
                                        <th class="min-w-200px">{{ translate('Ticket ID') }}</th>
                                        <th class="text-center min-w-75px">{{ translate('Sending Date') }}</th>
                                        <th class="text-center min-w-175px">{{ translate('Subject') }}</th>
                                        <th class="text-center min-w-150px">{{ translate('User') }}</th>
                                        <th class="text-center min-w-150px">{{ translate('Status') }}</th>
                                        <th class="text-center min-w-150px">{{ translate('Last reply') }}</th>
                                        <th class="text-center min-w-100px">{{ translate('Options') }}</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                    <!--begin::Table row-->
                                    @if (count($tickets) > 0)
                                        @foreach ($tickets as $key => $ticket)
                                            @if ($ticket->user != null)
                                                <tr>
                                                    <!--begin::Checkbox-->
                                                    <td class="text-center pe-0">
                                                        <span class="fw-bolder">
                                                            #{{ $ticket->code }}
                                                        </span>
                                                    </td>
                                                    <!--begin::Category=-->
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                {{ $ticket->created_at }}
                                                                @if ($ticket->viewed == 0)
                                                                    <div class="badge badge-light-success">
                                                                        {{ translate('New') }}
                                                                    </div>
                                                                @endif
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <!--end::Category=-->
                                                    <td class="text-center pe-0">
                                                        <span class="fw-bolder">
                                                            {{ $ticket->subject }}
                                                        </span>
                                                    </td>
                                                    <!--end::SKU=-->
                                                    <!--begin::Qty=-->
                                                    <td class="text-center pe-0" data-order="32">
                                                        <span class="fw-bolder ms-3">
                                                            {{ $ticket->user->name }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center pe-0" data-order="32">
                                                        <span class="fw-bolder ms-3">
                                                            @if ($ticket->status == 'pending')
                                                                <div class="badge badge-light-danger">
                                                                    {{ translate('Pending') }}
                                                                </div>
                                                            @elseif ($ticket->status == 'open')
                                                                <div class="badge badge-light-secondary">
                                                                    {{ translate('Open') }}
                                                                </div>
                                                            @else
                                                                <div class="badge badge-light-success">
                                                                    {{ translate('Solved') }}
                                                                </div>
                                                            @endif
                                                            </label>
                                                        </span>
                                                    </td>
                                                    <!--end::Qty=-->
                                                    <!--begin::Price=-->
                                                    <td class="text-center pe-0" data-order="2">
                                                        <span>
                                                            @if (count($ticket->ticketreplies) > 0)
                                                                {{ $ticket->ticketreplies->last()->created_at }}
                                                            @else
                                                                {{ $ticket->created_at }}
                                                            @endif
                                                        </span>
                                                    </td>

                                                    <td class="text-center">
                                                        <a href="{{ route('support_ticket.admin_show', encrypt($ticket->id)) }}"
                                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none"
                                                                        fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24" />
                                                                        <path
                                                                            d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z"
                                                                            fill="#000000" fill-rule="nonzero"
                                                                            opacity="0.3" />
                                                                        <path
                                                                            d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
                                                                            fill="#000000" opacity="0.3" />
                                                                    </g>
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    </td>

                                                    <!--end::Action=-->
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                {{ translate('Nothing Found') }}
                                            </td>
                                        </tr>
                                    @endif
                                    <!--end::Table row-->
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <div class="aiz-pagination">
                            {{ $tickets->appends(request()->input())->links() }}
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
