@extends('frontend.layouts.user_panel')

@section('panel_content')
<div class="tab-pane fade active show" id="orders" role="tabpanel" aria-labelledby="orders-tab">
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">{{translate("Your Orders")}}</h3>
        </div>
        @if (count($orders) > 0)
            <div class="card-body">
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                            <tr class="main-heading">
                                <th scope="col" class=" start pl-30">{{ translate('Code')}}</th>
                                <th scope="col">{{ translate('Date')}}</th>
                                <th scope="col">{{ translate('Amount')}}</th>
                                <th scope="col">{{ translate('Delivery Status')}}</th>
                                <th scope="col">{{ translate('Payment Status')}}</th>
                                <th scope="col" class="end">{{ translate('Options')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                                @if (count($order->orderDetails) > 0)
                                    <tr class="pt-30">
                                        <td class="tdend price  start pl-30">
                                            <a href="#{{ $order->code }}" onclick="show_purchase_history_details({{ $order->id }})">{{ $order->code }}</a>
                                        </td>
                                        <td class="tdend">{{ date('d-m-Y', $order->date) }}</td>
                                        <td class="tdend">
                                            {{ single_price($order->grand_total) }}
                                        </td>
                                        <td class="tdend">
                                            {{ translate(ucfirst(str_replace('_', ' ', $order->delivery_status))) }}
                                            @if($order->delivery_viewed == 0)
                                                <span class="ml-2" style="color:green"><strong>*</strong></span>
                                            @endif
                                        </td>
                                        <td class="tdend detail-info">
                                            @if ($order->payment_status == 'paid')
                                                <span class="badge badge-inline badge-success">{{translate('Paid')}}</span>
                                            @else
                                                <span class="badge badge-inline badge-danger">{{translate('Unpaid')}}</span>
                                            @endif
                                            @if($order->payment_status_viewed == 0)
                                                <span class="ml-2" style="color:green"><strong>*</strong></span>
                                            @endif
                                        </td>
                                        <td class="action tdend d-flex">
                                            {{-- @if ($order->orderDetails->first()->delivery_status == 'pending' && $order->payment_status == 'unpaid')
                                                <a href="javascript:void(0)" class="pr-5 btn-sm d-block confirm-delete" data-href="{{route('orders.destroy', $order->id)}}" title="{{ translate('Cancel') }}">
                                                <i class="las la-trash fs-5"></i>
                                            </a>
                                            @endif --}}
                                            <a href="javascript:void(0)" class="pr-5 btn-sm d-block" onclick="show_purchase_history_details({{ $order->id }})" title="{{ translate('Order Details') }}">
                                                <i class="las la-eye fs-5"></i>
                                            </a>
                                            <a class="pr-5 btn-sm d-block" href="{{ route('invoice.download', $order->id) }}" title="{{ translate('Download Invoice') }}">
                                                <i class="las la-download fs-5"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="aiz-pagination">
                    {{ $orders->links() }}
              	</div>
            </div>
        @else
            <div class="col">
                <div class="text-center bg-white p-4 rounded shadow">
                    <img class="mw-100 h-200px" src="{{ static_asset('assets/img/nothing.svg') }}" alt="Image">
                    <h5 class="mb-0 h5 mt-3">{{ translate("There isn't anything added yet")}}</h5>
                </div>
            </div>
        @endif
    </div>
</div>
    {{-- <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Purchase History') }}</h5>
        </div>
        @if (count($orders) > 0)
            <div class="card-body">
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>{{ translate('Code')}}</th>
                            <th data-breakpoints="md">{{ translate('Date')}}</th>
                            <th>{{ translate('Amount')}}</th>
                            <th data-breakpoints="md">{{ translate('Delivery Status')}}</th>
                            <th data-breakpoints="md">{{ translate('Payment Status')}}</th>
                            <th class="text-right">{{ translate('Options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key => $order)
                            @if (count($order->orderDetails) > 0)
                                <tr>
                                    <td>
                                        <a href="#{{ $order->code }}" onclick="show_purchase_history_details({{ $order->id }})">{{ $order->code }}</a>
                                    </td>
                                    <td>{{ date('d-m-Y', $order->date) }}</td>
                                    <td>
                                        {{ single_price($order->grand_total) }}
                                    </td>
                                    <td>
                                        {{ translate(ucfirst(str_replace('_', ' ', $order->delivery_status))) }}
                                        @if($order->delivery_viewed == 0)
                                            <span class="ml-2" style="color:green"><strong>*</strong></span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order->payment_status == 'paid')
                                            <span class="badge badge-inline badge-success">{{translate('Paid')}}</span>
                                        @else
                                            <span class="badge badge-inline badge-danger">{{translate('Unpaid')}}</span>
                                        @endif
                                        @if($order->payment_status_viewed == 0)
                                            <span class="ml-2" style="color:green"><strong>*</strong></span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if ($order->orderDetails->first()->delivery_status == 'pending' && $order->payment_status == 'unpaid')
                                            <a href="javascript:void(0)" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('orders.destroy', $order->id)}}" title="{{ translate('Cancel') }}">
                                               <i class="las la-trash"></i>
                                           </a>
                                        @endif
                                        <a href="javascript:void(0)" class="btn btn-soft-info btn-icon btn-circle btn-sm" onclick="show_purchase_history_details({{ $order->id }})" title="{{ translate('Order Details') }}">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="{{ route('invoice.download', $order->id) }}" title="{{ translate('Download Invoice') }}">
                                            <i class="las la-download"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination">
                    	{{ $orders->links() }}
              	</div>
            </div>
        @endif
    </div> --}}
@endsection

@section('modal')
    @include('modals.delete_modal')

    <div class="modal fade custom-modal" id="order_details" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content mp-20">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
                <div class="modal-body gry-bg px-3 pt-3 fixed-scroll-ul" id="order-details-modal-body" style="max-height: 500px; width: 100%;">

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div id="payment_modal_body">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $('#order_details').on('hidden.bs.modal', function () {
            location.reload();
        })
    </script>

@endsection
