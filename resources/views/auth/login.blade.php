@extends('backend.layouts.layout')

@section('content')
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative"
                style="background-color: #F2C98A">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                    <!--begin::Content-->
                    <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                        <!--begin::Logo-->
                        @if (get_setting('system_logo_black') != null)
                            <img src="{{ uploaded_asset(get_setting('system_logo_black')) }}" class="h-60px"
                                height="60">
                        @else
                            <img src="{{ static_asset('assets/img/logo.png') }}" class="mw-100 mb-4" height="40">
                        @endif
                        <br>
                        <!--end::Logo-->
                        <!--begin::Title-->
                        <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #986923;">{{ translate('Welcome to') }}
                            {{ env('APP_NAME') }}</h1>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <p class="fw-bold fs-2" style="color: #986923;">Discover Amazing {{ env('APP_NAME') }}
                            <br />{{ translate('Login to your account.') }}
                        </p>
                        <!--end::Description-->
                    </div>
                    <!--end::Content-->
                    <!--begin::Illustration-->
                    <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
                        style="background-image: url({{ uploaded_asset(get_setting('admin_login_background')) }}"></div>
                    <!--end::Illustration-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid py-20">
                <!--begin::Content-->
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                        <!--begin::Form-->
                        <form class="form w-100" id="kt_sign_in_form" method="POST" role="form"
                            action="{{ route('login') }}">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-10">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-3">Sign In to {{ env('APP_NAME') }}</h1>
                                <!--end::Title-->
                            </div>
                            <!--begin::Heading-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input
                                    class="form-control form-control-lg form-control-solid {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    type="text" name="email" id="email" autocomplete="off" />
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack mb-2">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                                    <!--end::Label-->
                                    @if (env('MAIL_USERNAME') != null && env('MAIL_PASSWORD') != null)
                                        <!--begin::Link-->
                                        <a href="{{ route('password.request') }}"
                                            class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
                                        <!--end::Link-->
                                    @endif
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Input-->
                                <input type="password"
                                    class="form-control form-control-lg form-control-solid {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" required placeholder="{{ translate('Password') }}" />
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <!--end::Input-->
                                <!--begin::Input group-->
                                <div class="fv-row mt-10">
                                    <label class="form-check form-check-custom form-check-solid form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }} />
                                        <span
                                            class="form-check-label fw-bold text-gray-700 fs-6">{{ translate('Remember Me') }}</span>
                                    </label>
                                </div>

                                <!--end::Input group-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="text-center">
                                <!--begin::Submit button-->
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                    <span class="indicator-label">Continue</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Submit button-->
                                <!--begin::Separator-->
                            </div>
                            <!--end::Actions-->
                        </form>
                        @if (env('DEMO_MODE') == 'On')
                            <div class="mt-4">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>admin@example.com</td>
                                            <td>123456</td>
                                            <td><button class="btn btn-info btn-xs"
                                                    onclick="autoFill()">{{ translate('Copy') }}</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--end::Main-->


@endsection

@section('script')
    <script type="text/javascript">
        function autoFill() {
            $('#email').val('admin@example.com');
            $('#password').val('123456');
        }
    </script>
@endsection
