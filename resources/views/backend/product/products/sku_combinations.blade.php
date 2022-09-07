@if(count($combinations[0]) > 0)
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
            <!--begin::Table head-->
            <thead>
            <tr class="fw-bolder text-muted bg-light">
                <th class="min-w-150px text-center">{{translate('Variant')}}</th>
                <th class="min-w-140pxtext-center">{{translate('Variant Price')}}</th>
                <th class="min-w-120px text-center">{{translate('SKU')}}</th>
                <th class="min-w-120px text-center">{{translate('Quantity')}}</th>
                <th class="min-w-200px text-center">{{translate('Photo')}}</th>
            </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody>
            @foreach ($combinations as $key => $combination)
                @php
                    $sku = '';
                    foreach (explode(' ', $product_name) as $key => $value) {
                        $sku .= substr($value, 0, 1);
                    }

                    $str = '';
                    foreach ($combination as $key => $item){
                        if($key > 0 ){
                            $str .= '-'.str_replace(' ', '', $item);
                            $sku .='-'.str_replace(' ', '', $item);
                        }
                        else{
                            if($colors_active == 1){
                                $color_name = \App\Models\Color::where('code', $item)->first()->name;
                                $str .= $color_name;
                                $sku .='-'.$color_name;
                            }
                            else{
                                $str .= str_replace(' ', '', $item);
                                $sku .='-'.str_replace(' ', '', $item);
                            }
                        }
                    }
                @endphp
                @if(strlen($str) > 0)
                    <tr class="variant">
                        <td>
                            <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{ $str }}</a>
                        </td>
                        <td>
                            <input type="number" lang="en" name="price_{{ $str }}" value="{{ $unit_price }}" min="0" step="0.01" class="form-control mb-2" required>
                        </td>
                        <td>
                            <input type="text" name="sku_{{ $str }}" value="" class="form-control mb-2">
                        </td>
                        <td>
                            <input type="number" lang="en" name="qty_{{ $str }}" value="10" min="0" step="1" class="form-control mb-2" required>
                        </td>
                        <td>
                            <div class=" input-group " data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount text-truncate">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="img_{{ $str }}" class="selected-files">
                            </div>
                            <div class="file-preview box sm"></div>
                        </td>
                    </tr>
                @endif
            @endforeach


            </tbody>
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
@endif
