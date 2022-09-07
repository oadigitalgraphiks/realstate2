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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Payout Requests</h1>
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
                    <li class="breadcrumb-item text-muted">Sellers</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Payout Requests</li>
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
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <h2>{{ translate('Seller Withdraw Request') }}</h2>
                        </div>
                    </div>
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
                                <tr class="text-center text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        #
                                    </th>
                                    <th class="min-w-200px">{{ translate('Date') }}</th>
                                    <th class="text-center min-w-175px">{{ translate('Seller') }}</th>
                                    <th class="text-center min-w-175px">{{ translate('Total Amount to Pay') }}</th>
                                    <th class="text-center min-w-175px">{{ translate('Requested Amount') }}</th>
                                    <th class="text-center min-w-175px">{{ translate('Message') }}</th>
                                    <th class="text-center min-w-175px">{{ translate('Status') }}</th>
                                    <th class="text-center min-w-75px">{{ translate('Options') }}</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bold text-gray-600">
                                <!--begin::Table row-->
                                @foreach ($seller_withdraw_requests as $key => $seller_withdraw_request)
                                    @if (\App\Models\Seller::find($seller_withdraw_request->user_id) != null && \App\Models\Seller::find($seller_withdraw_request->user_id)->user != null)

                                        <tr>
                                            <!--begin::Checkbox-->
                                            <td>
                                                {{ $key + 1 + ($seller_withdraw_requests->currentPage() - 1) * $seller_withdraw_requests->perPage() }}
                                            </td>
                                            <!--end::Checkbox-->
                                            <!--begin::Product=-->
                                            <td class="text-center">
                                                <span class="fw-bolder">
                                                    <!--begin::Product name-->
                                                    {{ $seller_withdraw_request->created_at }}
                                                </span>
                                            </td>
                                            <!--end::Product=-->
                                            <!--begin::Product Owner=-->
                                            <td class="text-center pe-0">
                                                <span class="fw-bolder">
                                                    @if (\App\Models\Seller::find($seller_withdraw_request->user_id) != null)
                                                        {{ \App\Models\Seller::find($seller_withdraw_request->user_id)->user->name }}
                                                        ({{ \App\Models\Seller::find($seller_withdraw_request->user_id)->user->shop->name }})
                                                    @endif
                                                </span>
                                            </td>
                                            <!--end::Product Owner=-->
                                            <!--begin::Customer=-->
                                            <td class="text-center pe-0" data-order="32">
                                                <span class="fw-bolder ms-3">
                                                    {{ single_price(\App\Models\Seller::find($seller_withdraw_request->user_id)->admin_to_pay) }}
                                                </span>
                                            </td>
                                            <!--end::Customer=-->
                                            <!--begin::rating=-->
                                            <td class="text-center pe-0" data-order="2">
                                                <span>
                                                    {{ single_price($seller_withdraw_request->amount) }}
                                                </span>
                                            </td>
                                            <!--end::rating=-->
                                            <!--begin::rating=-->
                                            <td class="text-center pe-0" data-order="2">
                                                <span>
                                                    {{ $seller_withdraw_request->message }}
                                                </span>
                                            </td>
                                            <!--end::rating=-->
                                            <!--begin::rating=-->
                                            <td class="text-center pe-0" data-order="2">
                                                <span>
                                                    @if ($seller_withdraw_request->status == 1)
                                                        <span
                                                            class="badge badge-inline badge-success">{{ translate('Paid') }}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-inline badge-info">{{ translate('Pending') }}</span>
                                                    @endif
                                                </span>
                                            </td>
                                            <!--end::rating=-->
                                            <!--begin::Action=-->
                                            <td class="text-center">
                                                <a href="javascript:void()"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" onclick="show_message_modal('{{ $seller_withdraw_request->id }}');" data-bs-toggle="tooltip" title="{{ translate('Message View') }}">
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
                                                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                <path
                                                                    d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
                                                                    fill="#000000" opacity="0.3" />
                                                            </g>
                                                        </svg></span>
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" onclick="show_seller_payment_modal('{{$seller_withdraw_request->user_id}}','{{ $seller_withdraw_request->id }}');" data-bs-toggle="tooltip" title="{{ translate('Pay Now') }}">
                                                    <span class="svg-icon svg-icon-3">
                                                        <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Duplicate.svg--><svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path
                                                                    d="M15.9956071,6 L9,6 C7.34314575,6 6,7.34314575 6,9 L6,15.9956071 C4.70185442,15.9316381 4,15.1706419 4,13.8181818 L4,6.18181818 C4,4.76751186 4.76751186,4 6.18181818,4 L13.8181818,4 C15.1706419,4 15.9316381,4.70185442 15.9956071,6 Z"
                                                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                <path
                                                                    d="M10.1818182,8 L17.8181818,8 C19.2324881,8 20,8.76751186 20,10.1818182 L20,17.8181818 C20,19.2324881 19.2324881,20 17.8181818,20 L10.1818182,20 C8.76751186,20 8,19.2324881 8,17.8181818 L8,10.1818182 C8,8.76751186 8.76751186,8 10.1818182,8 Z"
                                                                    fill="#000000" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                            </td>
                                            <!--end::Action=-->
                                        </tr>
                                    @endif
                                @endforeach
                                <!--end::Table row-->
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <div class="aiz-pagination">
                        {{ $seller_withdraw_requests->appends(request()->input())->links() }}
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')
    <!-- payment Modal -->
    <div class="modal fade" id="payment_modal" tabindex="-1" aria-labelledby="payment_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="payment-modal-content">

            </div>
        </div>
    </div>


    <!-- Message View Modal -->
    <div class="modal fade" id="message_modal" tabindex="-1" aria-labelledby="message_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="message-modal-content">

            </div>
        </div>
    </div>


@endsection



@section('script')
    <script type="text/javascript">
        function show_seller_payment_modal(id, seller_withdraw_request_id) {
            $.post('{{ route('withdraw_request.payment_modal') }}', {
                _token: '{{ @csrf_token() }}',
                id: id,
                seller_withdraw_request_id: seller_withdraw_request_id
            }, function(data) {
                $('#payment-modal-content').html(data);
                $('#payment_modal').modal('show', {
                    backdrop: 'static'
                });
                $('.demo-select2-placeholder').select2();
            });
        }

        function show_message_modal(id) {
            $.post('{{ route('withdraw_request.message_modal') }}', {
                _token: '{{ @csrf_token() }}',
                id: id
            }, function(data) {
                $('#message-modal-content').html(data);
                $('#message_modal').modal('show', {
                    backdrop: 'static'
                });
            });
        }
    </script>

@endsection
