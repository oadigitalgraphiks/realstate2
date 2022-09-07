
<div class="card-header mb-2 p-0">
    <h3 class="h6">{{translate('Add Your Cart Base Coupon')}}</h3>
</div>


<div class="form-group row">
    <label class="col-lg-3 col-from-label" for="coupon_code">{{translate('Coupon code')}}</label>
    <div class="col-lg-9">
        <input type="text" placeholder="{{translate('Coupon code')}}" id="coupon_code" name="coupon_code" class="form-control" required>
    </div>
</div>

<div class="form-group row mt-5">
   <label for="required kt_ecommerce_add_product_store_template" class="col-lg-3  form-label">{{translate('Minimum Shopping')}}</label>
   <div class="col-lg-9">
      <input type="number" lang="en" min="0" step="0.01" placeholder="{{translate('Minimum Shopping')}}" name="min_buy" class="form-control" required>
   </div>
</div>

<div class="form-group row mt-5">
   <label class="col-lg-3 col-from-label">{{translate('Discount')}}</label>
   <div class="col-lg-7">
      <input type="number" lang="en" min="0" step="0.01" placeholder="{{translate('Discount')}}" name="discount" class="form-control" required>
   </div>
   <div class="form-group col-2">
        <select class="form-select mb-2 js-data-example-ajax" data-control="select2" data-hide-search="false"
            data-placeholder="Select an option" name="discount_type" id="discount_type"
            data-live-search="true" >
            <option value="percent">{{translate('Percent')}}</option>
            <option value="amount">{{translate('Amount')}}</option>
        </select>
    </div>
</div>

<div class="form-group row mt-5">
   <label class="col-lg-3 col-from-label">{{translate('Maximum Discount Amount')}}</label>
   <div class="col-lg-9">
      <input type="number" lang="en" min="0" step="0.01" placeholder="{{translate('Maximum Discount Amount')}}" name="max_discount" class="form-control" required>
   </div>
</div>

<div class="form-group row mt-5">
    <label for="required kt_ecommerce_add_product_store_template"
        class="col-lg-3 form-label">{{ translate('Date') }}</label>
    <div class="col-lg-9">
        <input type="text" class="form-control aiz-date-range mb-2"
        name="date_range" placeholder="{{ translate('Select Date') }}"
        data-time-picker="true" data-format="DD-MM-Y HH:mm:ss"
        data-separator=" to " autocomplete="off">
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        $(".js-data-example-ajax").select2();
        $('.aiz-date-range').daterangepicker();
        AIZ.plugins.bootstrapSelect('refresh');
    });
</script>
