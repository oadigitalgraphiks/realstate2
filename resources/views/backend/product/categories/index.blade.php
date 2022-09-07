@extends('backend.layouts.app')

@section('content')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Categories</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Home</a>
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
                        <li class="breadcrumb-item text-dark">Categories</li>
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
                <!--begin::Products-->
                <form class="" id="sort_categories" action="" method="GET">
                    <div class="card card-flush">
                        <!--begin::Card header-->
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                                transform="rotate(45 17.0365 15.1223)" fill="black" />
                                            <path
                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <input type="text" class="form-control form-control-solid w-250px ps-14" id="search"
                                        name="search" @isset($sort_search) value="{{ $sort_search }}"
                                        @endisset placeholder="{{ translate('Type & Enter') }}" />
                                </div>
                                <!--end::Search-->

                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                                    {{ translate('Add New Category') }}
                                </a>
                                <!--end::Add product-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->

                        <div class="card-body pt-0">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                    <!--begin::Table head-->
                                    <thead>
                                        <!--begin::Table row-->
                                        <tr class="text-center text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2">
                                                {{ translate('Sno.') }}
                                            </th>
                                            <th class="min-w-200px">{{ translate('Category Name') }}</th>
                                            <th class="text-center min-w-75px">{{ translate('Parent Category') }}</th>
                                            <th class="text-center min-w-175px">{{ translate('Order Level') }}</th>
                                            <th class="text-center min-w-150px">{{ translate('Level') }}</th>
                                            <th class="text-center min-w-100px">{{ translate('Banner') }}</th>
                                            <th class="text-center min-w-100px">{{ translate('Icon') }}</th>
                                            <th class="text-center min-w-70px">{{ translate('Featured') }}</th>
                                            <th class="text-center min-w-100px">{{ translate('Commission') }}</th>
                                            <th class="text-center min-w-150px">{{ translate('Actions') }}</th>
                                        </tr>
                                        <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                        <!--begin::Table row-->
                                        @foreach ($categories as $key => $category)
                                            <tr>
                                                <!--begin::Checkbox-->
                                                <td class="text-center pe-0">
                                                    <span
                                                        class="fw-bolder">{{ $key + 1 + ($categories->currentPage() - 1) * $categories->perPage() }}</span>
                                                </td>
                                                <!--begin::Category=-->
                                                <td>
                                                    <div class="d-flex">
                                                        <!--begin::Thumbnail-->
                                                        <a href="{{ route('categories.edit', ['id' => $category->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                                            class="symbol symbol-50px">
                                                            @if ($category->icon != null)
                                                                <span class="symbol-label"
                                                                    style="background-image:url({{ uploaded_asset($category->icon) }});"></span>
                                                            @else
                                                                —
                                                            @endif
                                                        </a>
                                                        <!--end::Thumbnail-->
                                                        <div class="ms-5">
                                                            <!--begin::Title-->
                                                            <a href="{{ route('categories.edit', ['id' => $category->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                                                class="text-gray-800 text-hover-primary fs-5 fw-bolder mb-1"
                                                                data-kt-ecommerce-category-filter="category_name">
                                                                <div class="badge badge-light-success">
                                                                    {{ $category->getTranslation('name') }}</div>
                                                            </a>
                                                            <!--end::Title-->
                                                        </div>
                                                    </div>
                                                </td>
                                                <!--end::Category=-->
                                                <td class="text-center pe-0">
                                                    <span class="fw-bolder">@php
                                                        $parent = \App\Models\Category::where('id', $category->parent_id)->first();
                                                    @endphp
                                                        @if ($parent != null)
                                                            {{ $parent->getTranslation('name') }}
                                                        @else
                                                            —
                                                        @endif
                                                    </span>
                                                </td>
                                                <!--end::SKU=-->
                                                <!--begin::Qty=-->
                                                <td class="text-center pe-0" data-order="32">
                                                    <span class="fw-bolder ms-3">
                                                        {{ $category->order_level }}
                                                    </span>
                                                </td>
                                                <td class="text-center pe-0" data-order="32">
                                                    <span class="fw-bolder ms-3">
                                                        {{ $category->level }}
                                                    </span>
                                                </td>
                                                <!--end::Qty=-->
                                                <!--begin::Price=-->
                                                <td class="text-center pe-0" data-order="2">
                                                    <span>
                                                        @if ($category->banner != null)
                                                            <img src="{{ uploaded_asset($category->banner) }}"
                                                                alt="{{ translate('Banner') }}" class="h-50px">
                                                        @else
                                                            —
                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="text-center pe-0">
                                                    @if ($category->icon != null)
                                                        <span class="avatar avatar-square avatar-xs width_75">
                                                            <img src="{{ uploaded_asset($category->icon) }}"
                                                                alt="{{ translate('icon') }}" style="width: 75px">
                                                        </span>
                                                    @else
                                                        —
                                                    @endif
                                                </td>
                                                <!--end::Price=-->
                                                <!--begin::Rating-->
                                                <td class="text-center pe-0" data-order="rating-3">
                                                    <label
                                                        class="form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" onchange="update_featured(this)"
                                                            value="{{ $category->id }}" type="checkbox"
                                                            <?php if ($category->featured == 1) {
                                                                echo 'checked';
                                                            } ?>>
                                                    </label>
                                                </td>
                                                <td class="text-center pe-0">
                                                    <span
                                                        class="badge badge-light-warning">{{ $category->commision_rate }}
                                                        %</span>
                                                </td>
                                                <!--end::Rating-->

                                                <td class="text-center">
                                                    <a href="{{ route('categories.edit', ['id' => $category->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <path
                                                                        d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z"
                                                                        fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                    <path
                                                                        d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
                                                                        fill="#000000" opacity="0.3" />
                                                                </g>
                                                            </svg></span>
                                                    </a>

                                                    <a href="#"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm confirm-delete"
                                                        data-href="{{ route('categories.destroy', $category->id) }}">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none">
                                                                <path
                                                                    d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                                    fill="black"></path>
                                                                <path opacity="0.5"
                                                                    d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                                    fill="black"></path>
                                                                <path opacity="0.5"
                                                                    d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                                    fill="black"></path>
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </a>

                                                </td>

                                                <!--end::Action=-->
                                            </tr>
                                        @endforeach
                                        <!--end::Table row-->
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <div class="aiz-pagination">
                                {{ $categories->appends(request()->input())->links() }}
                            </div>
                            <!--end::Card body-->
                        </div>
                    </div>
                </form>
                <!--end::Products-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->


@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')
    <script type="text/javascript">
        function update_featured(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('categories.featured') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Featured categories updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>
@endsection
