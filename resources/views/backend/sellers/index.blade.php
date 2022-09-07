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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">All Sellers</h1>
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
                    <li class="breadcrumb-item text-dark">All Sellers</li>
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
            <form class="" id="sort_sellers" action="" method="GET">
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <h2>{{ translate('All Sellers') }}</h2>
                            </div>
                        </div>
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ translate('Bulk Action') }}
                                </button>
                            </div>
                        </div>
                        <!--end::Card toolbar-->
                        <!--begin::Input group-->
                        <div>
                            <select class="form-select form-select-solid" data-kt-select2="true"
                                data-placeholder="Select option" onchange="sort_sellers()" id="approved_status"
                                name="approved_status">
                                <option value="">{{ translate('Filter by Approval') }}</option>
                                <option value="1" @isset($approved) @if ($approved == 'paid') selected @endif @endisset>
                                    {{ translate('Approved') }}</option>
                                <option value="0" @isset($approved) @if ($approved == 'unpaid') selected @endif @endisset>
                                    {{ translate('Non-Approved') }}</option>
                            </select>
                        </div>
                        <!--end::Input-->
                        <!--end::Input group-->
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
                                placeholder="{{ translate('Type & Enter') }}" />
                        </div>
                        <!--end::Search-->

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
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input check-all" type="checkbox" />
                                            </div>
                                        </th>
                                        <th class="min-w-200px">{{ translate('Name') }}</th>
                                        <th class="text-center min-w-175px">{{ translate('Phone') }}</th>
                                        <th class="text-center min-w-175px">{{ translate('Verification Info') }}</th>
                                        <th class="text-center min-w-75px">{{ translate('Email Address') }}</th>
                                        <th class="text-center min-w-75px">{{ translate('Approval') }}</th>
                                        <th class="text-center min-w-75px">{{ translate('Num. of Products') }}</th>
                                        <th class="text-center min-w-75px">{{ translate('Due to seller') }}</th>
                                        <th width="10%">{{ translate('Options') }}</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                    <!--begin::Table row-->
                                    @foreach ($sellers as $key => $seller)
                                        @if ($seller->user != null && $seller->user->shop != null)
                                            <tr>
                                                <!--begin::Checkbox-->
                                                <td>
                                                    <div
                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input check-one" type="checkbox"
                                                            name="id[]" value="{{ $seller->id }}" />
                                                    </div>
                                                </td>
                                                <!--end::Checkbox-->
                                                <!--begin::Product=-->
                                                <td class="text-center">
                                                    <span class="fw-bolder">
                                                        <!--begin::Product name-->
                                                        <a href="#" class="symbol symbol-50px">
                                                            {{ $seller->user->shop->name }}
                                                        </a>
                                                    </span>
                                                </td>
                                                <!--end::Product=-->
                                                <!--begin::Product Owner=-->
                                                <td class="text-center pe-0">
                                                    <span class="fw-bolder">
                                                        {{ $seller->user->phone }}
                                                    </span>
                                                </td>
                                                <!--end::Product Owner=-->
                                                <!--begin::Customer=-->
                                                <td class="text-center pe-0" data-order="32">
                                                    <span class="fw-bolder ms-3">
                                                        @if ($seller->verification_info != null)
                                                            <a
                                                                href="{{ route('sellers.show_verification_request', $seller->id) }}">
                                                                <span
                                                                    class="badge badge-inline badge-info">{{ translate('Show') }}</span>
                                                            </a>
                                                        @endif
                                                    </span>
                                                </td>
                                                <!--end::Customer=-->
                                                <!--begin::rating=-->
                                                <td class="text-center pe-0" data-order="2">
                                                    <span>
                                                        {{ $seller->user->email }}
                                                    </span>
                                                </td>
                                                <!--end::rating=-->
                                                <!--begin::comment=-->
                                                <td class="text-center pe-0">
                                                    <span>
                                                        <label
                                                            class="form-check form-switch form-check-custom form-check-solid">
                                                            <input class="form-check-input" onchange="update_approved(this)"
                                                                value="{{ $seller->id }}" type="checkbox"
                                                                <?php if ($seller->verification_status == 1) {
                                                                    echo 'checked';
                                                                } ?>>
                                                        </label>
                                                    </span>
                                                </td>
                                                <!--end::comment=-->
                                                <!--begin::comment=-->
                                                <td class="text-center pe-0">
                                                    <span>
                                                        {{ \App\Models\Product::where('user_id', $seller->user->id)->count() }}
                                                    </span>
                                                </td>
                                                <!--end::comment=-->
                                                <td class="text-center pe-0">
                                                    @if ($seller->admin_to_pay >= 0)
                                                        {{ single_price($seller->admin_to_pay) }}
                                                    @else
                                                        {{ single_price(abs($seller->admin_to_pay)) }} (Due to Admin)
                                                    @endif
                                                </td>
                                                <!--begin::Action=-->
                                                <td class="text-center">

                                                    <div class="dropdown dropdown-inline mr-4">
                                                        <button type="button" class="btn btn-light-primary btn-icon btn-sm"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                                <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/General/Other1.svg--><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none"
                                                                        fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24" />
                                                                        <circle fill="#000000" cx="12" cy="5" r="2" />
                                                                        <circle fill="#000000" cx="12" cy="12" r="2" />
                                                                        <circle fill="#000000" cx="12" cy="19" r="2" />
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </button>
                                                        <div class="dropdown-menu"
                                                            style="overflow: auto;max-height: 100px">
                                                            <a href="#"
                                                                onclick="show_seller_profile('{{ $seller->id }}');"
                                                                class="dropdown-item">
                                                                {{ translate('Profile') }}
                                                            </a>
                                                            <a href="{{ route('sellers.login', encrypt($seller->id)) }}"
                                                                class="dropdown-item">
                                                                {{ translate('Log in as this Seller') }}
                                                            </a>
                                                            <a href="#"
                                                                onclick="show_seller_payment_modal('{{ $seller->id }}');"
                                                                class="dropdown-item">
                                                                {{ translate('Go to Payment') }}
                                                            </a>
                                                            <a href="{{ route('sellers.payment_history', encrypt($seller->id)) }}"
                                                                class="dropdown-item">
                                                                {{ translate('Payment History') }}
                                                            </a>
                                                            <a href="{{ route('sellers.edit', encrypt($seller->id)) }}"
                                                                class="dropdown-item">
                                                                {{ translate('Edit') }}
                                                            </a>
                                                            @if ($seller->user->banned != 1)
                                                                <a href="#"
                                                                    onclick="confirm_ban('{{ route('sellers.ban', $seller->id) }}');"
                                                                    class="dropdown-item">
                                                                    {{ translate('Ban this seller') }}
                                                                    <i class="fa fa-ban text-danger" aria-hidden="true"></i>
                                                                </a>
                                                            @else
                                                                <a href="#"
                                                                    onclick="confirm_unban('{{ route('sellers.ban', $seller->id) }}');"
                                                                    class="dropdown-item">
                                                                    {{ translate('Unban this seller') }}
                                                                    <i class="fa fa-check text-success"
                                                                        aria-hidden="true"></i>
                                                                </a>
                                                            @endif
                                                            <a href="#" class="dropdown-item confirm-delete"
                                                                data-href="{{ route('sellers.destroy', $seller->id) }}"
                                                                class="">
                                                                {{ translate('Delete') }}
                                                            </a>
                                                        </div>
                                                    </div>
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
                            {{ $sellers->appends(request()->input())->links() }}
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

    <!-- Seller Profile Modal -->
    <div class="modal fade" id="profile_modal" tabindex="-1" aria-labelledby="profile_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="profile-modal-content">

            </div>
        </div>
    </div>

    <!-- Seller Payment Modal -->
    <div class="modal fade" id="payment_modal" tabindex="-1" aria-labelledby="payment_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="payment-modal-content">

            </div>
        </div>
    </div>

    <!-- Ban Seller Modal -->
    <div class="modal fade" id="confirm-ban" tabindex="-1" aria-labelledby="confirm-ban" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h6">{{ translate('Confirmation') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ translate('Do you really want to ban this seller?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-light"
                        data-dismiss="modal">{{ translate('Cancel') }}</button>
                    <a class="btn btn-primary" id="confirmation">{{ translate('Proceed!') }}</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Unban Seller Modal -->
    <div class="modal fade" id="confirm-unban" tabindex="-1" aria-labelledby="confirm-unban" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h6">{{ translate('Confirmation') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ translate('Do you really want to ban this seller?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">{{ translate('Cancel') }}</button>
                    <a class="btn btn-primary" id="confirmationunban">{{ translate('Proceed!') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).on("change", ".check-all", function() {
            if (this.checked) {
                // Iterate each checkbox
                $('.check-one:checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check-one:checkbox').each(function() {
                    this.checked = false;
                });
            }

        });

        function show_seller_payment_modal(id) {
            $.post('{{ route('sellers.payment_modal') }}', {
                _token: '{{ @csrf_token() }}',
                id: id
            }, function(data) {
                $('#payment_modal #payment-modal-content').html(data);
                $('#payment_modal').modal('show', {
                    backdrop: 'static'
                });
                $('.demo-select2-placeholder').select2();
            });
        }

        function show_seller_profile(id) {
            $.post('{{ route('sellers.profile_modal') }}', {
                _token: '{{ @csrf_token() }}',
                id: id
            }, function(data) {
                $('#profile_modal #profile-modal-content').html(data);
                $('#profile_modal').modal('show', {
                    backdrop: 'static'
                });
            });
        }

        function update_approved(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('sellers.approved') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Approved sellers updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function sort_sellers(el) {
            $('#sort_sellers').submit();
        }

        function confirm_ban(url) {
            $('#confirm-ban').modal('show', {
                backdrop: 'static'
            });
            document.getElementById('confirmation').setAttribute('href', url);
        }

        function confirm_unban(url) {
            $('#confirm-unban').modal('show', {
                backdrop: 'static'
            });
            document.getElementById('confirmationunban').setAttribute('href', url);
        }

        function bulk_delete() {
            var data = new FormData($('#sort_sellers')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('bulk-seller-delete') }}",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    }
                }
            });
        }
    </script>
@endsection
