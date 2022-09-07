@extends('backend.layouts.app')

@section('content')

{{-- <div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{translate('All Warehouses')}}</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('warehouse.create') }}" class="btn btn-circle btn-info">
                <span>{{translate('Add Warehouse')}}</span>
            </a>
        </div>
    </div>
</div> --}}
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
                    <li class="breadcrumb-item text-dark">Warehouse</li>
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
                <form class="" id="sort_warehouse" action="" method="GET">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <h2>{{ translate('All Warehouse') }}</h2>
                            </div>
                        </div>
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ translate('Bulk Action') }}
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-91px, 42px, 0px);" x-placement="bottom-end">
                                    <a class="dropdown-item" href="#" onclick="bulk_delete()">Delete selection</a>
                                </div>
                            </div>
                        </div>
                        <!--end::Card toolbar-->
                        <!--end::Input group-->
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">

                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                        transform="rotate(45 17.0365 15.1223)" fill="black" />
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" class="form-control form-control-solid w-250px ps-14" id="search"
                                name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset
                                placeholder="{{ translate('Type & Enter') }}" />

                                <a href="{{ route('warehouse.create') }}" class="btn btn-circle btn-primary ms-2">
                                    <span>{{translate('Add Warehouse')}}</span>
                                </a>
                        </div>
                        <!--end::Search-->

                        <!--end::Card title-->
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                <thead>
                                <tr>
                                    <!--<th data-breakpoints="lg">#</th>-->
                                    <th>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input check-all" type="checkbox" />
                                        </div>
                                    </th>
                                    <th>{{translate('Code')}}</th>
                                    <th>{{translate('Name')}}</th>
                                    <th data-breakpoints="lg">{{translate('Phone')}}</th>
                                    <th data-breakpoints="lg">{{translate('Active')}}</th>
                                    <th width="10%">{{translate('Options')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($warehouses as $key => $warehouse)
                                    <tr>
                                        <!--<td>{{ ($key+1) + ($warehouses->currentPage() - 1)*$warehouses->perPage() }}</td>-->
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input check-one" type="checkbox"
                                                    name="id[]" value="{{ $warehouse->id }}" />
                                            </div>
                                        </td>

                                        <td> {{$warehouse->code}}</td>
                                        <td> {{$warehouse->name}}</td>
                                        <td> {{$warehouse->phone}}</td>
                                        <td>
                                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                                    <input class="form-check-input" onchange="update_status(this)" value="{{ $warehouse->id }}" type="checkbox" <?php if($warehouse->status == 1) echo "checked";?> >
                                                </span>
                                            </label>
                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                href="{{route('warehouse.edit', ['id'=>$warehouse->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}"
                                                title="{{ translate('Edit') }}">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#"
                                                class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                data-href="{{route('warehouse.destroy', $warehouse->id)}}"
                                                title="{{ translate('Delete') }}">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="aiz-pagination">
                            {{ $warehouses->appends(request()->input())->links() }}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

 </div>
@endsection

@section('modal')
	<!-- Delete Modal -->
	@include('modals.delete_modal')
	<div id="edit-modal" class="modal fade">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">Bulk Edit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>

                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="card">
                            <div class="card-body p-0">

                                <form name="bulk_edit_form" class="p-4" action="{{route('bulk-warehouse-edit')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="ids" id="ids" />
                                        <br>
                                        <div class="form-group row" id="category">

                                            <label class="col-md-1 col-from-label mt-2 ml-3">{{translate('Shipping Rule')}}</label>
                                            <div class="col-lg-4">
                                                <select class="select2 form-control aiz-selectpicker" name="shipping_rule" id="shiping_restriction" data-toggle="select2" data-selected=""  data-live-search="true">
                                                    <option selected disabled value="">{{ translate('Nothing Selected') }}</option>
                                                    <option value="all">Shipping Available for all countries</option>
                                                    <option value="specific">Shipping Available for selected countries</option>
                                                    <option value="excluded">Shipping not Available for selected countries</option>

                                                </select>
                                            </div>

                                            <label class="col-md-1 col-from-label mt-3 ml-3">{{translate('Countries')}}</label>
                                            <div class="col-md-4">
                                                <select class="select2 form-control aiz-selectpicker" name="country_id[]" id="country_id" data-selected-text-format="name" multiple data-toggle="select2"  data-selected="" data-live-search="true" disabled="disabled">
                                                    @foreach (\App\Models\Country::all() as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group mb-0 mr-2 text-right">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                        <br>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div><!-- /.modal -->
@endsection

@section('script')
    <script type="text/javascript">
        function bulk_edit() {
            var atLeastOneIsChecked = $('input[name="id[]"]:checked').length > 0;
            if(atLeastOneIsChecked==false){
            return false;
            }
            var r = confirm("Are you sure!");
            if (r == true) {
            var searchIDs = [];
                $(".check-one:checkbox:checked").map(function(){
                searchIDs.push($(this).val());
                });
                $("#ids").val(searchIDs);
                // console.log(searchIDs);
                $("#edit-modal").modal("show");
            }
        }

        function bulk_delete() {
            var data = new FormData($('#sort_warehouse')[0]);
			var r = confirm("Are you sure!");
  			if (r == true) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('bulk-warehouse-delete')}}",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response == 1) {
                        location.reload();
                    }
                }
            });
			}
        }

        $('#shiping_restriction').on('change', function() {
        if($('#shiping_restriction').val()=='all'){
				$('#country_id').prop('disabled', true);
			}else{
				$('#country_id').prop('disabled', false);
			}
				AIZ.plugins.bootstrapSelect('refresh');
		});

        function update_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('warehouse.status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Warehouse status updated successfully') }}');
                }else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        $(document).on("change", ".check-all", function() {
            if(this.checked) {
                // Iterate each checkbox
                $('.check-one:checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check-one:checkbox').each(function() {
                    this.checked = false;
                });
            }

        });

    </script>
@endsection
