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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Server Information</h1>
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
                    <li class="breadcrumb-item text-muted">System</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Server Information</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <div class="row">
        <div class="col-lg-10 col-xxl-8 mx-auto">
            <div class="card card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <h3 class="h6 mb-0">{{ translate('Server information') }}</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                            <thead>
                                <tr>
                                    <th>{{ translate('Name') }}</th>
                                    <th data-breakpoints="lg">{{ translate('Current Version') }}</th>
                                    <th data-breakpoints="lg">{{ translate('Required Version') }}</th>
                                    <th>{{ translate('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Php versions</td>
                                    <td>{{ phpversion() }}</td>
                                    <td>7.3 or 7.4</td>
                                    <td>
                                        @if (floatval(phpversion()) >= 7.3 && floatval(phpversion()) <= 7.4)
                                            <i class="las la-check text-success"></i>
                                        @else
                                            <i class="las la-times text-danger"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>MySQL</td>
                                    <td>
                                        @php
                                            $results = DB::select(DB::raw('select version()'));
                                            $mysql_version = $results[0]->{'version()'};
                                        @endphp
                                        {{ $mysql_version }}
                                    </td>
                                    <td>5.6+</td>
                                    <td>
                                        @if ($mysql_version >= 5.6)
                                            <i class="las la-check text-success"></i>
                                        @else
                                            <i class="las la-times text-danger"></i>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <h3 class="h6 mb-0">{{ translate('php.ini Config') }}</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                            <thead>
                                <tr>
                                    <th>{{ translate('Config Name') }}</th>
                                    <th data-breakpoints="lg">{{ translate('Current') }}</th>
                                    <th data-breakpoints="lg">{{ translate('Recommended') }}</th>
                                    <th>{{ translate('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>file_uploads</td>
                                    <td>
                                        @if (ini_get('file_uploads') == 1)
                                            On
                                        @else
                                            Off
                                        @endif
                                    </td>
                                    <td>On</td>
                                    <td>
                                        @if (ini_get('file_uploads') == 1)
                                            <i class="las la-check text-success"></i>
                                        @else
                                            <i class="las la-times text-danger"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>max_file_uploads</td>
                                    <td>
                                        {{ ini_get('max_file_uploads') }}
                                    </td>
                                    <td>20+</td>
                                    <td>
                                        @if (ini_get('max_file_uploads') >= 20)
                                            <i class="las la-check text-success"></i>
                                        @else
                                            <i class="las la-times text-danger"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>upload_max_filesize</td>
                                    <td>
                                        {{ ini_get('upload_max_filesize') }}
                                    </td>
                                    <td>128M+</td>
                                    <td>
                                        @if (str_replace(['M', 'G'], '', ini_get('upload_max_filesize')) >= 128)
                                            <i class="las la-check text-success"></i>
                                        @else
                                            <i class="las la-times text-danger"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>post_max_size</td>
                                    <td>
                                        {{ ini_get('post_max_size') }}
                                    </td>
                                    <td>128M+</td>
                                    <td>
                                        @if (str_replace(['M', 'G'], '', ini_get('post_max_size')) >= 128)
                                            <i class="las la-check text-success"></i>
                                        @else
                                            <i class="las la-times text-danger"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>allow_url_fopen</td>
                                    <td>
                                        @if (ini_get('allow_url_fopen') == 1)
                                            On
                                        @else
                                            Off
                                        @endif
                                    </td>
                                    <td>On</td>
                                    <td>
                                        @if (ini_get('allow_url_fopen') == 1)
                                            <i class="las la-check text-success"></i>
                                        @else
                                            <i class="las la-times text-danger"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>max_execution_time</td>
                                    <td>
                                        @if (ini_get('max_execution_time') == '-1')
                                            Unlimited
                                        @else
                                            {{ ini_get('max_execution_time') }}
                                        @endif
                                    </td>
                                    <td>600+</td>
                                    <td>
                                        @if (ini_get('max_execution_time') == -1 || ini_get('max_execution_time') >= 600)
                                            <i class="las la-check text-success"></i>
                                        @else
                                            <i class="las la-times text-danger"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>max_input_time</td>
                                    <td>
                                        @if (ini_get('max_input_time') == '-1')
                                            Unlimited
                                        @else
                                            {{ ini_get('max_input_time') }}
                                        @endif
                                    </td>
                                    <td>120+</td>
                                    <td>
                                        @if (ini_get('max_input_time') == -1 || ini_get('max_input_time') >= 120)
                                            <i class="las la-check text-success"></i>
                                        @else
                                            <i class="las la-times text-danger"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>max_input_vars</td>
                                    <td>
                                        {{ ini_get('max_input_vars') }}
                                    </td>
                                    <td>1000+</td>
                                    <td>
                                        @if (ini_get('max_input_vars') >= 1000)
                                            <i class="las la-check text-success"></i>
                                        @else
                                            <i class="las la-times text-danger"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>memory_limit</td>
                                    <td>
                                        @if (ini_get('memory_limit') == '-1')
                                            Unlimited
                                        @else
                                            {{ ini_get('memory_limit') }}
                                        @endif
                                    </td>
                                    <td>256M+</td>
                                    <td>
                                        @php
                                            $memory_limit = ini_get('memory_limit');
                                            if (preg_match('/^(\d+)(.)$/', $memory_limit, $matches)) {
                                                if ($matches[2] == 'G') {
                                                    $memory_limit = $matches[1] * 1024 * 1024 * 1024; // nnnM -> nnn GB
                                                } elseif ($matches[2] == 'M') {
                                                    $memory_limit = $matches[1] * 1024 * 1024; // nnnM -> nnn MB
                                                } elseif ($matches[2] == 'K') {
                                                    $memory_limit = $matches[1] * 1024; // nnnK -> nnn KB
                                                }
                                            }
                                        @endphp
                                        @if (ini_get('memory_limit') == -1 || $memory_limit >= 256 * 1024 * 1024)
                                            <i class="las la-check text-success"></i>
                                        @else
                                            <i class="las la-times text-danger"></i>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="h6 mb-0">{{ translate('Extensions information') }}</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ translate('Extension Name') }}</th>
                                <th>{{ translate('Status') }}</th>
                            </tr>
                        </thead>
                        @php
                            $loaded_extensions = get_loaded_extensions();
                            $required_extensions = ['bcmath', 'ctype', 'json', 'mbstring', 'zip', 'zlib', 'openssl', 'tokenizer', 'xml', 'dom', 'curl', 'fileinfo', 'gd', 'pdo_mysql'];
                        @endphp
                        <tbody>
                            @foreach ($required_extensions as $extension)
                                <tr>
                                    <td>{{ $extension }}</td>
                                    <td>
                                        @if (in_array($extension, $loaded_extensions))
                                            <i class="las la-check text-success"></i>
                                        @else
                                            <i class="las la-times text-danger"></i>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="h6 mb-0">{{ translate('Filesystem Permissions') }}</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ translate('File or Folder') }}</th>
                                <th>{{ translate('Status') }}</th>
                            </tr>
                        </thead>
                        @php
                            $required_paths = ['.env', 'public', 'app/Providers', 'app/Http/Controllers', 'storage', 'resources/views'];
                        @endphp
                        <tbody>
                            @foreach ($required_paths as $path)
                                <tr>
                                    <td>{{ $path }}</td>
                                    <td>
                                        @if (is_writable(base_path($path)))
                                            <i class="las la-check text-success"></i>
                                        @else
                                            <i class="las la-times text-danger"></i>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
