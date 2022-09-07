@extends('frontend.layouts.app')
@section('content')
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>{{translate("Home")}}</a>
                <span></span> {{translate("My Account")}}
            </div>
        </div>
    </div>
    <div class="page-content pt-30 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-md-3">
                            @include('frontend.inc.user_side_nav')
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">
                                @yield('panel_content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
{{-- <section class="py-5">
    <div class="container">
        <div class="d-flex align-items-start">
			@include('frontend.inc.user_side_nav')
			<div class="aiz-user-panel">
				@yield('panel_content')
            </div>
        </div>
    </div>
</section> --}}
@endsection
