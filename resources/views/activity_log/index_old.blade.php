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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Sliders</h1>
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
                    <li class="breadcrumb-item text-muted">Website Setup</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">All Sliders / Create Slider</li>
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
                                <h5 class="mb-md-0 h6">{{ translate('Sliders') }}</h5>
                            </div>
                            <div class="col-md-4">
                                <form class="" id="sort_sliders" action="" method="GET">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="search" name="search"
                                            @isset($sort_search) value="{{ $sort_search }}" @endisset
                                            placeholder="{{ translate('Type name & Enter') }}">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ translate('Title1') }}</th>
                                            <th>{{ translate('Date') }}</th>
                                            <th>{{ translate('Log Type') }}</th>
                                            <th>{{ translate('Done By') }}</th>
                                            <th class="text-right">{{ translate('Options') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logs as $key => $log)
                                            <tr>
                                                <td>{{ $log->id }}</td>
                                                <td>{{ $log->log_date }} - {{$log->dateHumanize}}</td>
                                                <td>{{$log->log_type}}</td>
                                                <td>to {{$log->table_name}}</td>
                                                <td>{{ $log->user->name }} <br> {{ $log->user->email }}</td>
                                                <td class="text-right">
                                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm log-preview" href="javascript:void(0)" title="{{ translate('Show') }}" onclick="activitylog('{{ $log->id }}');">
                                                        <i class="las la-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="aiz-pagination">
                                {{ $logs->appends(request()->input())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')
    <!-- delete Modal -->
<div class="modal fade" id="log-preview" tabindex="-1" aria-labelledby="log-preview" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title h6">{{translate('Log Preview')}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="activity_log">

            </div>
        </div>
    </div>

</div>
<!-- /.modal -->

@endsection

@section('script')
<script>
        function activitylog(id){
            $('#activity_log').html(null)
            $('#log-preview').modal("show");
            $.post('{{ route('activity.show') }}', {_token: AIZ.data.csrf, id:id}, function(data){
                $('#activity_log').html(data)
                console.log(data);
            });
        }
</script>
@endsection
