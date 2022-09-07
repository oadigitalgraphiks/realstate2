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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Role</h1>
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
                    <li class="breadcrumb-item text-muted">Staff</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Role Create</li>
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
            <div class="col-lg-12 mx-auto">
                <div class="card card-flush mt-5">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <h5 class="mb-0 h6">{{translate('Role Information')}}</h5>
                    </div>
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="form-group row container">
                            <label class="col-md-3 col-from-label" for="name">{{translate('Name')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
                            <div class="col-md-9">
                                <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row border mt-10">
                            @foreach(admin_menus() as $main_menu)
                                <div class="col-md-4" style="line-height:20px">
                                    <div class="card card-flush py-2">
                                        <div class="card-header border align-items-center py-5 gap-2 gap-md-5">
                                            <h5>{{$main_menu->name}}</h5>
                                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                                    <input class="form-check-input main-menu" type="checkbox" name="role_menus[]">
                                                </span>
                                            </label>
                                        </div>
                                        @if(count($main_menu->childrens) > 0)
                                            <div class="card-body border">
                                                @foreach($main_menu->childrens as $sub_menu)
                                                    <div class="card">
                                                        <div class="card-header mt-2 p-0">
                                                            <div class="col-md-4">
                                                                <h5>{{$sub_menu->name}}</h5>
                                                            </div>
                                                            <div class="col-md-8 text-center">
                                                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                                                        <input class="form-check-input sub-menu" type="checkbox" name="role_menus[]" >
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                @foreach(\App\Models\Permission::where('admin_menu_id',$sub_menu->id)->where('status',1)->get() as $permission)
                                                                    <div class="col-md-4">
                                                                        <h5>{{$permission->name}}</h5>
                                                                    </div>
                                                                    <div class="col-md-8 ml-3">
                                                                        <label class="form-check form-switch form-switch-sm form-check-solid mb-5 d-block">
                                                                            <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                                                                <input class="form-check-input inner-fields" type="checkbox" name="role_permissions[]" >
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        </div>
                    </from>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.sub-menu').on('change',function(){
                if($(this).is(':checked')){
                    $(this).parent().parent().parent().parent().parent().find('.inner-fields').prop('checked',true);
                    $(this).parent().parent().parent().parent().parent().parent().parent().find('.main-menu').prop('checked',true);
                    $(this).parent().parent().parent().parent().parent().find('.inner-fields').attr('disabled',false);
                }else{
                    $(this).parent().parent().parent().parent().parent().find('.inner-fields').prop('checked',false);
                    $(this).parent().parent().parent().parent().parent().find('.inner-fields').attr('disabled',true);
                }
            });
            $('.main-menu').on('change',function(){
                if($(this).is(':checked')){
                    $(this).parent().parent().parent().parent().parent().find('.sub-menu').attr('disabled',false);
                    $(this).parent().parent().parent().parent().parent().find('.inner-fields').attr('disabled',false);
                }else{
                    $(this).parent().parent().parent().parent().parent().find('.sub-menu').prop('checked',false);
                    $(this).parent().parent().parent().parent().parent().find('.inner-fields').prop('checked',false);
                    $(this).parent().parent().parent().parent().parent().find('.sub-menu').attr('disabled',true);
                    $(this).parent().parent().parent().parent().parent().find('.inner-fields').attr('disabled',true);
                }
            });
        });
    </script>
@endsection
