@extends('backend.layouts.app')

@section('content')
    <!--begin::Content-->
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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Coupons</h1>
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
                        <li class="breadcrumb-item text-muted">Marketing</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">Coupon Edit</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10"
                    action="{{ route('coupon.update', $coupon->id) }}" method="POST" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PATCH">
                    @csrf

                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{ translate('Coupon Information Adding') }}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <input type="hidden" name="id" value="{{ $coupon->id }}" id="id">
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <div class="mb-5 fv-row">
                                    <div class="fv-row mb-2">
                                        <label for="required kt_ecommerce_add_product_store_template"
                                            class="form-label">{{ translate('Coupon Type') }}</label>
                                        <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                            data-placeholder="Select One" id="coupon_type" name="coupon_type"
                                            data-live-search="true" onchange="coupon_form()" required>
                                            <option value="">{{ translate('Select One') }}</option>
                                            @if ($coupon->type == 'product_base')
                                                <option value="product_base" selected>{{ translate('For Products') }}
                                                </option>
                                            @elseif ($coupon->type == 'cart_base')
                                                <option value="cart_base" selected>{{ translate('For Total Orders') }}
                                                </option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-5 fv-row" id="coupon_form">

                                </div>

                            </div>

                            <div class="d-flex justify-content-end">

                                <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                    <span class="indicator-label">{{ translate('Save Changes') }}</span>
                                    <span class="indicator-progress">{{ translate('Please wait') }}...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                        <!--end::Main column-->
                    </div>
                </form>
                <!--end::Container-->
            </div>
        </div>
        <!--end::Post-->
    </div>

@endsection
@section('script')

    <script type="text/javascript">
        function coupon_form() {
            var coupon_type = $('#coupon_type').val();
            var id = $('#id').val();
            $.post('{{ route('coupon.get_coupon_form_edit') }}', {
                _token: '{{ csrf_token() }}',
                coupon_type: coupon_type,
                id: id
            }, function(data) {
                $('#coupon_form').html(data);

                //    $('#demo-dp-range .input-daterange').datepicker({
                //        startDate: '-0d',
                //        todayBtn: "linked",
                //        autoclose: true,
                //        todayHighlight: true
                // });
            });
        }

        $(document).ready(function() {
            coupon_form();
        });
    </script>

@endsection
