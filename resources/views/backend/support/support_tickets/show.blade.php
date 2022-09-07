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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Support Desk</h1>
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
                    <li class="breadcrumb-item text-muted">Support</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Support Chat</li>
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
            <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10" action="{{ route('support_ticket.admin_store') }}"
                method="POST" enctype="multipart/form-data" id="ticket-reply-form">
                @csrf
                <input type="hidden" name="ticket_id" value="{{$ticket->id}}" required>
                <input type="hidden" name="status" value="{{ $ticket->status }}" required>

                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin::General options-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ $ticket->subject }} #{{ $ticket->code }}</h2>
                            </div>
                            <div class="card-title mb-5 fv-row">
                                <span class="px-10"> {{ $ticket->user->name }} </span>
                                <span class="ml-2"> {{ $ticket->created_at }} </span>
                                @if($ticket->status == 'open')
                                    <span class="badge badge-inline badge-primary ml-2 text-capitalize">
                                        {{ translate($ticket->status) }}
                                    </span>
                                @endif
                                @if($ticket->status == 'pending')
                                    <span class="badge badge-inline badge-warning ml-2 text-capitalize">
                                        {{ translate($ticket->status) }}
                                    </span>
                                @endif
                                @if($ticket->status == 'solved')
                                    <span class="badge badge-inline badge-success ml-2 text-capitalize">
                                        {{ translate($ticket->status) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <div class="mb-5 fv-row">
                                <label class="form-label">{{ translate('Description') }}</label>
                                <textarea name="reply" rows="5" class="aiz-text-editor"></textarea>
                            </div>
                            <div class="fv-row mt-5 mb-2">
                                <label class="form-label">{{ translate('Attachments') }}</label>
                                <!--begin::Dropzone-->
                                <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                    data-toggle="aizuploader" data-type="image">
                                    <!--begin::Message-->
                                    <div class="dz-message needsclick">
                                        <!--begin::Icon-->
                                        <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                        <!--end::Icon-->
                                        <!--begin::Info-->
                                        <input type="hidden" name="attachments" class="selected-files">
                                        <div class="ms-4">
                                            <h3 class="fs-5 fw-bolder text-gray-900 mb-1">{{translate('Drop files here or click
                                                to upload')}}.</h3>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                </div>
                                <!--end::Dropzone-->
                                <div class="file-preview box sm">
                                </div>

                            </div>
                        </div>

                        <div class="d-flex justify-content-end">

                            <div class="form-group mb-0 text-right px-5">
                                <button type="submit" class="btn btn-sm btn-dark" onclick="submit_reply('pending')">
                                    {{ translate('Submit as') }}
                                    <strong>
                                        <span class="text-capitalize">
                                            {{ translate($ticket->status) }}
                                        </span>
                                    </strong>
                                </button>
                                <button type="submit" class="btn btn-icon btn-sm btn-dark" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"><i class="las la-angle-down"></i></button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#" onclick="submit_reply('open')">{{ translate('Submit as') }} <strong>{{ translate('Open') }}</strong></a>
                                    <a class="dropdown-item" href="#" onclick="submit_reply('solved')">{{ translate('Submit as') }} <strong>{{ translate('Solved') }}</strong></a>
                                </div>
                            </div>
                            {{-- <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                <span class="indicator-label">{{ translate('Save Changes') }}</span>
                                <span class="indicator-progress">{{translate('Please wait')}}...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button> --}}
                            <!--end::Button-->
                        </div>
                    </div>
                    <!--end::Main column-->
                </div>
            </form>
            <!--end::Container-->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <!--begin::General options-->
                <div class="card card-flush py-4">
                    <div class="pad-top">
                        @foreach($ticket->ticketreplies as $ticketreply)
                        <div class="mb-15">
                            <!--begin::Comment-->
                            <div class="mb-9">
                                <!--begin::Card-->
                                <div class="card card-bordered w-100">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <!--begin::Wrapper-->
                                        <div class="w-100 d-flex flex-stack mb-8">
                                            <!--begin::Container-->
                                            <div class="d-flex align-items-center f">
                                                <!--begin::Author-->
                                                <div class="symbol symbol-50px me-5">
                                                    @if($ticketreply->user->avatar_original != null)
                                                        <div class="symbol-label fs-1 fw-bolder bg-light-success text-success">
                                                            <img src="{{ uploaded_asset($ticketreply->user->avatar_original) }}">
                                                        </div>
                                                    @else
                                                        <div class="symbol-label fs-1 fw-bolder bg-light-success text-success">
                                                            {{ substr($ticketreply->user->name,0,1) }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <!--end::Author-->
                                                <!--begin::Info-->
                                                <div class="d-flex flex-column fw-bold fs-5 text-gray-600 text-dark">
                                                    <!--begin::Text-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Username-->
                                                        <a href="javascript:void()" class="text-gray-800 fw-bolder text-hover-primary fs-5 me-3">{{ $ticket->user->name }}</a>
                                                        <!--end::Username-->
                                                        <span class="m-0"></span>
                                                    </div>
                                                    <!--end::Text-->
                                                    <!--begin::Date-->
                                                    <span class="text-muted fw-bold fs-6">{{$ticketreply->created_at}}</span>
                                                    <!--end::Date-->
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::Container-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Desc-->
                                        <p class="fw-normal fs-5 text-gray-700 m-0"> @php echo $ticketreply->reply; @endphp</p>
                                        <br>
                                        <div class="mt-3">
                                            @foreach ((explode(",",$ticketreply->files)) as $key => $file)
                                                @php $file_detail = \App\Models\Upload::where('id', $file)->first(); @endphp
                                                @if($file_detail != null)
                                                    <a href="{{ uploaded_asset($file) }}" download="" class="badge badge-lg badge-inline badge-light mb-1">
                                                        <i class="las la-paperclip mr-2">{{ $file_detail->file_original_name.'.'.$file_detail->extension }}</i>
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Comment-->
                        </div>
                        @endforeach
                        <div class="mb-15">
                            <!--begin::Comment-->
                            <div class="mb-9">
                                <!--begin::Card-->
                                <div class="card card-bordered w-100">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <!--begin::Wrapper-->
                                        <div class="w-100 d-flex flex-stack mb-8">
                                            <!--begin::Container-->
                                            <div class="d-flex align-items-center f">
                                                <!--begin::Author-->
                                                <div class="symbol symbol-50px me-5">
                                                    @if($ticket->user->avatar_original != null)
                                                        <div class="symbol-label fs-1 fw-bolder bg-light-success text-success">
                                                            <img src="{{ uploaded_asset($ticket->user->avatar_original) }}">
                                                        </div>
                                                    @else
                                                        <div class="symbol-label fs-1 fw-bolder bg-light-success text-success">
                                                            {{ substr($ticket->user->name,0,1) }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <!--end::Author-->
                                                <!--begin::Info-->
                                                <div class="d-flex flex-column fw-bold fs-5 text-gray-600 text-dark">
                                                    <!--begin::Text-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Username-->
                                                        <a href="javascript:void()" class="text-gray-800 fw-bolder text-hover-primary fs-5 me-3">{{ $ticket->user->name }}</a>
                                                        <!--end::Username-->
                                                        <span class="m-0"></span>
                                                    </div>
                                                    <!--end::Text-->
                                                    <!--begin::Date-->
                                                    <span class="text-muted fw-bold fs-6">{{ $ticket->created_at }}</span>
                                                    <!--end::Date-->
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::Container-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Desc-->
                                        <p class="fw-normal fs-5 text-gray-700 m-0"> @php echo $ticket->details; @endphp</p>
                                        <br>
                                            @foreach ((explode(",",$ticket->files)) as $key => $file)
                                                @php $file_detail = \App\Models\Upload::where('id', $file)->first(); @endphp
                                                @if($file_detail != null)
                                                    <a href="{{ uploaded_asset($file) }}" download="" class="badge badge-lg badge-inline badge-light mb-1">
                                                        <i class="las la-download">{{ $file_detail->file_original_name.'.'.$file_detail->extension }}</i>
                                                    </a>
                                                    <br>
                                                @endif
                                            @endforeach
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Comment-->
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!--end::Post-->
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function submit_reply(status){
            $('input[name=status]').val(status);
            if($('textarea[name=reply]').val().length > 0){
                $('#ticket-reply-form').submit();
            }
        }
    </script>
@endsection
