@if(count($product_ids) > 0)
  <!--begin::Table-->
  <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
      <!--begin::Table head-->
      <thead>
          <!--begin::Table row-->
          <tr class="text-center text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
              <th class="text-center min-w-75px">{{ translate('Product') }}</th>
              <th class="text-center min-w-75px">{{ translate('Base Price') }}</th>
              <th class="text-center min-w-175px">{{ translate('Discount') }}</th>
              <th class="text-center min-w-150px">{{ translate('Discount Type') }}</th>
          </tr>
          <!--end::Table row-->
      </thead>
      <!--end::Table head-->
      <!--begin::Table body-->
      <tbody class="fw-bold text-gray-600">
          <!--begin::Table row-->
          @foreach ($product_ids as $key => $id)
              @php
                $product = \App\Models\Product::findOrFail($id);
              @endphp
              <tr>
                  <td class="text-center pe-0">
                      <span class="fw-bolder">
                        <div class="d-flex align-items-center">
                          <!--begin::Thumbnail-->
                          <a href="javascript:void(0)"
                              class="symbol symbol-50px">
                              <span class="symbol-label"
                                  style="background-image:url({{ uploaded_asset($product->thumbnail_img)}});"></span>
                          </a>
                          <!--end::Thumbnail-->
                          <div class="ms-5">
                              <!--begin::Title-->
                              {{ $product->getTranslation('name')  }}
                              <!--end::Title-->
                          </div>
                        </div>
                      </span>
                  </td>
                  <!--end::Category=-->
                  <td class="text-center pe-0">
                      <span class="fw-bolder">
                        {{ $product->unit_price }}
                      </span>
                  </td>
                  <!--end::SKU=-->
                  <!--begin::Qty=-->
                  <td class="pe-0 w-150px" data-order="32">
                    <div class="fv-row">
                      <input type="number" name="discount_{{ $id }}"
                          class="form-control mb-2" min="0" step="1" required>
                    </div>
                  </td>
                  <!--end::Qty=-->
                  <td class="pe-0 w-150px" data-order="32">
                      <select class="form-select text-center" data-control="select2" data-hide-search="false"
                          data-placeholder="Select an option" id="discount_type_" name="discount_type_{{ $id }}"
                          data-live-search="true">
                          <option value="amount">{{ translate('Flat') }}</option>
                          <option value="percent">{{ translate('Percent') }}</option>
                      </select>
                  </td>
                  <!--end::Qty=-->
                 
              </tr>
          @endforeach
          <!--end::Table row-->
      </tbody>
      <!--end::Table body-->
  </table>
  <!--end::Table-->
@endif

{{-- @if(count($product_ids) > 0)
<table class="table table-bordered aiz-table">
  <thead>
  	<tr>
  		<td width="50%">
          <span>{{translate('Product')}}</span>
  		</td>
      <td data-breakpoints="lg" width="20%">
          <span>{{translate('Base Price')}}</span>
  		</td>
  		<td data-breakpoints="lg" width="20%">
          <span>{{translate('Discount')}}</span>
  		</td>
      <td data-breakpoints="lg" width="10%">
          <span>{{translate('Discount Type')}}</span>
      </td>
  	</tr>
  </thead>
  <tbody>
      @foreach ($product_ids as $key => $id)
      	@php
      		$product = \App\Models\Product::findOrFail($id);
      	@endphp
          <tr>
            <td>
              <div class="from-group row">
                <div class="col-auto">
                  <img class="size-60px img-fit" src="{{ uploaded_asset($product->thumbnail_img)}}">
                </div>
                <div class="col">
                  <span>{{  $product->getTranslation('name')  }}</span>
                </div>
              </div>
            </td>
            <td>
                <span>{{ $product->unit_price }}</span>
            </td>
            <td>
                <input type="number" lang="en" name="discount_{{ $id }}" value="{{ $product->discount }}" min="0" step="1" class="form-control" required>
            </td>
            <td>
                <select class="form-control aiz-selectpicker" name="discount_type_{{ $id }}">
                  <option value="amount">{{ translate('Flat') }}</option>
                  <option value="percent">{{ translate('Percent') }}</option>
                </select>
            </td>
          </tr>
      @endforeach
  </tbody>
</table>
@endif --}}
