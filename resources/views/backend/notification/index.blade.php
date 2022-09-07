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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{translate('All Notifications')}}</h1>
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
                    <li class="breadcrumb-item text-dark">{{translate('Notifications')}}</li>
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
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card card-flush">
                        <form class="" id="sort_customers" action="" method="GET">
                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                <div class="col">
                                    <h5 class="mb-0 h6">{{translate('Notifications')}}</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    @forelse($notifications as $notification)
                                        @if($notification->type == 'App\Notifications\OrderNotification')
                                            <li class="list-group-item d-flex justify-content-between align-items- py-3">
                                                <div class="media text-inherit">
                                                    <div class="media-body">
                                                        <p class="mb-1 text-truncate-2">
                                                            {{ translate('Order code: ') }}
                                                            <a href="{{route('all_orders.show', encrypt($notification->data['order_id']))}}">
                                                                {{$notification->data['order_code']}}
                                                            </a>
                                                            {{translate(' has been '. ucfirst(str_replace('_', ' ', $notification->data['status'])))}}
                                                        </p>
                                                        <small class="text-muted">
                                                            {{ date("F j Y, g:i a", strtotime($notification->created_at)) }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
            
                                    @empty
                                        <li class="list-group-item">
                                            <div class="py-4 text-center fs-16">{{ translate('No notification found') }}</div>
                                        </li>
                                    @endforelse
                                </ul>
                                
                                {{ $notifications->links() }}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

