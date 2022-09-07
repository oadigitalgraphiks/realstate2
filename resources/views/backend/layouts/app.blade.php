<!doctype html>
@if(\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="app-url" content="{{ getBaseURL() }}">
	<meta name="file-base-url" content="{{ getFileBaseURL() }}">

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Favicon -->
	<link rel="icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">
	<title>{{ get_setting('website_name').' | '.get_setting('site_motto') }}</title>

	<!-- google font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
	{{-- <link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/jquery-ui.css') }}">
	<link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}"> --}}

	<!-- aiz core css -->
	<link rel="stylesheet" href="{{ static_asset('assets/backend/css/vendor.css') }}">
{{--    @if(\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)--}}
{{--    <link rel="stylesheet" href="{{ static_asset('assets/css/bootstrap-rtl.min.css') }}">--}}
{{--    @endif--}}
{{--	<link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css') }}">--}}
        <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{ static_asset('assets/backend/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ static_asset('assets/backend/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ static_asset('assets/backend/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ static_asset('assets/backend/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ static_asset('assets/backend/css/style.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <style>
        body {
            font-size: 12px;
        }
        .container-xxl{
            max-width:100% !important;
        }
        .note-group-select-from-files{
            display:none;
        }
        /* .close{
            box-sizing: content-box;
            width: 1em;
            height: 1em;
            padding: 0.25em 0.25em;
            color: #000;
            background: transparent url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000000'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e) center/1em auto no-repeat;
            border: 0;
            border-radius: 0.475rem;
            opacity: .5;
        } */
    </style>
    @yield('css')
	<script>
    	var AIZ = AIZ || {};
        AIZ.local = {
            nothing_selected: '{{ translate('Nothing selected') }}',
            nothing_found: '{{ translate('Nothing found') }}',
            choose_file: '{{ translate('Choose file') }}',
            file_selected: '{{ translate('File selected') }}',
            files_selected: '{{ translate('Files selected') }}',
            add_more_files: '{{ translate('Add more files') }}',
            adding_more_files: '{{ translate('Adding more files') }}',
            drop_files_here_paste_or: '{{ translate('Drop files here, paste or') }}',
            browse: '{{ translate('Browse') }}',
            upload_complete: '{{ translate('Upload complete') }}',
            upload_paused: '{{ translate('Upload paused') }}',
            resume_upload: '{{ translate('Resume upload') }}',
            pause_upload: '{{ translate('Pause upload') }}',
            retry_upload: '{{ translate('Retry upload') }}',
            cancel_upload: '{{ translate('Cancel upload') }}',
            uploading: '{{ translate('Uploading') }}',
            processing: '{{ translate('Processing') }}',
            complete: '{{ translate('Complete') }}',
            file: '{{ translate('File') }}',
            files: '{{ translate('Files') }}',
        }
	</script>


</head>
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">

<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        @include('backend.inc.admin_sidenav')
        <div class="wrapper d-flex flex-column flex-row-fluid aiz-content-wrapper" id="kt_wrapper">
            @include('backend.inc.admin_nav')
            <div class="content d-flex flex-column flex-column-fluid aiz-main-content" id="kt_content">
				<div class="px-15px px-lg-25px">
                    @yield('content')
				</div>
			</div><!-- .aiz-main-content -->
            <!--begin::Footer-->
            <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                <!--begin::Container-->
                <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <!--begin::Copyright-->
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted fw-bold me-1">&copy; 2022</span>
                        <a href="#" target="_blank" class="text-gray-800 text-hover-primary">{{ get_setting('site_name') }} v{{ get_setting('current_version') }}</a>
                    </div>
                    <!--end::Copyright-->
                    <!--begin::Menu-->
                    <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                        <li class="menu-item">
                            <a href="#" target="_blank" class="menu-link px-2">About</a>
                        </li>
                        <li class="menu-item">
                            <a href="#" target="_blank" class="menu-link px-2">Support</a>
                        </li>
                        <li class="menu-item">
                            <a href="#" target="_blank" class="menu-link px-2">Purchase</a>
                        </li>
                    </ul>
                    <!--end::Menu-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Footer-->
		</div><!-- .aiz-content-wrapper -->
	</div><!-- .aiz-main-wrapper -->
</div>

    @yield('modal')

    @if(Route::currentRouteName() != 'admin.dashboard')
        <script src="{{ static_asset('assets/backend/js/vendorsS.js') }}" ></script>
        <script src="{{ static_asset('assets/backend/js/aiz-core.js') }}" ></script>
    @endif


    @if(Request::segment(3) == "menus")
        {{-- <script src="{{ static_asset('assets/backend/menus/jquery-ui.js') }}" ></script>
        <script src="{{ static_asset('assets/backend/menus/js1/jquery.mjs.nestedSortable.js') }}"></script> --}}
    @endif

    <!--begin::Global Javascript Bundle(used by all pages)-->
    @if(Request::segment(3) != "menus")
        <script src="{{ static_asset('assets/backend/plugins/global/plugins.bundle.js') }}"></script>
    @endif
    <script src="{{ static_asset('assets/backend/js/scripts.bundle.js') }}"></script>
    <script src="{{ static_asset('assets/backend/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ static_asset('assets/backend/js/custom/apps/ecommerce/catalog/products.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    @if(Route::currentRouteName() == 'admin.dashboard')
        <!--begin::Page Vendors Javascript(used by this page)-->
        <script src="{{ static_asset('assets/backend/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
        <!--end::Page Vendors Javascript-->
        <!--begin::Page Custom Javascript(used by this page)-->
        <script src="{{ static_asset('assets/backend/js/custom/widgets.js') }}"></script>
        <script src="{{ static_asset('assets/backend/js/custom/apps/chat/chat.js') }}"></script>
        <script src="{{ static_asset('assets/backend/js/custom/modals/upgrade-plan.js') }}"></script>
        <script src="{{ static_asset('assets/backend/js/custom/modals/create-app.js') }}"></script>
        <script src="{{ static_asset('assets/backend/js/custom/modals/users-search.js') }}"></script>
        <!--end::Page Custom Javascript-->
    @endif

    @yield('script')

    <script type="text/javascript">
	    // @foreach (session('flash_notification', collect())->toArray() as $message)
	    //     AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
	    // @endforeach

        if ($('#lang-change').length > 0) {
            $('#lang-change .menu-sub-dropdown a').each(function() {
                $(this).on('click', function(e){
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    console.log(locale);
                    $.post('{{ route('language.change') }}',{_token:'{{ csrf_token() }}', locale:locale}, function(data){
                        location.reload();
                    });

                });
            });
        }

        function menuSearch(){
			var filter, item;
			filter = $("#menu-search").val().toUpperCase();
			items = $("#main-menu").find("a");
			items = items.filter(function(i,item){
				if($(item).find(".aiz-side-nav-text")[0].innerText.toUpperCase().indexOf(filter) > -1 && $(item).attr('href') !== '#'){
					return item;
				}
			});

			if(filter !== ''){
				$("#main-menu").addClass('d-none');
				$("#search-menu").html('')
				if(items.length > 0){
					for (i = 0; i < items.length; i++) {
						const text = $(items[i]).find(".aiz-side-nav-text")[0].innerText;
						const link = $(items[i]).attr('href');
						 $("#search-menu").append(`<li class="aiz-side-nav-item"><a href="${link}" class="aiz-side-nav-link"><i class="las la-ellipsis-h aiz-side-nav-icon"></i><span>${text}</span></a></li`);
					}
				}else{
					$("#search-menu").html(`<li class="aiz-side-nav-item"><span	class="text-center text-muted d-block">{{ translate('Nothing Found') }}</span></li>`);
				}
			}else{
				$("#main-menu").removeClass('d-none');
				$("#search-menu").html('')
			}
        }
    </script>

</body>
</html>
