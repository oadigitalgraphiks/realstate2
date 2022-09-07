@extends('backend.layouts.app')

@section('content')

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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Theme</h1>
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
                        <li class="breadcrumb-item text-dark">Themes List & Module List</li>
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
        <div class="card card-flush">
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin:::Tabs-->
                        <ul
                            class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2 nav nav-tabs nav-fill border-light">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                    href="#kt_ecommerce_theme" id="theme">{{ translate('Installed Themes') }}</a>
                            </li>
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                    href="#kt_ecommerce_module" id="module">{{translate("Installed Modules")}}</a>
                            </li>
                            <!--end:::Tab item-->
                        </ul>
                    <!--end:::Tabs-->
                    {{-- <div class="nav border-bottom aiz-nav-tabs">
                        <a class="p-3 fs-16 text-reset show active" data-toggle="tab"
                            href="#installed">{{ translate('Installed Themes') }}</a>
                    </div> --}}
                </div>
                <div class="tab-content">
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <a href="{{ route('themes.create') }}" class="btn btn-primary" id="btn-theme">{{ translate('Install Themes') }}</a>
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <a href="{{ route('addons.create') }}" class="btn btn-primary d-none" id="btn-module">{{ translate('Install Modules') }}</a>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">

                <div class="tab-content">
                    <div class="tab-pane fade in active show"  id="kt_ecommerce_theme" role="tab-panel">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @forelse(\App\Models\Theme::all() as $key => $theme)
                                                <li class="list-group-item">
                                                    <div class="align-items-center d-flex flex-column flex-md-row row">
                                                        <div class="col-5">
                                                            <img class="h-100px mb-3 mb-md-0 w-100" src="{{file_exists(static_asset('assets_new/images/logo.svg')) ? static_asset($theme->image) : static_asset('assets/img/placeholder.jpg') }}" alt="Image">
                                                        </div>
                                                        <div class="col-5">
                                                            <h4 class="fs-16 fw-600">{{ ucfirst($theme->name) }}</h4>
                                                        </div>

                                                        {{-- <div class="mr-md-3 ml-0">
                                                            <p><small>{{ translate('Version')}}: </small>{{ $theme->version }}</p>
                                                        </div>
                                                        @if (env('DEMO_MODE') != 'On')
                                                            <div class="mr-md-3 ml-0">
                                                                <p><small>{{ translate('Purchase code')}}: </small>{{ $theme->purchase_code }}</p>
                                                            </div>
                                                        @endif --}}
                                                        <div class="ml-auto mr-0 col-2">
                                                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mb-5">
                                                                <input class="form-check-input" type="checkbox" name="cash_on_delivery"
                                                                onchange="updateStatus(this, {{ $theme->id }})" {{$theme->activated ? "checked" : ''}}>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                            @empty
                                                <li class="list-group-item">
                                                    <div class="text-center">
                                                        <img class="mw-100 h-200px" src="{{ static_asset('assets/img/nothing.svg') }}"
                                                            alt="Image">
                                                        <h5 class="mb-0 h5 mt-3">{{ translate('No Theme Installed') }}</h5>
                                                    </div>
                                                </li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade"  id="kt_ecommerce_module" role="tab-panel">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @forelse(\App\Models\Addon::all() as $key => $addon)
                                                <li class="list-group-item">
                                                    <div class="align-items-center d-flex flex-column flex-md-row row">
                                                        <div class="col-5">
                                                            <img class="h-100px mb-3 mb-md-0 w-100" src="{{ static_asset('assets/addon/images/'.$addon->image) }}" alt="Image">
                                                        </div>
                                                        <div class="col-5">
                                                            <h4 class="fs-16 fw-600">{{ ucfirst($addon->name) }}</h4>
                                                            <p><small>{{ translate('Version')}}: </small>{{ $addon->version }}</p>
                                                        </div>

                                                        {{-- <div class="mr-md-3 ml-0">
                                                        </div>
                                                        @if (env('DEMO_MODE') != 'On')
                                                            <div class="mr-md-3 ml-0">
                                                                <p><small>{{ translate('Purchase code')}}: </small>{{ $addon->purchase_code }}</p>
                                                            </div>
                                                        @endif --}}

                                                        <div class="ml-auto mr-0 col-2">
                                                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mb-5">
                                                                <input class="form-check-input" type="checkbox"
                                                                onchange="addon_status(this, {{ $addon->id }})" <?php if($addon->activated) echo "checked";?>>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                            @empty
                                                <li class="list-group-item">
                                                    <div class="text-center">
                                                        <img class="mw-100 h-200px" src="{{ static_asset('assets/img/nothing.svg') }}"
                                                            alt="Image">
                                                        <h5 class="mb-0 h5 mt-3">{{ translate('No Module Installed') }}</h5>
                                                    </div>
                                                </li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
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
<div class="modal fade" id="status-modal" tabindex="-1" aria-labelledby="delete-modal" aria-hidden="true">
    <div class="modal-dialog" style="margin: 25% 53% ">
        <div class="modal-content bg-transparent">
            <div class="modal-body">
                <div class="spinner-grow m-auto d-block text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {


            if($("#module").hasClass('active') == true){
                    $("#btn-theme").hide();
                    $("#btn-module").show();
                    $("#btn-module").removeClass('d-none');
                }else if($("#theme").hasClass('active') == true){
                    $("#btn-module").hide();
                    $("#btn-theme").show();
                }
            $("#module").click(function(){
                if($("#module").hasClass('active') == true){
                    $("#btn-theme").hide();
                    $("#btn-module").show();
                    $("#btn-module").removeClass('d-none');
                }else if($("#theme").hasClass('active') == true){
                    $("#btn-module").hide();
                    $("#btn-theme").show();
                }
            })
            $("#theme").click(function(){
                if($("#module").hasClass('active') == true){
                    $("#btn-theme").hide();
                    $("#btn-module").show();
                }else if($("#theme").hasClass('active') == true){
                    $("#btn-module").hide();
                    $("#btn-theme").show();
                }
            })
        });


        function updateStatus(el, id) {
            if ($(el).is(':checked')) {
                var status = 1;
            } else {
                var status = 0;
            }
            $("#status-modal").modal("show");

            $.post('{{ route('themes.activation') }}', {_token: '{{ csrf_token() }}',id: id,status: status}, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Status updated successfully') }}');
                    $("#status-modal").modal("show");
                    window.location.reload();
                } else {
                    $("#status-modal").modal("show");
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                    window.location.reload();
                }
            });
        }

        function addon_status(el, id) {
            if ($(el).is(':checked')) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('addons.activation') }}', {
                _token: '{{ csrf_token() }}',
                id: id,
                status: status
            }, function(data) {
                if (data == 1) {
                    console.log(data);
                    AIZ.plugins.notify('success', '{{ translate('Status updated successfully') }}');
                    window.location.reload();
                } else {
                    console.log(data);
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        $(document).ready(function() {
            // $.post('https://activeitzone.com/addons/public/addons', {item: 'ecommerce'}, function(data){
            //     //console.log(data);
            //     html = '';
            //     data.forEach((item, i) => {
            //         if(item.link != null){
            //             html += `<div class="col-lg-4 col-md-6 ">
        //                         <div class="card addon-card">
        //                             <div class="card-body">
        //                                 <a href="${item.link}" target="_blank"><img class="img-fluid" src="${item.image}"></a>
        //                                 <div class="pt-4">
        //                                     <a class="fs-16 fw-600 text-reset" href="${item.link}" target="_blank">${item.name}</a>
        //                                     <div class="rating mb-2"><i class="la la-star active"></i><i class="la la-star active"></i><i class="la la-star active"></i><i class="la la-star active"></i><i class="la la-star active"></i></div>
        //                                     <p class="mar-no text-truncate-3">${item.short_description}</p>
        //                                 </div>
        //                             </div>
        //                             <div class="card-footer">
        //                                 <div class="text-danger fs-22 fw-600">$${item.price}</div>
        //                                 <div class=""><a href="${item.link}" target="_blank" class="btn btn-sm btn-secondary">Preview</a> <a href="${item.purchase}" target="_blank" class="btn btn-sm btn-primary">Purchase</a></div>
        //                             </div>
        //                         </div>
        //                     </div>`;
            //         }
            //         else {
            //             html += `<div class="col-lg-4 col-md-6 ">
        //                         <div class="card addon-card">
        //                             <div class="card-body">
        //                                 <a><img class="img-fluid" src="${item.image}"></a>
        //                                 <div class="pt-4">
        //                                     <a class="fs-16 fw-600 text-reset" >${item.name}</a>
        //                                     <div class="rating mb-2"><i class="la la-star active"></i><i class="la la-star active"></i><i class="la la-star active"></i><i class="la la-star active"></i><i class="la la-star active"></i></div>
        //                                     <p class="mar-no text-truncate-3">${item.short_description}</p>
        //                                 </div>
        //                                 <div class="card-footer">
        //                                     <div class="text-center"><div class="btn btn-outline btn-primary">Coming Soon</div></div>
        //                                 </div>
        //                             </div>
        //                         </div>
        //                     </div>`;
            //         }

            //     });
            //     $('#available-addons-content').html(html);
            // });
        })
    </script>
@endsection
