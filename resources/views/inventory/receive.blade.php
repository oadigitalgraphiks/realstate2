@extends('backend.layouts.app')
@section('content')

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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Inventory</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
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
                    <li class="breadcrumb-item text-muted">Products</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Inventory Receive</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="card card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="col text-md-left">
                        <h2 class="mb-md-0 h6">{{ translate('Receive inventory') }}</h2>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card card-flush">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 text-center">
                                    <h4> Tracking Number # {{$inventory[0]->tracking_number}} </h4>
                                </div>
                                <div class="col-6 text-center">
                                    <h4> Warehouse : {{$inventory[0]->warehouse->name}} </h4>
                                    <h4> Seller : {{$inventory[0]->seller->user->name}} </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{route("inventory.receive.update")}}" method="POST">
                        @csrf
                        <div class="card card-flush">
                            <div class="row">
                                {{-- <div class="col-6">
                                    <div class="card-header align-items-center py-5 gap-2 gap-md-5 border mb-2">
                                        <div class="form-group">
                                            <label for="name">{{ translate('Select Seller') }}</label>
                                            <select class="form-select mb-2 js-data-example-ajax" data-control="select2" data-hide-search="false"data-placeholder="Select an Seller" id="seller_id" name="seller_id"
                                                data-live-search="true" required>
                                                <option value="">{{ translate('Select Seller') }}</option>
                                                @foreach ($sellers as $seller)
                                                    <option value="{{ $seller->id }}" {{$seller->id == $inventory->seller_id ? "selected" : ""}} >
                                                        {{ $seller->user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-6">
                                    <div class="card-header align-items-center py-5 gap-2 gap-md-5 border mb-2">
                                        <div class="form-group mb-3">
                                            <label for="name">{{ translate('Select Detination') }}</label>
                                            <select class="form-select mb-2 js-data-example-ajax" data-control="select2" data-hide-search="false" data-placeholder="Select an Warehouse" id="warehouse_id" name="warehouse_id" data-live-search="true" required>
                                                <option value="">{{ translate('Warehouse') }}</option>
                                                @foreach ($warehouses as $warehouse)
                                                    <option value="{{ $warehouse->id }}" {{$inventory->warehouse_id == $warehouse->id ? "selected" : ""}}> {{ $warehouse->getTranslation('name') }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>

                        {{-- <div class="form-group mb-3 row">
                            <label for="name">{{ translate('Select Products') }}</label>
                            <div class="mb-2 col-10">
                                <select class="form-select mb-2 js-data-product-ajax " data-control="select2" data-hide-search="false" data-placeholder="Select an Products" name="products[]" id="products" data-live-search="true" multiple="multiple" data-select>

                                </select>
                            </div>
                            <div class="mb-2 col-2">
                                <button type="button" class="btn btn-primary" onclick="create()">{{ translate('Browse') }}</button>
                            </div>
                        </div> --}}

                        <div class="fv-row mb-2 form-group">
                            <div class="table-responsive" id="product_list">
                                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                    <!--begin::Table head-->
                                    <thead>
                                        <!--begin::Table row-->
                                        <tr class="text-center text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="min-w-75px">{{ translate('Product') }}</th>
                                            <th class="text-center min-w-75px">{{ translate('SKU') }}</th>
                                            <th class="text-center min-w-75px">{{ translate('Accept') }}</th>
                                            <th class="text-center min-w-175px">{{ translate('Reject') }}</th>
                                            <th class="text-center min-w-175px">{{ translate('Total Receiving') }}</th>
                                        </tr>
                                        <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                        <!--begin::Table row-->
                                        @php
                                            $invent = array();
                                        @endphp
                                        @foreach ($inventory as $key => $inven)
                                            @php
                                                array_push($invent,$inven->id);
                                            @endphp
                                            <tr>
                                                {{-- @if (in_array($inven->stocks->variant,json_decode($product_stocks))) --}}
                                                    <tr>
                                                        <td class="text-center pe-0 col-md-2">
                                                            <span class="fw-bolder">
                                                                <div class="d-flex align-items-center">
                                                                    <!--begin::Thumbnail-->
                                                                    <a href="javascript:void(0)"
                                                                        class="symbol symbol-50px">
                                                                        <span class="symbol-label" style="background-image:url({{ uploaded_asset($inven->product->thumbnail_img)}});"></span>
                                                                    </a>
                                                                    <!--end::Thumbnail-->
                                                                    <div class="ms-5">
                                                                        <!--begin::Title-->
                                                                        {{ $inven->product->getTranslation('name')  }}
                                                                        <!--end::Title-->
                                                                    </div>
                                                                </div>
                                                            </span>
                                                            <table class="ms-20">
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                                            {{-- <input class="form-control d-none" type="text" name="product_id_{{$product->id}}_s_{{$stock->id}}" value="{{ $stock->id }}" /> --}}
                                                                            <div class="ms-5">
                                                                                <!--begin::Title-->
                                                                                <a href="javascript:void(0)" class="text-gray-800 text-hover-primary fs-5 fw-bolder" data-kt-ecommerce-product-filter="product_name">{{$inven->variant}}</a>
                                                                                <!--end::Title-->
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td class="col-md-2 text-center">
                                                            {{-- @if ($key == 0)
                                                                @dd($inven->stocks)
                                                            @endif --}}
                                                            {{-- Sku - {{$inven->stocks->where("variant",$inven->variant)}} --}}
                                                               Sku {{ $inven->stocks->where("variant",$inven->variant)->first()->sku }}

                                                        </td>
                                                        <td class="col-md-2">
                                                            {{-- onload="validation({{$inven->id}},{{$inven->receive_qty}},{{$inven->total_quantity}})" --}}
                                                            <link rel="stylesheet" href="#" onload="validation({{$inven->id}},{{$inven->receive_qty}},{{$inven->total_quantity}})"/>
                                                            <input type="number" hidden name="invent_{{$inven->id}}_receive_qty_stockid_{{$inven->stocks->id}}" value="{{$inven->stocks->qty - $inven->receive_qty}}"/>
                                                            <input class="form-control" type="number" onkeyup="set_progress({{$inven->id}},$('#receive_id_{{$inven->id}}').val());" id="receive_id_{{$inven->id}}" name="invent_{{$inven->id}}_receive_qty_stock_{{$inven->stocks->id}}" value="{{$inven->receive_qty ?? 0}}"/>
                                                        </td>
                                                        <td class="pe-10 col-md-2">
                                                            <div class="form-group mb-3 ms-10">
                                                                <input class="form-control" type="number" onkeyup="return_progress({{$inven->id}},$('#reject_id_{{$inven->id}}').val())" id="reject_id_{{$inven->id}}" name="invent_{{$inven->id}}_reject_qty_stock_{{$inven->stocks->id}}" value="{{$inven->return_qty ?? 0}}"/>
                                                            </div>
                                                        </td>
                                                        <td class="pe-10 col-md-2">
                                                            <div class="form-group mb-3 ms-10">
                                                                <input class="form-control" disabled type="number" id="total_qty_{{$inven->id}}" name="invent" value="{{$inven->total_quantity}}" />
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5">
                                                            <div class="progress" style="background-color: #d4dadf">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" id="progress_{{$inven->id}}" role="progressbar" style="width: {{ ($inven->receive_qty / $inven->total_quantity) * 100 }}%" aria-valuenow="{{$inven->receive_qty}}" aria-valuemin="0" aria-valuemax="{{$inven->total_quantity}}"></div>
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" id="progress_return_{{$inven->id}}" role="progressbar" style="width: {{ ($inven->return_qty / $inven->total_quantity) * 100 }}%" aria-valuenow="{{$inven->return_qty}}" aria-valuemin="0" aria-valuemax="{{$inven->total_quantity}}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                {{-- @endif --}}
                                            </tr>
                                        @endforeach
                                          {{-- @foreach ($products as $key => $product)
                                          @endforeach --}}
                                        <!--end::Table row-->
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                            </div>
                        </div>

                        {{-- <div class="card card-flush">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card-header align-items-center py-5 gap-2 gap-md-5 border mb-2">
                                        <div class="form-group">
                                            <h4>Shipment details</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">{{ translate('Estimated arrival') }}</label>
                                            <input type="date" class="form-control mb-2" name="estimate_arrival"
                                            placeholder="{{ translate('Select Date') }}" data-time-picker="true"
                                            data-format="DD-MM-Y HH:mm:ss" value="{{$inventory->estimate_arrival}}" data-separator=" to " autocomplete="off" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="name">{{ translate('Tracking number') }}</label>
                                            <input type="text" name="tracking_number" class="form-control" id="tracking_number" placeholder="{{ translate('Tracking Number') }}" value="{{$inventory->tracking_number}}" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="name">{{ translate('Shipping carrier') }}</label>
                                            <input type="text" name="shipping_carrire" class="form-control" id="shipping_carrire" placeholder="{{ translate('Shipping carrier') }}" value="{{$inventory->shipping_carrire}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card-header align-items-center py-5 gap-2 gap-md-5 border mb-2">
                                        <div class="form-group">
                                            <h4>Additional Details</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label for="name">{{ translate('Reference number') }}</label>
                                            <input type="text" name="reference_number" class="form-control" id="reference_number" placeholder="{{ translate('Reference number') }}" value="{{$inventory->reference_number}}" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <!--begin::Label-->
                                                <label class="form-label d-block">Tags</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input id="kt_ecommerce_add_product_tags" class="form-control mb-2" name="tags[]" placeholder="{{ translate('Type & add tag') }}" value="{{$inventory->tags}}" required>
                                                <div class="text-muted fs-7">
                                                    <span class="text-danger"> {{ translate('Type & hit enter add tag') }}.</span>
                                                    {{ translate('This is used for search. Input those words by which customer can find this product.') }}
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="form-group mb-3">
                            <label for="name">{{ translate('Select Reason') }}</label>
                            <select class="form-select mb-2 js-data-example-ajax" data-control="select2" data-hide-search="false" data-placeholder="Select an Reason" id="status" name="status" data-live-search="true">
                                <option value="">{{ translate('Reason') }}</option>
                                <option value="correction">{{translate('Correction')}}</option>
                                <option value="cycle_count_available">{{translate("Count")}}</option>
                                <option value="received">{{translate('Received')}}</option>
                                <option value="restock">{{translate('Return restock')}}</option>
                                <option value="damaged">{{translate('Damaged')}}</option>
                                <option value="shrinkage">{{translate('Theft or loss')}}</option>
                                <option value="promotion">{{translate('Pormotion or donation')}}</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="incoming">{{ translate('Incomming') }}</label>
                            <input type="text" name="incoming" class="form-control" id="incoming"
                                placeholder="{{ translate('Incoming') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="Available">'Available</label>
                            <input type="number" placeholder="0" name="available" class="form-control">
                        </div> --}}
                        <div class="form-group mb-3 text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Receive') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

    <script>

        function set_progress(inve_id,receive_id){
            var total = $("#total_qty_"+inve_id).val();
            var receive_qty = $("#receive_id_"+inve_id).val();
            var width = (receive_qty / total) * 100;
            $("#progress_"+inve_id).css('width',width + "%");
            validation(inve_id,receive_qty,total);
        }

        function return_progress(inve_id,reject_id){
            var total = $("#total_qty_"+inve_id).val();
            var return_qty = $("#reject_id_"+inve_id).val();
            var width = (return_qty / total) * 100;
            $("#progress_return_"+inve_id).css('width',width + "%");
            validation(inve_id,return_qty,total);
        }

        function validation(inve_id,receive_qty,total) {
            var total = $("#total_qty_"+inve_id).val();
            var receive_qty = $("#receive_id_"+inve_id).val();
            var return_qty = $("#reject_id_"+inve_id).val();
            $("#reject_id_"+inve_id).prop('max',total - receive_qty);
            $("#receive_id_"+inve_id).prop('max',total - return_qty);
        }

    </script>

@endsection
