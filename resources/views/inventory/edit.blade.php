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
                        <li class="breadcrumb-item text-dark">Inventory Edit</li>
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
                            <h2 class="mb-md-0 h6">{{ translate('Edit inventory transfer') }}</h2>
                        </div>
                        <div class="col" style="text-align: end;">
                            <a href="{{ route('inventory.receive', ['id' => $inventory[0]->tracking_number]) }}"
                                type="button" class="btn btn-success text-right">{{ translate('Receive Inventory') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('inventory.update',$inventory[0]->id)}}" method="POST">
                            <input name="_method" type="hidden" value="PATCH">
                            @csrf
                            <div class="card card-flush">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="card-header align-items-center py-5 gap-2 gap-md-5 border mb-2">
                                            {{-- Warehouse --}}
                                            <div class="form-group">
                                                <label for="name">{{ translate('Seller') }}</label>
                                                <h3>{{ $inventory[0]->seller->user->name }}</h3>
                                                <div class="col d-flex">
                                                    <h5>Address : </h5>&nbsp;
                                                    <p>{{ $inventory[0]->seller->user->addresses[0]->address }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card-header align-items-center py-5 gap-2 gap-md-5 border mb-2">
                                            {{-- Warehouse --}}
                                            <div class="form-group mb-3">
                                                <label for="name">{{ translate('Detination') }}</label>
                                                <h3>{{ $inventory[0]->warehouse->name }}</h3>
                                                <div class="col d-flex">
                                                    <h5>Address : </h5>&nbsp;
                                                    <p>{{ $inventory[0]->warehouse->address }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="form-group mb-3 row">
                                <label for="name">{{ translate('Select Products') }}</label>
                                <div class="mb-2 col-10">
                                    <select class="form-select mb-2 js-data-product-ajax " data-control="select2"
                                        data-hide-search="false" data-placeholder="Select an Products" name="products[]"
                                        id="products" data-live-search="true" multiple="multiple" data-select>

                                    </select>
                                </div>
                                <div class="mb-2 col-2">
                                    <button type="button" class="btn btn-primary"
                                        onclick="create()">{{ translate('Browse') }}</button>
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
                                                <th class="text-center min-w-75px">{{ translate('Unit Price') }}</th>
                                                <th class="text-center min-w-175px">{{ translate('Quantity') }}</th>
                                            </tr>
                                            <!--end::Table row-->
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody class="fw-bold text-gray-600">
                                            <!--begin::Table row-->
                                            @foreach ($inventory as $key => $inven)
                                                @php
                                                    $product = \App\Models\Product::where('id', $inven->product_id)->first();
                                                @endphp
                                                <tr>
                                                    @if ($product != null)
                                                        @foreach ($product->stocks->where("variant",$inven->variant) as $stock)
                                                            @if (in_array($stock->id, json_decode($product_stocks)))
                                                                <tr>
                                                                    <td class="text-center pe-0">
                                                                        <span class="fw-bolder">
                                                                            <div class="d-flex align-items-center">
                                                                                <!--begin::Thumbnail-->
                                                                                <a href="javascript:void(0)" class="symbol symbol-50px">
                                                                                    <span class="symbol-label"
                                                                                        style="background-image:url({{ uploaded_asset($product->thumbnail_img) }});"></span>
                                                                                </a>
                                                                                <!--end::Thumbnail-->
                                                                                <div class="ms-5">
                                                                                    {{-- <input class="form-control d-none" type="text" name="product_id[]" value="{{ $product->id }}" /> --}}
                                                                                    <input class="form-control d-none" type="text"
                                                                                        name="product_id_{{ $product->id }}_s_{{ $stock->id }}"
                                                                                        value="{{ $product->id }}" />
                                                                                    <!--begin::Title-->
                                                                                    {{ $product->getTranslation('name') }}
                                                                                    <!--end::Title-->
                                                                                </div>
                                                                            </div>
                                                                        </span>
                                                                        <table class="ms-20">
                                                                            <tr>
                                                                                <td>
                                                                                    <div
                                                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                                                        {{-- <input class="form-control d-none" type="text" name="variant_id[]" value="{{ $stock->id }}" /> --}}
                                                                                        <input class="form-control d-none" type="text"
                                                                                            name="product_id_{{ $product->id }}_s_{{ $stock->id }}"
                                                                                            value="{{ $stock->id }}" />
                                                                                        <div class="ms-5">
                                                                                            <!--begin::Title-->
                                                                                            <a href="javascript:void(0)"
                                                                                                class="text-gray-800 text-hover-primary fs-5 fw-bolder"
                                                                                                data-kt-ecommerce-product-filter="product_name">{{ $stock->variant }}</a>
                                                                                            <!--end::Title-->
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                    <td>
                                                                        <input class="form-control d-none" type="text" name="product_id_{{ $product->id }}_s_{{ $stock->id }}_sku" value="{{ $stock->sku }}" />
                                                                        Sku - {{ $stock->sku }}
                                                                    </td>
                                                                    <td>
                                                                        <input class="form-control" type="text"
                                                                            name="product_id_{{ $product->id }}_s_{{ $stock->id }}_price"
                                                                            value="{{ $inven->purchase_price }}" disabled/>
                                                                    </td>
                                                                    <td class="pe-10">
                                                                        <div class="form-group mb-3 ms-10">
                                                                            <div class="progress">
                                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{ ($inven->receive_qty / $inven->total_quantity) * 100 }}%" aria-valuenow="{{$inven->receive_qty}}" aria-valuemin="0" aria-valuemax="{{$inven->total_quantity}}"></div>
                                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: {{ ($inven->return_qty / $inven->total_quantity) * 100 }}%" aria-valuenow="{{$inven->return_qty}}" aria-valuemin="0" aria-valuemax="{{$inven->total_quantity}}">
                                                                                </div>
                                                                            </div>
                                                                            {{ $inven->return_qty + $inven->receive_qty  }} / {{ $inven->total_quantity }}
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                @else

                                                                <tr>
                                                                    <td class="text-center pe-0">
                                                                        <span class="fw-bolder">
                                                                            <div class="d-flex align-items-center">
                                                                                <!--begin::Thumbnail-->
                                                                                <a href="javascript:void(0)" class="symbol symbol-50px">
                                                                                    <span class="symbol-label"
                                                                                        style="background-image:url({{ uploaded_asset($product->thumbnail_img) }});"></span>
                                                                                </a>
                                                                                <!--end::Thumbnail-->
                                                                                <div class="ms-5">
                                                                                    {{-- <input class="form-control d-none" type="text" name="product_id[]" value="{{ $product->id }}" /> --}}
                                                                                    <input class="form-control d-none" type="text"
                                                                                        name="product_id_{{ $product->id }}_s_{{ $stock->id }}"
                                                                                        value="{{ $product->id }}" />
                                                                                    <!--begin::Title-->
                                                                                    {{ $product->getTranslation('name') }}
                                                                                    <!--end::Title-->
                                                                                </div>
                                                                            </div>
                                                                        </span>
                                                                        <table class="ms-20">
                                                                            <tr>
                                                                                <td>
                                                                                    <div
                                                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                                                        {{-- <input class="form-control d-none" type="text" name="variant_id[]" value="{{ $stock->id }}" /> --}}
                                                                                        <input class="form-control d-none" type="text"
                                                                                            name="product_id_{{ $product->id }}_s_{{ $stock->id }}"
                                                                                            value="{{ $stock->id }}" />
                                                                                        <div class="ms-5">
                                                                                            <!--begin::Title-->
                                                                                            <a href="javascript:void(0)"
                                                                                                class="text-gray-800 text-hover-primary fs-5 fw-bolder"
                                                                                                data-kt-ecommerce-product-filter="product_name">{{ $stock->variant }}</a>
                                                                                            <!--end::Title-->
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                    <td>
                                                                        <input class="form-control d-none" type="text" name="product_id_{{ $product->id }}_s_{{ $stock->id }}_sku" value="{{ $stock->sku }}" />
                                                                        Sku - {{ $stock->sku }}
                                                                    </td>
                                                                    <td>
                                                                        <input class="form-control" type="text"
                                                                            name="product_id_{{ $product->id }}_s_{{ $stock->id }}_price"
                                                                            value="{{ $inven->purchase_price }}" disabled/>
                                                                    </td>
                                                                    <td class="pe-10">
                                                                        <div class="form-group mb-3 ms-10">
                                                                            <div class="progress">
                                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{ ($inven->receive_qty / $inven->total_quantity) * 100 }}%" aria-valuenow="{{$inven->receive_qty}}" aria-valuemin="0" aria-valuemax="{{$inven->total_quantity}}"></div>
                                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: {{ ($inven->return_qty / $inven->total_quantity) * 100 }}%" aria-valuenow="{{$inven->return_qty}}" aria-valuemin="0" aria-valuemax="{{$inven->total_quantity}}">
                                                                                </div>
                                                                            </div>
                                                                            {{ $inven->return_qty + $inven->receive_qty  }} / {{ $inven->total_quantity }}
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td class="text-center pe-0 col-md-4">
                                                                <span class="fw-bolder">
                                                                    <div class="d-flex align-items-center">
                                                                        <!--begin::Thumbnail-->
                                                                        <a href="javascript:void(0)" class="symbol symbol-50px">
                                                                            <span class="symbol-label"
                                                                                style="background-image:url();" alt="N/A"></span>
                                                                        </a>
                                                                        <!--end::Thumbnail-->
                                                                        <div class="ms-5">
                                                                            {{-- <input class="form-control d-none" type="text" name="product_id[]" value="{{ $product->id }}" /> --}}
                                                                            <input class="form-control d-none" type="text"
                                                                                name="product_id_{{ $inven->product_id }}_s_{{ $inven->stock_id }}"
                                                                                value="{{ $inven->product_id }}" />
                                                                            <!--begin::Title-->
                                                                            {{ $product->name ?? "N/A" }}
                                                                            <!--end::Title-->
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                                <table class="ms-20">
                                                                    <tr>
                                                                        <td>
                                                                            <div
                                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                                {{-- <input class="form-control d-none" type="text" name="variant_id[]" value="{{ $stock->id }}" /> --}}
                                                                                <input class="form-control d-none" type="text"
                                                                                    name="product_id_{{ $inven->product_id }}_s_{{ $inven->stock_id }}"
                                                                                    value="{{ $inven->stock_id }}" />
                                                                                <div class="ms-5">
                                                                                    <!--begin::Title-->
                                                                                    <a href="javascript:void(0)"
                                                                                        class="text-gray-800 text-hover-primary fs-5 fw-bolder"
                                                                                        data-kt-ecommerce-product-filter="product_name">{{ $inven->variant }}</a>
                                                                                    <!--end::Title-->
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td class="col-md-2 text-center">
                                                                <input class="form-control d-none" type="text" name="product_id_{{ $inven->product_id }}_s_{{ $inven->stock_id }}_sku" value="{{ $inven->sku }}" />
                                                                Sku - {{ $inven->stocks->where('product_id',$inven->product_id)->where('variant',$inven->variant)->sku }}
                                                            </td>
                                                            <td class="col-md-2">
                                                                <input class="form-control" type="text"
                                                                    name="product_id_{{ $inven->product_id }}_s_{{ $inven->stock_id }}_price"
                                                                    value="{{ $inven->purchase_price }}" disabled/>
                                                            </td>
                                                            <td class="pe-10 col-md-2">
                                                                <div class="form-group mb-3 ms-10">
                                                                    <div class="progress">
                                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{ ($inven->receive_qty / $inven->total_quantity) * 100 }}%" aria-valuenow="{{$inven->receive_qty}}" aria-valuemin="0" aria-valuemax="{{$inven->total_quantity}}"></div>
                                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: {{ ($inven->return_qty / $inven->total_quantity) * 100 }}%" aria-valuenow="{{$inven->return_qty}}" aria-valuemin="0" aria-valuemax="{{$inven->total_quantity}}">
                                                                        </div>
                                                                    </div>
                                                                    {{ $inven->return_qty + $inven->receive_qty  }} / {{ $inven->total_quantity }}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            <!--end::Table row-->
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                </div>
                            </div>

                            <div class="card card-flush">
                                <div class="row">
                                    <div class="col-6">
                                        {{-- <div class="card-header align-items-center py-5 gap-2 gap-md-5 border mb-2">
                                    </div> --}}
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
                                                    data-format="DD-MM-Y HH:mm:ss"
                                                    value="{{ $inventory[0]->estimate_arrival }}" data-separator=" to "
                                                    autocomplete="off" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="text" name="tracking_number_current" class="form-control"
                                                    id="tracking_number" placeholder="{{ translate('Tracking Number') }}"
                                                    value="{{ $inventory[0]->tracking_number }}" hidden>
                                                <label for="name">{{ translate('Tracking number') }}</label>
                                                <input type="text" name="tracking_number" class="form-control"
                                                    id="tracking_number" placeholder="{{ translate('Tracking Number') }}"
                                                    value="{{ $inventory[0]->tracking_number }}" required>
                                                @error('tracking_number')
                                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="name">{{ translate('Shipping carrier') }}</label>
                                                <input type="text" name="shipping_carrire" class="form-control"
                                                    id="shipping_carrire"
                                                    placeholder="{{ translate('Shipping carrier') }}"
                                                    value="{{ $inventory[0]->shipping_carrire }}" required>
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
                                                <input type="text" name="reference_number" class="form-control"
                                                    id="reference_number"
                                                    placeholder="{{ translate('Reference number') }}"
                                                    value="{{ $inventory[0]->reference_number }}" required>
                                            </div>
                                            <div class="form-group mb-3 d-none">
                                                <!--begin::Label-->
                                                <label class="form-label d-block">Tags</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                {{-- @dd(json_decode($inventory[0]->tags,true)) --}}
                                                <input id="kt_ecommerce_add_inventory_tags" class="form-control mb-2" name="tags[]" placeholder="{{ translate('Type & add tag') }}">
                                                <div class="text-muted fs-7">
                                                    <span class="text-danger">
                                                        {{ translate('Type & hit enter add tag') }}.</span>
                                                    {{ translate('This is used for search. Input those words by which customer can find this product.') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
    if (!empty(session()->get('product_selected'))) {
        $pro_selected = json_encode(session()->get('product_selected'));
    } else {
        $pro_selected = [];
    }
    @endphp
@endsection

@section('modal')
    <div class="modal fade" id="create-inventory" tabindex="-1" aria-labelledby="create-inventory" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ translate('Inventory Create') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="transfer_product" method="POST">
                    @csrf
                    <div class="modal-body" id="inventory_create">

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="add_transfer"
                            data-bs-dismiss="modal">{{ translate('Add') }}</button>
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ translate('Cancel') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        $(document).ready(function() {
            products();

            // var pro_selected = <?php print_r($pro_selected); ?>;

            // var dataString = pro_selected;

            // console.log(dataString);

            // if (dataString != '[]') {
            //     $.ajax({
            //     type: "POST",
            //     url: "{{ route('inventory.transfer_product') }}",
            //     data: {
            //             "_token": "{{ csrf_token() }}",
            //             "product_id":dataString,
            //         },
            //         success: function (data) {
            //             $("#product_list").html(data);
            //             // console.log(data);
            //             // Display message back to the user here
            //         }
            //     });
            // }

        });

        $("#transfer_product").on("submit", function(e) {
            var dataString = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('inventory.transfer_product') }}",
                data: dataString,
                success: function(data) {
                    $("#product_list").html(data);
                    // console.log(data);
                    // Display message back to the user here
                }
            });

            e.preventDefault();
        })

        $("add_transfer").click(function() {
            $("#product_list").html(null);
            $.ajax({
                type: 'GET',
                enctype: 'multipart/form-data',
                url: "{{ route('inventory.transfer_product') }}",
                success: function(data) {
                    $("#product_list").html(data);
                }
            });
        })

        function create() {
            $('#inventory_create').html(null);
            $("#create-inventory").modal('show');
            $.ajax({
                type: 'GET',
                enctype: 'multipart/form-data',
                url: "{{ route('inventory.all_product') }}",
                success: function(data) {
                    $('#inventory_create').html(data);
                    $(".js-data-example-ajax").select2();
                    products();
                }
            });
        }


        function products() {
            $(".js-data-product-ajax").select2({
                ajax: {
                    url: "{{ route('inventory.search') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;
                        // console.log(data);
                        // console.log(data.data[0].items);
                        // console.log(params);
                        // return
                        return {
                            results: data.items,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a product',
                minimumInputLength: 1,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });
        }

        function formatRepo(repo) {
            if (repo.loading) {
                return repo.text;
            }
            var stocks = repo.stocks;
            var $container = $(
                `<div class='select2-result-repository clearfix' style='display:flex; align-items:center'>
                    <div class='select2-result-repository__avatar' style="margin-right:10px">
                        <span style="background-image: url('` + repo.thumbnail_img + `');
                        height: 50px;
                        width: 50px;
                        background-position: center;
                        background-size: cover;
                        background-repeat: no-repeat;
                        display: block;
                        border-radius: 4px;
                        "></span>
                    </div>
                    <div class='select2-result-repository__title'></div>
                    <br>
                    <div class='select2-result-repository__variant'></div>
                    <div class='select2-result-repository__meta'>
                    <div class='select2-result-repository__description'></div>
                    </div>
                </div>`
            );
            repo.stocks.forEach(items => {
                $container.find(".select2-result-repository__variant").text(items.variant);
                console.log(items);
            });
            $container.find(".select2-result-repository__title").text(repo.name);
            // $container.find(".select2-result-repository__description").text(repo.description);

            return $container;
        }

        function formatRepoSelection(repo) {
            return repo.name || repo.text;
        }

        $('#products').on('change', function() {
            var product_ids = $('#products').val();
            if (product_ids.length > 0) {
                $.post('{{ route('inventory.product_list') }}', {
                    _token: '{{ csrf_token() }}',
                    product_ids: product_ids
                }, function(data) {
                    $('#product_list').html(data);
                    AIZ.plugins.fooTable();
                });
            } else {
                $('#product_list').html(null);
            }
        });
    </script>

@endsection
