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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Addon</h1>
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
                        <li class="breadcrumb-item text-dark">Addons List</li>
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
                <div class="card-header py-5">
                    <div class="card-title">
                        <!--begin:::Tabs-->
                        <ul
                            class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2 nav nav-tabs nav-fill border-light">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="p-3 fs-16 text-reset show active" data-toggle="tab" href="#installed">{{ translate('Installed Addon')}}</a>
                                <a class="p-3 fs-16 text-reset" data-toggle="tab" href="#available">{{ translate('Available Addon')}}</a>
                            </li>
                            <!--end:::Tab item-->
                            
                        </ul>
                    <!--end:::Tabs-->
                    </div>
                    <div class="tab-content">
                        <!--begin:::Tab item-->
                        <a href="{{ route('addons.create')}}" class="btn btn-primary">{{ translate('Install/Update Addon')}}</a>
                        <!--end:::Tab item-->
                    </div>
                </div>
            </div>
        <br>
        <div class="tab-content">
            <div class="tab-pane fade in active show" id="installed">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-group">
                                    @forelse(\App\Models\Addon::all() as $key => $addon)
                                        <li class="list-group-item">
                                            <div class="align-items-center d-flex flex-column flex-md-row">
                                                <img class="h-60px mb-3 mb-md-0" src="{{ static_asset($addon->image) }}" alt="Image">
                                                <div class="mr-md-3 ml-md-5">
                                                    <h4 class="fs-16 fw-600">{{ ucfirst($addon->name) }}</h4>
                                                </div>
                                                <div class="mr-md-3 ml-0">
                                                    <p><small>{{ translate('Version')}}: </small>{{ $addon->version }}</p>
                                                </div>
                                                @if (env('DEMO_MODE') != 'On')
                                                    <div class="mr-md-3 ml-0">
                                                        <p><small>{{ translate('Purchase code')}}: </small>{{ $addon->purchase_code }}</p>
                                                    </div>
                                                @endif
                                                <div class="ml-auto mr-0">
                                                    <label class="aiz-switch mb-0">
                                                        <input type="checkbox" onchange="updateStatus(this, {{ $addon->id }})" <?php if($addon->activated) echo "checked";?>>
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="list-group-item">
                                            <div class="text-center">
                                                <img class="mw-100 h-200px" src="{{ static_asset('assets/img/nothing.svg') }}" alt="Image">
                                                <h5 class="mb-0 h5 mt-3">{{ translate('No Addon Installed')}}</h5>
                                            </div>
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="available">
                <div class="row" id="available-addons-content">

                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('script')
    <script type="text/javascript">
        function updateStatus(el, id){
            if($(el).is(':checked')){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('addons.activation') }}', {_token:'{{ csrf_token() }}', id:id, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Status updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        $(document).ready(function(){
            $.post('https://activeitzone.com/addons/public/addons', {item: 'ecommerce'}, function(data){
                //console.log(data);
                html = '';
                data.forEach((item, i) => {
                    if(item.link != null){
                        html += `<div class="col-lg-4 col-md-6 ">
                                    <div class="card addon-card">
                                        <div class="card-body">
                                            <a href="${item.link}" target="_blank"><img class="img-fluid" src="${item.image}"></a>
                                            <div class="pt-4">
                                                <a class="fs-16 fw-600 text-reset" href="${item.link}" target="_blank">${item.name}</a>
                                                <div class="rating mb-2"><i class="la la-star active"></i><i class="la la-star active"></i><i class="la la-star active"></i><i class="la la-star active"></i><i class="la la-star active"></i></div>
                                                <p class="mar-no text-truncate-3">${item.short_description}</p>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-danger fs-22 fw-600">$${item.price}</div>
                                            <div class=""><a href="${item.link}" target="_blank" class="btn btn-sm btn-secondary">Preview</a> <a href="${item.purchase}" target="_blank" class="btn btn-sm btn-primary">Purchase</a></div>
                                        </div>
                                    </div>
                                </div>`;
                    }
                    else {
                        html += `<div class="col-lg-4 col-md-6 ">
                                    <div class="card addon-card">
                                        <div class="card-body">
                                            <a><img class="img-fluid" src="${item.image}"></a>
                                            <div class="pt-4">
                                                <a class="fs-16 fw-600 text-reset" >${item.name}</a>
                                                <div class="rating mb-2"><i class="la la-star active"></i><i class="la la-star active"></i><i class="la la-star active"></i><i class="la la-star active"></i><i class="la la-star active"></i></div>
                                                <p class="mar-no text-truncate-3">${item.short_description}</p>
                                            </div>
                                            <div class="card-footer">
                                                <div class="text-center"><div class="btn btn-outline btn-primary">Coming Soon</div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                    }

                });
                $('#available-addons-content').html(html);
            });
        })
    </script>
@endsection
