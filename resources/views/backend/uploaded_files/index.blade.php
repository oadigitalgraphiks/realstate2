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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">All uploaded files</h1>
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
                    <li class="breadcrumb-item text-muted">Upload</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">All uploaded files</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div class="d-flex flex-column flex-column-fluid" id="kt_content">
        {{-- <div class="row g-5 g-xl-8">
            <div class="col-xl-6"> --}}
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
                                        <h2>{{translate('All uploaded files')}}</h2>
                                    </div>
                                    <!--end::Search-->
                                </div>
                                <!--end::Card title-->
                                <div class="card-toolbar">
                                    <!--begin::Toolbar-->
                                    <form id="sort_uploads" action="">
                                    <div class="d-flex justify-content-end" data-kt-filemanager-table-toolbar="base">
                                            <!--begin::Input group-->
                                                <div class="me-5">
                                                    <select class="form-select form-select-solid" data-kt-select2="true"
                                                        data-placeholder="Select option" onchange="sort_uploads()" name="sort">
                                                        <option value="newest" @if($sort_by == 'newest') selected="" @endif>{{ translate('Sort by newest') }}</option>
                                                        <option value="oldest" @if($sort_by == 'oldest') selected="" @endif>
                                                            {{ translate('Sort by oldest') }}</option>
                                                        <option value="smallest" @if($sort_by == 'smallest') selected="" @endif>
                                                            {{ translate('Sort by smallest') }}</option>
                                                        <option value="largest" @if($sort_by == 'largest') selected="" @endif>
                                                            {{ translate('Sort by largest') }}</option>
                                                    </select>
                                                </div>
                                            <!--end::Input-->
                                            <!--begin::Search-->
                                            <div class="d-flex align-items-center position-relative my-1 me-10">

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
                                                    name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset
                                                    placeholder="{{ translate('Type & Enter') }}" />
                                            </div>
                                            <!--end::Search-->
                                        <!--begin::Add customer-->
                                        <a  href="{{ route('uploaded-files.create') }}" class="btn btn-primary">
                                        <!--begin::Svg Icon | path: icons/duotune/files/fil018.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="black"></path>
                                                <path d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM16 11.6L12.7 8.29999C12.3 7.89999 11.7 7.89999 11.3 8.29999L8 11.6H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H16Z" fill="black"></path>
                                                <path opacity="0.3" d="M11 11.6V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H11Z" fill="black"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->{{translate('Upload Files')}}</a>
                                        <!--end::Add customer-->
                                    </div>
                                    </form>
                                    <!--end::Toolbar-->
                                    <!--begin::Group actions-->
                                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-filemanager-table-toolbar="selected">
                                        <div class="fw-bolder me-5">
                                        <span class="me-2" data-kt-filemanager-table-select="selected_count"></span>{{translate('Selected')}}</div>
                                        <button type="button" class="btn btn-danger" data-kt-filemanager-table-select="delete_selected">{{translate('Delete Selected')}}</button>
                                    </div>
                                    <!--end::Group actions-->
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <div class="row">
                                    @foreach($all_uploads as $key => $file)
                                        @php
                                            if($file->file_original_name == null){
                                                $file_name = translate('Unknown');
                                            }else{
                                                $file_name = $file->file_original_name;
                                            }
                                        @endphp
                                            <div class="col-2">
                                                <div class="aiz-file-box">
                                                    <div class="dropdown-file" >
                                                        <a class="dropdown-link" data-toggle="dropdown">
                                                            <i class="la la-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="javascript:void(0)" class="dropdown-item" onclick="detailsInfo(this)" data-id="{{ $file->id }}">
                                                                <i class="las la-info-circle mr-2"></i>
                                                                <span>{{ translate('Details Info') }}</span>
                                                            </a>
                                                            <a href="{{ my_asset($file->file_name) }}" target="_blank" download="{{ $file_name }}.{{ $file->extension }}" class="dropdown-item">
                                                                <i class="la la-download mr-2"></i>
                                                                <span>{{ translate('Download') }}</span>
                                                            </a>
                                                            <a href="javascript:void(0)" class="dropdown-item" onclick="copyUrl(this)" data-url="{{ my_asset($file->file_name) }}">
                                                                <i class="las la-clipboard mr-2"></i>
                                                                <span>{{ translate('Copy Link') }}</span>
                                                            </a>
                                                            <a href="javascript:void(0)" class="dropdown-item confirm-alert" data-href="{{ route('uploaded-files.destroy', $file->id ) }}" data-target="#delete-modal">
                                                                <i class="las la-trash mr-2"></i>
                                                                <span>{{ translate('Delete') }}</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="card card-file aiz-uploader-select c-default" title="{{ $file_name }}.{{ $file->extension }}">
                                                        <div class="card-file-thumb">
                                                            @if($file->type == 'image')
                                                                <img src="{{ my_asset($file->file_name) }}" class="img-fit">
                                                            @elseif($file->type == 'video')
                                                                <i class="las la-file-video"></i>
                                                            @else
                                                                <i class="las la-file"></i>
                                                            @endif
                                                        </div>
                                                        <div class="card-body">
                                                            <h6 class="d-flex">
                                                                <span class="text-truncate title">{{ $file_name }}</span>
                                                                <span class="ext">.{{ $file->extension }}</span>
                                                            </h6>
                                                            <p>{{ formatBytes($file->file_size) }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Products-->
                    </div>
                    <!--end::Container-->
                </div>
    </div>
</div>

@endsection
@section('modal')
<div id="delete-modal" class="modal fade" tabindex="-1" aria-labelledby="delete-modal" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title h6">{{ translate('Delete Confirmation') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mt-1">{{ translate('Are you sure to delete this file?') }}</p>
                <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-light"
                        data-dismiss="modal">{{ translate('Cancel') }}</button>
                <a href="" class="btn btn-primary mt-2 comfirm-link">{{ translate('Delete') }}</a>
            </div>
        </div>
    </div>
</div>
<div id="info-modal" class="modal fade" tabindex="-1" aria-labelledby="info-modal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-right">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title h6">{{ translate('File Info') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body c-scrollbar-light position-relative" id="info-modal-content">
				<div class="c-preloader text-center absolute-center">
                    <i class="las la-spinner la-spin la-3x opacity-70"></i>
                </div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('script')
	<script type="text/javascript">
		function detailsInfo(e){
            $('#info-modal-content').html('<div class="c-preloader text-center absolute-center"><i class="las la-spinner la-spin la-3x opacity-70"></i></div>');
			var id = $(e).data('id')
			$('#info-modal').modal('show');
			$.post('{{ route('uploaded-files.info') }}', {_token: AIZ.data.csrf, id:id}, function(data){
                $('#info-modal-content').html(data);
				// console.log(data);
			});
		}
		function copyUrl(e) {
			var url = $(e).data('url');
			var $temp = $("<input>");
		    $("body").append($temp);
		    $temp.val(url).select();
		    try {
			    document.execCommand("copy");
			    AIZ.plugins.notify('success', '{{ translate('Link copied to clipboard') }}');
			} catch (err) {
			    AIZ.plugins.notify('danger', '{{ translate('Oops, unable to copy') }}');
			}
		    $temp.remove();
		}
        function sort_uploads(el){
            $('#sort_uploads').submit();
        }
	</script>
@endsection
