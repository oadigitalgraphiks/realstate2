@extends('frontend.layouts.user_panel')

@section('panel_content')
<div class="tab-pane fade active show" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">{{translate("Orders tracking")}}</h3>
        </div>
        <div class="card-body contact-from-area">
            <p>{{translate("To track your order please enter your OrderID in the box below and press 'Track' button. This was given to you on your receipt and in the confirmation email you should have received")}}.</p>
            <div class="row">
                <div class="col-lg-8">
                    <form class="contact-form-style mt-30 mb-50" action="{{ route('orders.track') }}" method="GET" enctype="multipart/form-data">
                        <div class="input-style mb-20">
                            <label>{{ translate('Order Code')}}</label>
                            <input type="text" class="form-control mb-3" value="{{ $order->code ?? "" }}" placeholder="{{ translate('Order Code')}}" name="order_code" required>
                        </div>
                        <button class="submit submit-auto-width" type="submit">{{translate("Track")}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="mb-5">
    <div class="container text-left">
        @isset($order)
            <div class="bg-white rounded shadow-sm mt-5">
                <div class="fs-15 fw-600 p-3 border-bottom">
                    {{ translate('Order Summary')}}
                </div>
                <div class="p-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Order Code')}}:</td>
                                    <td>{{ $order->code }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Customer')}}:</td>
                                    <td>{{ json_decode($order->shipping_address)->name }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Email')}}:</td>
                                    @if ($order->user_id != null)
                                        <td>{{ $order->user->email }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Shipping address')}}:</td>
                                    <td>{{ json_decode($order->shipping_address)->address }}, {{ json_decode($order->shipping_address)->city }}, {{ json_decode($order->shipping_address)->country }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Order date')}}:</td>
                                    <td>{{ date('d-m-Y H:i A', $order->date) }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Total order amount')}}:</td>
                                    <td>{{ single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax')) }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Shipping method')}}:</td>
                                    <td>{{ translate('Flat shipping rate')}}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Payment method')}}:</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}</td>
                                </tr>
                                <tr>
                                    <td class="w-50 fw-600">{{ translate('Delivery Status')}}:</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $order->delivery_status)) }}</td>
                                </tr>
                                @if ($order->tracking_code)
                                    <tr>
                                        <td class="w-50 fw-600">{{ translate('Tracking code')}}:</td>
                                        <td>{{ $order->tracking_code }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($order->orderDetails as $key => $orderDetail)
                @php
                    $status = $order->delivery_status;
                @endphp
                <div class="bg-white rounded shadow-sm mt-4">

                    @if($orderDetail->product != null)
                    <div class="p-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ translate('Product Name')}}</th>
                                    <th>{{ translate('Quantity')}}</th>
                                    <th>{{ translate('Shipped By')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>{{ $orderDetail->product->getTranslation('name') }} ({{ $orderDetail->variation }})</td>
                                    <td>{{ $orderDetail->quantity }}</td>
                                    <td>{{ $orderDetail->product->user->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            @endforeach

        @endisset
    </div>
</section>

@endsection
