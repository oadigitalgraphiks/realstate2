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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">SMTP Configuration</h1>
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
                    <li class="breadcrumb-item text-dark">SMTP Configuration</li>
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
            <div class="row g-5 g-xl-8">
                <div class="col-xl-6">
                    <div class="card card-flush">
                        <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                            <h5 class="mb-0 h6">{{ translate('SMTP Settings') }}</h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('business_settings.update') }}" method="POST">
                                @csrf
                                <div class="row mb-5">
                                    <label class="col-md-3 col-form-label">{{ translate('Email Logo') }}</label>
                                    <div class="col-md-9 mb-5">
                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                            <input type="hidden" name="types[]" value="email_logo">
                                            <input type="hidden" name="email_logo" class="selected-files" value="{{ get_setting('email_logo') }}">
                                        </div>
                                        <div class="file-preview box sm">
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 text-right" style="text-align: end">
                                        <button type="submit"
                                            class="btn btn-primary">{{ translate('Update Email Logo') }}</button>
                                    </div>
                                </div>
                            </form>
                            <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                                @csrf
                                <div class="row mb-5">
                                    <input type="hidden" name="types[]" value="MAIL_DRIVER">
                                    <label class="col-md-3 col-form-label">{{ translate('Type') }}</label>
                                    <div class="col-md-9">
                                        <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                            data-placeholder="Select an option" name="MAIL_DRIVER" data-live-search="true">
                                            <option value="sendmail" @if (env('MAIL_DRIVER') == 'sendmail') selected @endif>{{ translate('Sendmail') }}
                                            </option>
                                            <option value="smtp" @if (env('MAIL_DRIVER') == 'smtp') selected @endif>{{ translate('SMTP') }}</option>
                                            <option value="mailgun" @if (env('MAIL_DRIVER') == 'mailgun') selected @endif>{{ translate('Mailgun') }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div id="smtp">
                                    <div class="row mb-5">
                                        <input type="hidden" name="types[]" value="MAIL_HOST">
                                        <div class="col-md-3">
                                            <label class="col-from-label">{{ translate('MAIL HOST') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="MAIL_HOST"
                                                value="{{ env('MAIL_HOST') }}"
                                                placeholder="{{ translate('MAIL HOST') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <input type="hidden" name="types[]" value="MAIL_PORT">
                                        <div class="col-md-3">
                                            <label class="col-from-label">{{ translate('MAIL PORT') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="MAIL_PORT"
                                                value="{{ env('MAIL_PORT') }}"
                                                placeholder="{{ translate('MAIL PORT') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <input type="hidden" name="types[]" value="MAIL_USERNAME">
                                        <div class="col-md-3">
                                            <label class="col-from-label">{{ translate('MAIL USERNAME') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="MAIL_USERNAME"
                                                value="{{ env('MAIL_USERNAME') }}"
                                                placeholder="{{ translate('MAIL USERNAME') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                                        <div class="col-md-3">
                                            <label class="col-from-label">{{ translate('MAIL PASSWORD') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="MAIL_PASSWORD"
                                                value="{{ env('MAIL_PASSWORD') }}"
                                                placeholder="{{ translate('MAIL PASSWORD') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                                        <div class="col-md-3">
                                            <label class="col-from-label">{{ translate('MAIL ENCRYPTION') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="MAIL_ENCRYPTION"
                                                value="{{ env('MAIL_ENCRYPTION') }}"
                                                placeholder="{{ translate('MAIL ENCRYPTION') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                                        <div class="col-md-3">
                                            <label class="col-from-label">{{ translate('MAIL FROM ADDRESS') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="email" class="form-control" name="MAIL_FROM_ADDRESS"
                                                value="{{ env('MAIL_FROM_ADDRESS') }}"
                                                placeholder="{{ translate('MAIL FROM ADDRESS') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <input type="hidden" name="types[]" value="MAIL_FROM_NAME">
                                        <div class="col-md-3">
                                            <label class="col-from-label">{{ translate('MAIL FROM NAME') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="MAIL_FROM_NAME"
                                                value="{{ env('MAIL_FROM_NAME') }}"
                                                placeholder="{{ translate('MAIL FROM NAME') }}">
                                        </div>
                                    </div>
                                </div>
                                <div id="mailgun">
                                    <div class="row mb-5">
                                        <input type="hidden" name="types[]" value="MAILGUN_DOMAIN">
                                        <div class="col-md-3">
                                            <label class="col-from-label">{{ translate('MAILGUN DOMAIN') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="MAILGUN_DOMAIN"
                                                value="{{ env('MAILGUN_DOMAIN') }}"
                                                placeholder="{{ translate('MAILGUN DOMAIN') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <input type="hidden" name="types[]" value="MAILGUN_SECRET">
                                        <div class="col-md-3">
                                            <label class="col-from-label">{{ translate('MAILGUN SECRET') }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="MAILGUN_SECRET"
                                                value="{{ env('MAILGUN_SECRET') }}"
                                                placeholder="{{ translate('MAILGUN SECRET') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0 text-right">
                                    <button type="submit"
                                        class="btn btn-primary">{{ translate('Save Configuration') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-flush">
                        <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                            <h5 class="mb-0 h6">{{ translate('Test SMTP configuration') }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('test.smtp') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <input type="email" class="form-control" name="email"
                                            value="{{ auth()->user()->email }}"
                                            placeholder="{{ translate('Enter your email address') }}">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit"
                                            class="btn btn-primary">{{ translate('Send test email') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ translate('Instruction') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="notice bg-light-primary rounded border-primary border border-dashed p-6">
                                <p class="text-danger">
                                    {{ translate('Please be carefull when you are configuring SMTP. For incorrect configuration you will get error at the time of order place, new registration, sending newsletter.') }}
                                </p>
                                <h6 class="text-muted">{{ translate('For Non-SSL') }}</h6>
                                <ul class="list-group border border-dashed">
                                    <li class="list-group-item text-dark">
                                        {{ translate('Select sendmail for Mail Driver if you face any issue after configuring smtp as Mail Driver ') }}
                                    </li>
                                    <li class="list-group-item text-dark">
                                        {{ translate('Set Mail Host according to your server Mail Client Manual Settings') }}
                                    </li>
                                    <li class="list-group-item text-dark">{{ translate('Set Mail port as 587') }}</li>
                                    <li class="list-group-item text-dark">
                                        {{ translate('Set Mail Encryption as ssl if you face issue with tls') }}</li>
                                </ul>
                                <br>
                                <h6 class="text-muted">{{ translate('For SSL') }}</h6>
                                <ul class="list-group mar-no">
                                    <li class="list-group-item text-dark">
                                        {{ translate('Select sendmail for Mail Driver if you face any issue after configuring smtp as Mail Driver') }}
                                    </li>
                                    <li class="list-group-item text-dark">
                                        {{ translate('Set Mail Host according to your server Mail Client Manual Settings') }}
                                    </li>
                                    <li class="list-group-item text-dark">{{ translate('Set Mail port as 465') }}</li>
                                    <li class="list-group-item text-dark">{{ translate('Set Mail Encryption as ssl') }}
                                    </li>
                                </ul>
                            </div>
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
        $(document).ready(function() {
            checkMailDriver();
        });

        function checkMailDriver() {
            if ($('select[name=MAIL_DRIVER]').val() == 'mailgun') {
                $('#mailgun').show();
                $('#smtp').hide();
            } else {
                $('#mailgun').hide();
                $('#smtp').show();
            }
        }
    </script>

@endsection
