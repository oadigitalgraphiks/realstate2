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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Product Wise</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route("admin.dashboard") }}" class="text-muted text-hover-primary">Home</a>
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
                    <li class="breadcrumb-item text-muted">Reports</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Stock Report</li>
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
            <!--begin::Products-->
            <form class="" action="{{ route('stock_report.index') }}" method="GET">
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <h2>{{ translate('Product wise stock report') }}</h2>
                            </div>
                        </div>
                        <!--begin::Input group-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <form id="sort_uploads" action="">
                            <div class="d-flex justify-content-end" data-kt-filemanager-table-toolbar="base">
                                <!--begin::Input group-->
                                    <div class="me-5">
                                        <select class="form-select form-select-solid" data-kt-select2="true"
                                            data-placeholder="Select option" name="category_id">
                                            @foreach (\App\Models\Category::all() as $key => $category)
                                                <option value="{{ $category->id }}" @isset($sort_by) {{$category->id == $sort_by ? 'selected' : ''}} @endisset>{{ $category->getTranslation('name') }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                <!--end::Input-->
                                <!--begin::Add customer-->
                                <button  class="btn btn-primary" type="submit">
                                <!--end::Svg Icon-->{{translate('Filter')}}</button>
                                <!--end::Add customer-->
                            </div>
                            </form>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Input-->
                        <!--end::Input group-->

                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->

                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-200px">{{ translate('Product Name') }}</th>
                                        <th class="min-w-200px">{{ translate('Stock') }}</th>
                                        <th class="min-w-200px">{{ translate('Upcoming Stock') }}</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                    <!--begin::Table row-->
                                    @foreach ($products as $p_key => $product)
                                        @php
                                            $qty = 0;
                                            foreach ($product->stocks as $key => $stock) {
                                                $qty += $stock->qty;
                                            }
                                        @endphp
                                        @foreach ($product->stocks as $stock_key => $stock)
                                            <tr>
                                                <!--begin::Checkbox-->
                                                <td>
                                                    {{ $product->getTranslation('name') }}
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                {{ $stock->variant }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <!--end::Checkbox-->
                                                <!--begin::Product=-->
                                                <td>{{ $stock->qty }}</td>
                                                <!--end::Action=-->
                                                @php
                                                    try {
                                                        $product_id = $product->inventory->where('product_id',$product->id)->where("variant",$stock->variant)->first()->product_id;
                                                        $variant = $product->inventory->where('product_id',$product->id)->where("variant",$stock->variant)->first()->variant;
                                                        $receive_qty = $product->inventory->where('product_id',$product->id)->where("variant",$stock->variant)->first()->receive_qty;
                                                        $reject_qty = $product->inventory->where('product_id',$product->id)->where("variant",$stock->variant)->first()->return_qty;
                                                        $total_quantity = $product->inventory->where('product_id',$product->id)->where("variant",$stock->variant)->first()->total_quantity;
                                                    } catch (\Throwable $th) {
                                                        $receive_qty = 0;
                                                        $reject_qty = 0;
                                                        $total_quantity = 0;
                                                        $product_id = 0;
                                                        $variant = null;
                                                    }
                                                @endphp

                                                <td> {{  ($total_quantity - $receive_qty) - $reject_qty }}</td>
                                                @if ($product_id != 0)
                                                    <td class="col-2"> <button type="button" class="btn btn-sm btn-success" onclick="history({{$product_id}},'{{$variant}}')"> View Histroy</button> </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    <!--end::Table row-->
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <div class="aiz-pagination">
                            {{ $products->appends(request()->input())->links() }}
                        </div>
                        <!--end::Card body-->
                    </div>
                </div>
            </form>
            <!--end::Products-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>

@endsection


@section('modal')
<div class="modal fade" id="history-inventory" tabindex="-1" aria-labelledby="history-inventory" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ translate('History') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="transfer_product" method="POST">
                @csrf
                <div class="modal-body" id="history_inventory">

                </div>
                <div class="modal-footer">
                    {{-- <button type="submit" class="btn btn-primary" id="add_transfer" data-bs-dismiss="modal">{{ translate('Add') }}</button> --}}
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ translate('Cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('script')
    <script>
        function history(id,variant) {
            $('#history_inventory').html(null);
            $("#history-inventory").modal('show');
            $.ajax({
                type:'GET',
                data: {id: id,variant:variant},
                enctype: 'multipart/form-data',
                url:"{{ route('inventory.history') }}",

                success:function(data){
                    $('#history_inventory').html(data);
                }
            });
        }
    </script>
@endsection
