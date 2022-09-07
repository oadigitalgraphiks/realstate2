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
                    <li class="breadcrumb-item text-dark">Inventories</li>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <div class="col text-md-left">
                                <h5 class="mb-md-0 h6">{{ translate('Inventories') }}</h5>
                            </div>
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

                                    <a href="{{route('inventory.create')}}" class="btn btn-circle btn-primary ms-2">
                                        <span>{{translate('Add Inventory')}}</span>
                                    </a>
                            </div>
                            <!--end::Search-->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ translate('Product') }}</th>
                                            <th>{{ translate('Seller') }}</th>
                                            <th>{{ translate('Warehouse') }}</th>
                                            <th>{{ translate('Received') }}</th>
                                            <th class="text-right">{{ translate('Options') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inventories as $key => $inventory)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$inventory->seller->user->name}} - {{$inventory->warehouse->name}}</td>
                                                <td>
                                                   {{$inventory->seller->user->name}}
                                                </td>
                                                <td>
                                                    {{$inventory->warehouse->name}}
                                                </td>
                                                <td>
                                                    {{ $inventory->where("tracking_number",$inventory->tracking_number)->sum("return_qty") + $inventory->where("tracking_number",$inventory->tracking_number)->sum("receive_qty")  }} / {{$inventory->where("tracking_number",$inventory->tracking_number)->sum("total_quantity")}}
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{ ($inventory->where("tracking_number",$inventory->tracking_number)->sum("receive_qty")  / $inventory->where("tracking_number",$inventory->tracking_number)->sum("total_quantity")) * 100 }}%" aria-valuenow="{{$inventory->where("tracking_number",$inventory->tracking_number)->sum("receive_qty") }}" aria-valuemin="0" aria-valuemax="{{$inventory->where("tracking_number",$inventory->tracking_number)->sum("total_quantity")}}"></div>
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" id="progress_return_{{$inventory->id}}" role="progressbar" style="width: {{ ($inventory->where("tracking_number",$inventory->tracking_number)->sum("return_qty") / $inventory->where("tracking_number",$inventory->tracking_number)->sum("total_quantity")) * 100 }}%" aria-valuenow="{{$inventory->where("tracking_number",$inventory->tracking_number)->sum("return_qty")}}" aria-valuemin="0" aria-valuemax="{{$inventory->where("tracking_number",$inventory->tracking_number)->sum("total_quantity")}}">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-right">
                                                    <a href="{{ route('inventory.edit', ['id' => $inventory->tracking_number]) }}" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="{{ translate('Receive') }}">
                                                        <i class="las la-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="aiz-pagination">
                                {{-- {{ $sliders->appends(request()->input())->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('modal')
<div class="modal fade" id="edit-inventory" tabindex="-1" aria-labelledby="edit-inventory" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ translate('Inventory Edit') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="inventory_edit">

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">{{ translate('Save') }}</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ translate('Cancel') }}</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

    <script>
        function edit(id) {
            $('#inventory_edit').html(null);
            $("#edit-inventory").modal('show');
            $.ajax({
                type:'GET',
                enctype: 'multipart/form-data',
                url:"{{ route('inventory.edit',['id' => "+id+"]) }}",
                success:function(data){
                    $('#inventory_edit').html(data);
                    $(".js-data-example-ajax").select2();
                }
            });
        }

    </script>

@endsection
