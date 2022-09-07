@extends('backend.layouts.app')

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Orders Listing</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Home</a>
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
                        <li class="breadcrumb-item text-muted">Sales</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">{{ translate('Seller Orders') }}</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Filter menu-->
                    <div class="m-0">
                        <!--begin::Menu toggle-->
                        <a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                            <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black" />
											</svg>
										</span>
                            <!--end::Svg Icon-->Filter</a>
                        <!--end::Menu toggle-->
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_61de0bbb7a88e">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Menu separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Menu separator-->
                            <!--begin::Form-->
                            <div class="px-7 py-5">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bold">Status:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_61de0bbb7a88e" data-allow-clear="true">
                                            <option></option>
                                            <option value="1">Approved</option>
                                            <option value="2">Pending</option>
                                            <option value="2">In Process</option>
                                            <option value="2">Rejected</option>
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bold">Member Type:</label>
                                    <!--end::Label-->
                                    <!--begin::Options-->
                                    <div class="d-flex">
                                        <!--begin::Options-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                            <span class="form-check-label">Author</span>
                                        </label>
                                        <!--end::Options-->
                                        <!--begin::Options-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                            <span class="form-check-label">Customer</span>
                                        </label>
                                        <!--end::Options-->
                                    </div>
                                    <!--end::Options-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bold">Notifications:</label>
                                    <!--end::Label-->
                                    <!--begin::Switch-->
                                    <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                        <label class="form-check-label">Enabled</label>
                                    </div>
                                    <!--end::Switch-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                    <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Form-->
                        </div>
                        <!--end::Menu 1-->
                    </div>
                    <!--end::Filter menu-->
                    <!--begin::Secondary button-->
                    <!--end::Secondary button-->
                    <!--begin::Primary button-->
                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create</a>
                    <!--end::Primary button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Products-->
                <div class="card card-flush">
                    <form class="" action="" id="sort_orders" method="GET">
                        <!--begin::Card header-->
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
														<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
													</svg>
												</span>
                                    <!--end::Svg Icon-->

                                    <input type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-14"  id="search" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type Order code & hit Enter') }}"/>
                                </div>
                                <!--end::Search-->
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <!--begin::Flatpickr-->
                                <div class="input-group w-200px">
                                 <span class="svg-icon svg-icon-1 position-absolute ms-4">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
														<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
													</svg>
												</span>
                                    <input type="text" class="aiz-date-range form-control form-control-solid w-250px ps-14" value="{{ $date }}" name="date" placeholder="{{ translate('Filter by date') }}" data-format="DD-MM-Y" data-separator=" to " data-advanced-range="true" autocomplete="off">
                                </div>
                                <div class="input-group w-250px">
                                    <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-order-filter="status" name="delivery_status" id="delivery_status">
                                        <option value="">{{translate('Filter by Delivery Status')}}</option>
                                        <option value="pending" @if ($delivery_status == 'pending') selected @endif>{{translate('Pending')}}</option>
                                        <option value="confirmed" @if ($delivery_status == 'confirmed') selected @endif>{{translate('Confirmed')}}</option>
                                        <option value="picked_up" @if ($delivery_status == 'picked_up') selected @endif>{{translate('Picked Up')}}</option>
                                        <option value="on_the_way" @if ($delivery_status == 'on_the_way') selected @endif>{{translate('On The Way')}}</option>
                                        <option value="delivered" @if ($delivery_status == 'delivered') selected @endif>{{translate('Delivered')}}</option>
                                        <option value="cancelled" @if ($delivery_status == 'cancelled') selected @endif>{{translate('Cancel')}}</option>
                                    </select>

                                </div>
                                <div class="input-group w-250px">
                                    <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Filter By Seller" data-kt-ecommerce-order-filter="status" name="seller_id" id="seller_id">
                                        <option value="">{{ translate('All Sellers') }}</option>
                                        @foreach (App\Models\Seller::all() as $key => $seller)
                                            @if ($seller->user != null && $seller->user->shop != null)
                                                <option value="{{ $seller->user->id }}" @if ($seller->user->id == $seller_id) selected @endif>
                                                    {{ $seller->user->shop->name }} ({{ $seller->user->name }})
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>
                                <!--end::Flatpickr-->

                                <button type="submit" class="btn btn-primary">{{ translate('Filter') }}</button>
                                <!--end::Add product-->
                            </div>
                            <!--end::Card toolbar-->

                        </div>
                    </form>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_sales_table">
                            <thead>
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                   #
                                </th>
                                <th class="min-w-150px">{{ translate('Order ID') }}</th>
                                <th class="text-center min-w-150px">{{ translate('Customer') }}</th>
                                <th class="text-center min-w-150px">{{ translate('Seller') }}</th>
                                <th class="min-w-50px">{{ translate('Num. of Products') }}</th>
                                <th class="text-center min-w-100px">{{ translate('Amount') }}</th>
                                <th class="text-center min-w-100px">{{ translate('Delivery Status') }}</th>
                                <th class="text-center min-w-100px">{{ translate('Payment Status') }}</th>
                                @if (addon_is_activated('refund_request'))
                                    <th class="text-center min-w-100px">{{ translate('Refund') }}</th>
                                @endif
                                <th class="text-center min-w-100px">{{translate('Date Added')}}</th>
                                <th class="text-center min-w-100px">{{translate('Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody class="fw-bold text-gray-600">
                            @foreach ($orders as $key => $order)
                                <tr>
                                {{--                            {{ ($key+1) + ($orders->currentPage() - 1)*$orders->perPage() }}--}}
                                <!--begin::Checkbox-->
                                    <td>
                                        {{ ($key+1) + ($orders->currentPage() - 1)*$orders->perPage() }}
                                    </td>
                                    <!--end::Checkbox-->
                                    <!--begin::Order ID=-->
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="{{route('seller_orders.show', encrypt($order->id))}}" class="text-gray-800 text-hover-primary fw-bolder">{{ $order->code }} @if($order->viewed == 0) <span class="badge badge-light-info">{{translate('New')}}</span>@endif</a>
                                    </td>

                                    <!--end::Order ID=-->
                                    <!--begin::Customer=-->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php
                                            $name = $order->user->name ;
                                            $parts = explode(' ',$name);
                                            $initials = '';
                                            foreach($parts as $part) {
                                                $initials .= $part[0];
                                            }
                                            //echo $initials;
                                            ?>
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="{{route('seller_orders.show', encrypt($order->id))}}">
                                                    <div class="symbol-label fs-3 bg-light-danger text-danger">{{$initials}}</div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->
                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="{{route('seller_orders.show', encrypt($order->id))}}" class="text-gray-800 text-hover-primary fs-5 fw-bolder">@if ($order->user != null)
                                                        {{ $order->user->name }}
                                                    @else
                                                        Guest ({{ $order->guest_id }})
                                                    @endif</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center pe-0">
                                        @if($order->seller)
                                            {{ $order->seller->name }}
                                        @endif
                                    </td>
                                    <!--end::Customer=-->
                                    <td class="text-center pe-0">
                                        <span class="fw-bolder">{{ count($order->orderDetails->where('seller_id', '!=', $admin_user_id)) }}</span>
                                    </td>
                                    <td class="text-center pe-0">
                                        <span class="fw-bolder">{{ single_price($order->grand_total) }}</span>
                                    </td>
                                    <!--begin::Status=-->
                                    <td class="text-center pe-0" data-order="Completed">
                                        <!--begin::Badges-->

                                    @php
                                        $status = $order->delivery_status;
                                        if($order->delivery_status == 'cancelled') {
                                            $status = '<div class="badge badge-danger">'.translate('Cancel').'</div>';
                                        }
                                        if($order->delivery_status == 'pending') {
                                            $status = '<div class="badge badge-light-warning">'.translate('Pending').'</div>';
                                        }
                                    @endphp
                                    {!! $status !!}
                                    {{--                                    <div class="badge badge-light-success">Completed</div>--}}
                                    <!--end::Badges-->
                                    </td>
                                    <!--end::Status=-->
                                    <!--begin::Total=-->
                                    <td class="text-center pe-0">
                                        @if ($order->payment_status == 'paid')
                                            <div class="badge badge-light-success">{{translate('Paid')}}</div>
                                        @else
                                            <div class="badge badge-light-danger">{{translate('Unpaid')}}</div>
                                        @endif
                                    </td>
                                    <!--end::Total=-->
                                    @if (addon_is_activated('refund_request'))
                                        <td class="text-center pe-0">
                                    <span class="fw-bolder">@if (count($order->refund_requests) > 0)
                                            {{ count($order->refund_requests) }} {{ translate('Refund') }}
                                        @else
                                            {{ translate('No Refund') }}
                                        @endif</span>
                                        </td>
                                @endif
                                <!--end::Date Added=-->
                                    <!--begin::Date Modified=-->
                                    <td class="text-center" data-order="{{ date('Y-m-d', strtotime($order->created_at)) }}">
                                        <span class="fw-bolder">{{ date('Y-m-d', strtotime($order->created_at)) }}</span>
                                    </td>
                                    <!--end::Date Modified=-->
                                    <!--begin::Action=-->
                                    <td class="text-center">
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                            <span class="svg-icon svg-icon-5 m-0">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
															</svg>
														</span>
                                            <!--end::Svg Icon--></a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{route('seller_orders.show', encrypt($order->id))}}" class="menu-link px-3">{{ translate('View') }}</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{ route('invoice.download', $order->id) }}" class="menu-link px-3">{{ translate('Download') }}</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 confirm-delete" data-href="{{route('orders.destroy', $order->id)}}"  data-kt-ecommerce-order-filter="delete_row">{{ translate('Delete') }}</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                    <!--end::Action=-->
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="aiz-pagination">
                            {{ $orders->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Content-->

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">
        function sort_orders(el){
            $('#sort_orders').submit();
        }
    </script>
@endsection
