    <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
        <!--begin::Table head-->
        <thead>
            <!--begin::Table row-->
            <tr class="text-center text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                {{-- <th class="w-10px pe-2">
                    <div
                        class="form-check form-check-sm form-check-custom form-check-solid me-3">
                        <input class="form-check-input check-all" type="checkbox" data-kt-check="true" />
                    </div>
                </th> --}}
                <th class="min-w-75px">{{ translate('Product') }}</th>
                <th class="text-center min-w-175px">{{ translate('Total Available') }}</th>
            </tr>
            <!--end::Table row-->
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody class="fw-bold text-gray-600">
            <!--begin::Table row-->
            @foreach ($products as $key => $product)
            <tr>
                <td style="vertical-align: top">
                    <div
                        class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input check-all" type="checkbox" @if(isset($product_selected)) {{in_array($product->id,$product_selected) == true ? "checked" : ''}} @endif name="product_id[]" value="{{ $product->id }}" />
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <!--begin::Thumbnail-->
                        <a href="{{ route('product', $product->slug) }}"
                            class="symbol symbol-50px">
                            <span class="symbol-label" style="background-image:url({{ uploaded_asset($product->thumbnail_img) }});"></span>
                        </a>
                        <!--end::Thumbnail-->
                        <div class="ms-5">
                            <!--begin::Title-->
                            <a href="{{ route('product', $product->slug) }}" class="text-gray-800 text-hover-primary fs-5 fw-bolder" data-kt-ecommerce-product-filter="product_name">{{ $product->getTranslation('name') }}</a>
                            <!--end::Title-->
                        </div>
                    </div>
                    <table class="ms-20">
                        @foreach ($product->stocks as $key => $stocks)
                            @if (!empty($stocks->variant))
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input check-one" @if(isset($variant_selected)) {{in_array($stocks->id,$variant_selected) == true ? "checked" : ''}} @endif type="checkbox" name="stock_id[]" value="{{ $stocks->id }}" />
                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="javascript:void(0)" class="text-gray-800 text-hover-primary fs-5 fw-bolder" data-kt-ecommerce-product-filter="product_name">{{$stocks->variant}}</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pe-10 bold">
                                        {{$stocks->qty}}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </td>
                @php
                $qty = 0;
                    foreach ($product->stocks as $key => $stock) {
                        $qty += $stock->qty;
                    }
                @endphp
                <td class="text-center">{{$qty}}</td>
            </tr>
            @endforeach
            <!--end::Table row-->
        </tbody>
        <!--end::Table body-->
    </table>
  <!--end::Table-->
</form>



<script>
    $(document).ready(function(){

            $('.check-all').parent().parent().parent().find('.check-one').attr('disabled',true);
            if($(".check-all").is(':checked')){
                $('.check-all').parent().parent().parent().find('.check-one').attr('disabled',false);
            }

            $('.check-all').on('change',function(){
                if($(this).is(':checked')){
                    $(this).parent().parent().parent().find('.check-one').prop('checked',true);
                    $(this).parent().parent().parent().find('.check-one').attr('disabled',false);
                }else{
                    $(this).parent().parent().parent().find('.check-one').prop('checked',false);
                    $(this).parent().parent().parent().find('.check-one').attr('disabled',true);
                }
            });
        });
</script>
