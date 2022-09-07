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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Admin Menus</h1>
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
                    <li class="breadcrumb-item text-muted">Sellers</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">All Admin Menus</li>
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
            <div class="card card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <h5 class="mb-0 h6">{{ translate('Admin Menus') }}</h5>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <form class="" id="sort_categories" action="" method="GET">
                            <div class="box-inline pad-rgt pull-left">
                                <div class="" style="min-width: 200px;">
                                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name & Enter') }}">
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('admin_menu.create') }}" class="btn btn-primary">
                            <span>{{translate('Add New Menu')}}</span>
                        </a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                            <thead>
                                <tr>
                                    <th data-breakpoints="lg">#</th>
                                    <th data-breakpoints="lg">{{ translate('Parent Menu') }}</th>
                                    <th>{{translate('Name')}}</th>
                                    <th>{{translate('Status')}}</th>
                                    <th width="10%" class="text-right">{{translate('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admin_menus as $key => $admin_menu)
                                    <tr>
                                        <td>{{ ($key+1) + ($admin_menus->currentPage() - 1)*$admin_menus->perPage() }}</td>

                                        <td>
                                            @php
                                                $parent = \App\Models\AdminMenu::where('id', $admin_menu->parent_id)->first();
                                            @endphp
                                            @if ($parent != null)
                                                {{ $parent->getTranslation('name') }}
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>{{ $admin_menu->getTranslation('name') }}</td>
                                        <td>
                                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                                    <input class="form-check-input" onchange="update_status(this)" value="{{ $admin_menu->id }}" type="checkbox" @if($admin_menu->status == 1) checked @endif >
                                                </span>
                                            </label>
                                        </td>

                                        <td class="text-right">
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('admin_menu.edit', ['id'=>$admin_menu->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" title="{{ translate('Edit') }}">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('admin_menu.destroy', $admin_menu->id)}}" title="{{ translate('Delete') }}">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="aiz-pagination">
                        {{ $admin_menus->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')
    <script type="text/javascript">
        function update_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('admin_menu.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Menu Status updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>
@endsection
