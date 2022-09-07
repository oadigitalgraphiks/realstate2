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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">File System Configuration</h1>
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
                    <li class="breadcrumb-item text-dark">File System Configuration</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">

            <div class="row g-5 g-xl-8">
                <div class="col-xxl-6">
                    <div class="card card-flush">
                        <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="fs-18 mb-0 text-center">{{translate('S3 File System Credentials')}}</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                                <input type="hidden" name="payment_method" value="paypal">
                                @csrf
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="AWS_ACCESS_KEY_ID">
                                    <div class="col-lg-4">
                                        <label class="control-label">{{translate('AWS_ACCESS_KEY_ID')}}</label>
                                    </div>
                                    <div class="col-lg-8 mb-5">
                                        <input type="text" class="form-control" name="AWS_ACCESS_KEY_ID" value="{{  env('AWS_ACCESS_KEY_ID') }}" placeholder="{{ translate('AWS_ACCESS_KEY_ID') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="AWS_SECRET_ACCESS_KEY">
                                    <div class="col-lg-4">
                                        <label class="control-label">{{translate('AWS_SECRET_ACCESS_KEY')}}</label>
                                    </div>
                                    <div class="col-lg-8 mb-5">
                                        <input type="text" class="form-control" name="AWS_SECRET_ACCESS_KEY" value="{{  env('AWS_SECRET_ACCESS_KEY') }}" placeholder="{{ translate('AWS_SECRET_ACCESS_KEY') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="AWS_DEFAULT_REGION">
                                    <div class="col-lg-4">
                                        <label class="control-label">{{translate('AWS_DEFAULT_REGION')}}</label>
                                    </div>
                                    <div class="col-lg-8 mb-5">
                                        <input type="text" class="form-control" name="AWS_DEFAULT_REGION" value="{{  env('AWS_DEFAULT_REGION') }}" placeholder="{{ translate('AWS_DEFAULT_REGION') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="AWS_BUCKET">
                                    <div class="col-lg-4">
                                        <label class="control-label">{{translate('AWS_BUCKET')}}</label>
                                    </div>
                                    <div class="col-lg-8 mb-5">
                                        <input type="text" class="form-control" name="AWS_BUCKET" value="{{  env('AWS_BUCKET') }}" placeholder="{{ translate('AWS_BUCKET') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="AWS_URL">
                                    <div class="col-lg-4">
                                        <label class="control-label">{{translate('AWS_URL')}}</label>
                                    </div>
                                    <div class="col-lg-8 mb-5">
                                        <input type="text" class="form-control" name="AWS_URL" value="{{  env('AWS_URL') }}" placeholder="{{ translate('AWS_URL') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 text-right">
                                        <button class="btn btn-primary" type="submit">{{translate('Save')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6">
                    <div class="card card-flush">
                        <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="fs-18 mb-0 text-center">{{translate('S3 File System Activation')}}</h3>
                        </div>
                        <div class="card-body">
                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block text-center">
                                <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                    <input class="form-check-input" onchange="updateSettings(this, 'FILESYSTEM_DRIVER')" <?php if(env('FILESYSTEM_DRIVER') == 's3') echo "checked";?> >
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-5 g-xl-8 mt-5">
                <div class="col-xxl-6">
                    <div class="card card-flush">
                        <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="fs-18 mb-0 text-center">{{translate('Cache & Session Driver')}}</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                                <input type="hidden" name="payment_method" value="paypal">
                                @csrf
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="CACHE_DRIVER">
                                    <div class="col-lg-4">
                                        <label class="control-label">{{translate('CACHE_DRIVER')}}</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                        data-placeholder="Select an option" name="CACHE_DRIVER" data-live-search="true">
                                            <option value="file" @if (env('CACHE_DRIVER') == "file") selected @endif>{{ translate('file') }}</option>
                                            <option value="redis" @if (env('CACHE_DRIVER') == "redis") selected @endif>{{ translate('redis') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="SESSION_DRIVER">
                                    <div class="col-lg-4">
                                        <label class="control-label">{{translate('SESSION_DRIVER')}}</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                        data-placeholder="Select an option" name="SESSION_DRIVER" data-live-search="true">
                                            <option value="file" @if (env('SESSION_DRIVER') == "file") selected @endif>{{ translate('file') }}</option>
                                            <option value="redis" @if (env('SESSION_DRIVER') == "redis") selected @endif>{{ translate('redis') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 text-right">
                                        <button class="btn btn-primary" type="submit">{{translate('Save')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6">
                    <div class="card card-flush">
                        <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                            <h3 class="fs-18 mb-0 text-center">{{translate('Redis Configuration (If you use redis as any of the drivers)')}}</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                                <input type="hidden" name="payment_method" value="paypal">
                                @csrf
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="REDIS_HOST">
                                    <div class="col-lg-4">
                                        <label class="control-label">{{translate('REDIS_HOST')}}</label>
                                    </div>
                                    <div class="col-lg-8 mb-5">
                                        <input type="text" class="form-control" name="REDIS_HOST" value="{{  env('REDIS_HOST') }}" placeholder="{{ translate('REDIS_HOST') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="REDIS_PASSWORD">
                                    <div class="col-lg-4">
                                        <label class="control-label">{{translate('REDIS_PASSWORD')}}</label>
                                    </div>
                                    <div class="col-lg-8 mb-5">
                                        <input type="text" class="form-control" name="REDIS_PASSWORD" value="{{  env('REDIS_PASSWORD') }}" placeholder="{{ translate('REDIS_PASSWORD') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="types[]" value="REDIS_PORT">
                                    <div class="col-lg-4">
                                        <label class="control-label">{{translate('REDIS_PORT')}}</label>
                                    </div>
                                    <div class="col-lg-8 mb-5">
                                        <input type="text" class="form-control" name="REDIS_PORT" value="{{  env('REDIS_PORT') }}" placeholder="{{ translate('REDIS_PORT') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 text-right">
                                        <button class="btn btn-primary" type="submit">{{translate('Save')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function updateSettings(el, type){
            if($(el).is(':checked')){
                var value = 1;
            }
            else{
                var value = 0;
            }
            $.post('{{ route('business_settings.update.activation') }}', {_token:'{{ csrf_token() }}', type:type, value:value}, function(data){
                if(data == '1'){
                    AIZ.plugins.notify('success', '{{ translate('Settings updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>
@endsection
