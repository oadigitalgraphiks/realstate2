@extends('backend.layouts.app')

@section('content')

<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10"
            action="{{ route('colors.update', $color->id) }}" method="POST"
            enctype="multipart/form-data">
            <input name="_method" type="hidden" value="POST">
            @csrf
            <!--begin::Main column-->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <!--begin::General options-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{ translate('Color Information') }}</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Input group-->
                        <div class="mb-5 fv-row">
                            <label class="required form-label">{{ translate('Color Name') }}</label>
                            <input type="text" placeholder="{{ translate('Color Name') }}" id="name" name="name"
                                class="form-control mb-2" value="{{ $color->name }}" required>
                        </div>
                        <!--begin::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-5 fv-row">
                            <label class="required form-label">{{ translate('Color Code') }}</label>
                            <input type="text" placeholder="{{ translate('Color Code') }}" id="code" name="code"
                                class="form-control mb-2" value="{{ $color->code }}" required>
                        </div>
                        <!--begin::Input group-->
                    </div>
                    <!--end::Card header-->
                </div>

                <div class="d-flex justify-content-end">

                    <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                        <span class="indicator-label">{{ translate('Update Changes') }}</span>
                        <span class="indicator-progress">{{ translate('Please wait') }}...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
            </div>
            <!--end::Main column-->
        </form>
    </div>
    <!--end::Container-->
</div>

@endsection
