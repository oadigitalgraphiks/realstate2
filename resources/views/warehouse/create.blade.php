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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Warehouse</h1>
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
                    <li class="breadcrumb-item text-muted">Setup & Configuration</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Warehouse Create</li>
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
            <div class="col-lg-12 mx-auto">
                <form action="{{ route('warehouse.store') }}" method="POST">
                @csrf
                <div class="card card-flush">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <h5 class="mb-0 h6">{{translate('Warehouse Information')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label mt-3" for="code">{{translate('Code')}} <span class="text-danger">*</span></label>
                            <div class="col-sm-10 mb-2">
                                <input type="text" placeholder="{{translate('Code')}}" id="code" name="code" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label mt-3" for="name">{{translate('Name')}} <span class="text-danger">*</span></label>
                            <div class="col-sm-10 mb-2">
                                <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label mt-3" for="logo">{{translate('Logo')}}
                                {{-- <small>({{ translate('120x80') }})</small> --}}
                            </label>
                            <div class="col-sm-10 mb-2">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="logo" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label mt-3" for="address">{{translate('Address')}} <span class="text-danger">*</span></label>
                            <div class="col-sm-10 mb-2">
                                <input type="text" placeholder="{{translate('address')}}" id="address" name="address" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-from-label mt-3" for="country">{{translate('Country')}} <span class="text-danger">*</span></label>
                            <div class="col-sm-10 mb-2">
                                <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                    data-placeholder="Select an option" id="country" name="country"
                                    data-live-search="true">
                                {{-- <select class="form-control mb-3 aiz-selectpicker" data-live-search="true" name="country" required> --}}
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $key => $country)
                                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-from-label mt-3" for="country">{{translate('City')}} <span class="text-danger">*</span></label>
                            <div class="col-sm-10 mb-2">
                                <select class="form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Select an option" name="city" data-live-search="true">

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label mt-3" for="area">{{translate('Area')}} <span class="text-danger">*</span></label>
                            <div class="col-sm-10 mb-2">
                                <input type="text" placeholder="{{translate('Area')}}" id="area" name="area" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label mt-3" for="postal_code">{{translate('Postal Code')}} <span class="text-danger">*</span></label>
                            <div class="col-sm-10 mb-2">
                                <input type="text" placeholder="{{translate('Postal Code')}}" id="postal_code" name="postal_code" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label mt-3" for="phone">{{translate('Phone')}} <span class="text-danger">*</span></label>
                            <div class="col-sm-10 mb-2">
                                <input type="text" placeholder="{{translate('Phone')}}" id="phone" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label mt-3">{{translate('Email')}} <span class="text-danger">*</span></label>
                            <div class="col-sm-10 mb-2">
                                <input type="email" class="form-control" name="email" placeholder="{{ translate('Email') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                                <label class="col-md-2 col-from-label mt-3">{{translate('Choose Staff')}}</label>
                            <div class="col-sm-10 mb-2">
                                <select class="form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Select an option" name="staff_ids[]" data-live-search="true" required multiple>
                                {{-- <select class="form-control aiz-selectpicker" name="staff_ids[]" data-selected-text-format="count" data-live-search="true" multiple data-placeholder="{{ translate('Choose Staff') }}" required> --}}
                                    @foreach (App\Models\Staff::all() as $key => $staff)
                                        @if ($staff->user != null && $staff->user->name != null && $staff->user->id != 9)
                                            <option value="{{ $staff->user->id }}">{{ $staff->user->name }}<small>({{ $staff->user->staff->role->name }})</small></option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-from-label mt-3">{{translate('Shipping Rule')}}</label>
                            <div class="col-sm-10 mb-2">
                            <select class="form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Select an option" name="shipping_rule" id="shipping_restriction" data-live-search="true" required multiple>
                                <option value="all">Shipping Available for all countries</option>
                                <option value="specific">Shipping Available for selected countries</option>
                                <option value="excluded">Shipping not Available for selected countries</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-from-label mt-3">{{translate('Select Countries')}}</label>
                            <div class="col-sm-10 mb-2">
                            <select class="form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Select an option" name="country_id[]" id="country_id" data-live-search="true" required multiple>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-from-label mt-3">{{translate('Meta Title')}}</label>
                            <div class="col-sm-10 mb-2">
                                <input type="text" class="form-control" name="meta_title" placeholder="{{translate('Meta Title')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-from-label mt-3">{{translate('Meta Description')}}</label>
                            <div class="col-sm-10 mb-2">
                                <textarea name="meta_description" rows="5" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                        </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function (){
        if($('#shipping_restriction').val()=='all'){
			$('#country_id').prop('disabled', true);
		}else{
			$('#country_id').prop('disabled', false);
		}
        AIZ.plugins.bootstrapSelect('refresh');
    });

    $('#shipping_restriction').on('change', function() {
        if($('#shipping_restriction').val()=='all'){
			$('#country_id').prop('disabled', true);
		}else{
			$('#country_id').prop('disabled', false);
		}
            AIZ.plugins.bootstrapSelect('refresh');
    });

    $(document).on('change', '[name=country]', function() {
        var country = $(this).val();
        get_city(country);
    });

    function get_city(country) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get-city')}}",
            type: 'POST',
            data: {
                country_name: country
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != '') {
                    $('[name="city"]').html(obj);
                    AIZ.plugins.bootstrapSelect('refresh');
                }
            }
        });
    }

    $(document).on('change', '[name=shop_country]', function() {
        var country = $(this).val();
        get_shop_city(country);
    });

    function get_shop_city(country) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get-city')}}",
            type: 'POST',
            data: {
                country_name: country
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != '') {
                    $('[name="shop_city"]').html(obj);
                    AIZ.plugins.bootstrapSelect('refresh');
                }
            }
        });
    }
</script>
@endsection
