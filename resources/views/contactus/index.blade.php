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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Contact Us</h1>
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
                        <li class="breadcrumb-item text-muted">Catalog</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">Contact Us</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <div class="row g-5 g-xl-8">
            <div class="col-xl-12">
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="container-xxl">
                        <!--begin::Products-->
                        <div class="card card-flush">
                            <!--begin::Card header-->
                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                        <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                                    rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                <path
                                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <form class="" id="sort_contact" action="" method="GET">
                                            <input type="text" data-kt-ecommerce-product-filter="search"
                                                class="form-control form-control-solid w-250px ps-14"
                                                placeholder="Search Contact" id="search" name="search"
                                                @isset($sort_search) value="{{ $sort_search }}" @endisset />
                                        </form>
                                    </div>
                                    <!--end::Search-->
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <div class="card-body pt-0">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5"
                                    id="kt_ecommerce_products_table">
                                    <!--begin::Table head-->
                                    <thead>
                                        <!--begin::Table row-->
                                        <tr class="text-center text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2">
                                                #
                                            </th>
                                            <th >{{ translate('Name') }}</th>
                                            <th >{{ translate('Email') }}</th>
                                            <th >{{ translate('Phone') }}</th>
                                            <th >{{ translate('Subject') }}</th>
                                            <th class="min-w-70px">{{ translate('Options') }}</th>
                                        </tr>
                                        <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                        @foreach ($contacts as $key => $contact)
                                            <tr class="text-center">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        {{$key + 1}}
                                                    </div>
                                                </td>
                                                <td>{{$contact->name .' '. $contact->surname}}</td>
                                                <td>
                                                    <div class="ms-5">
                                                        <a href="mailto:{{$contact->email}}"
                                                            class="text-gray-800 text-hover-primary fs-5">
                                                            {{$contact->email}}
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="ms-5">
                                                        <a href="tel:{{$contact->phone}}" class="text-gray-800 text-hover-primary fs-5">
                                                            {{$contact->phone}}
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>{{$contact->subject}}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="javascript:void(0)" onclick="show({{$contact->id}})" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="Query">
                                                            <i class="las la-eye"></i>
                                                        </a>
                                                    </div>
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
        </div>
    </div>
@endsection

@section('modal')

<div class="modal fade" id="contactmsg" tabindex="-1" aria-labelledby="create-inventory" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ translate('Query') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="transfer_product" method="POST">
                @csrf
                <div class="modal-body" id="contactbody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ translate('Cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@section('script')
    <script>
        function show(id) {
            $('#contactbody').html(null);
            $("#contactmsg").modal('show');
            $.post('{{ route('contact_show') }}', {
                _token: '{{ csrf_token() }}',
                id: id
            }, function(data) {
                $('#contactbody').html(data);
                AIZ.plugins.fooTable();
            });
        }
    </script>
@endsection
