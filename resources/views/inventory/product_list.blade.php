@if (count($products) > 0)
    <!--begin::Table-->
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
            @foreach ($products as $key => $product)
                <tr>
                    @foreach ($product->stocks as $stock)
                        @if ($product_stocks != null)
                            @if (in_array($stock->id, json_decode($product_stocks)) || ($product->attributes == '[]' && $product->colors == '[]'))
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
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
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
                                        <input class="form-control d-none" type="text"
                                            name="product_id_{{ $product->id }}_s_{{ $stock->id }}_sku"
                                            value="{{ $stock->sku }}" />
                                        Sku - {{ $stock->sku }}
                                    </td>
                                    <td>
                                        <input class="form-control" type="text"
                                            name="product_id_{{ $product->id }}_s_{{ $stock->id }}_price"
                                            value="{{ $stock->price }}" />
                                    </td>
                                    <td class="pe-10">
                                        <div class="form-group mb-3 ms-10 d-flex ml-10">
                                            <input class="form-control" type="number"
                                                name="p_qty_{{ $product->id }}_s_{{ $stock->id }}" min="1" />
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td class="text-center pe-0 col-md-4">
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
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
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
                                <td class="text-center col-3">
                                    <input class="form-control d-none" type="text"
                                        name="product_id_{{ $product->id }}_s_{{ $stock->id }}_sku"
                                        value="{{ $stock->sku }}" />
                                    Sku - {{ $stock->sku }}
                                </td>
                                <td class="text-center col-3">
                                    <input class="form-control" type="text"
                                        name="product_id_{{ $product->id }}_s_{{ $stock->id }}_price"
                                        value="{{ $stock->price }}" />
                                </td>
                                <td class="pe-10 col-3">
                                    <div class="form-group mb-3 ms-10 d-flex ml-10">
                                        <input class="form-control" type="number"
                                            name="p_qty_{{ $product->id }}_s_{{ $stock->id }}" min="1" />
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tr>
            @endforeach
<!--end::Table row-->
</tbody>
<!--end::Table body-->
</table>
<!--end::Table-->
@endif
