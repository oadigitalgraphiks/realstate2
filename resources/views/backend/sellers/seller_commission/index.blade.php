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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Seller Commission</h1>
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
                    <li class="breadcrumb-item text-dark">Seller Commission</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <div class="d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="row g-5 g-xl-8">
            <div class="col-xl-6 ps-10">
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin::General options-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header d-block">
                            <div class="card-title text-center d-block">
                                <h2>{{ translate('Seller Commission Activatation') }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <div class="separator separator-dashed my-10"></div>
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <label class="form-check form-switch form-check-custom form-check-solid text-center d-block">
                                <input class="form-check-input"
                                    onchange="updateSettings(this, 'vendor_commission_activation')" <?php if (get_setting('vendor_commission_activation') == 1) {echo 'checked';} ?>
                                    type="checkbox">
                            </label>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->
                </div>
                <!--end::Main column-->
            </div>
            <div class="col-xl-6 ps-10">
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin::General options-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header d-block">
                            <div class="card-title text-center d-block">
                                <h2>{{ translate('Category Based Commission') }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <div class="separator separator-dashed my-10"></div>
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <label class="form-check form-switch form-check-custom form-check-solid text-center d-block">
                                <input class="form-check-input" onchange="updateSettings(this, 'category_wise_commission')"
                                    <?php if (get_setting('category_wise_commission') == 1) {
                                        echo 'checked';
                                    } ?> type="checkbox">
                            </label>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->
                </div>
                <!--end::Main column-->
            </div>
            <div class="col-xl-6 ps-10">
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin::General options-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ translate('Seller Commission') }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <div class="separator separator-dashed my-10"></div>
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Main column-->
                            <form action="{{ route('business_settings.vendor_commission.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                                    <!--begin::General options-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ translate('Seller Commission') }}  %</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="hidden" name="types[]" value="vendor_commission">
                                                <input type="text" name="vendor_commission" class="form-control mb-2"
                                                    placeholder="{{translate('Seller Commission')}}" lang="en" min="0" step="0.01" value="{{ get_setting('vendor_commission') }}" required />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Card header-->
                                        <div class="d-flex justify-content-end">
                                            <!--begin::Button-->
                                            <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                                <span class="indicator-label">{{ translate('Save Changes') }}</span>
                                                <span class="indicator-progress">{{ translate('Please wait') }}...
                                                    <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                            <!--end::Button-->
                                        </div>
                                    </div>
                                    <!--end::General options-->
                                </div>
                            </form>
                            <!--end::Main column-->
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->
                </div>
                <!--end::Main column-->
            </div>
            <div class="col-xl-6 ps-10">
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin::General options-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header d-block">
                            <div class="card-title text-center d-block">
                                <h2>{{ translate('Note') }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <div class="separator separator-dashed my-10"></div>
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Notice-->
                            <div
                            class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                <!--begin::Content-->
                                <div class="mb-3 mb-md-0 fw-bold">
                                    <div class="fs-6 text-gray-700 pe-7">
                                        <li>
                                            {{translate('20% of seller product price will be deducted from seller earnings.')}}
                                        </li>
                                        <li>
                                        {{translate('If Category Based Commission is enbaled, Set seller commission percentage 0..')}}
                                        </li>
                                    </div>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Notice-->
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->
                </div>
                <!--end::Main column-->
            </div>
        </div>

    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function updateSettings(el, type) {
            if ($(el).is(':checked')) {
                var value = 1;
            } else {
                var value = 0;
            }

            $.post('{{ route('business_settings.update.activation') }}', {
                _token: '{{ csrf_token() }}',
                type: type,
                value: value
            }, function(data) {
                if (data == '1') {
                    AIZ.plugins.notify('success', '{{ translate('Settings updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
