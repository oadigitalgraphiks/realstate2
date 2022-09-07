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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Contact Page</h1>
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
                    <li class="breadcrumb-item text-muted">Website Setup</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Contact Page Edit</li>
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
            <div class="col-xl-10 mx-auto">
                <h2 class="fw-600">{{ translate('Contact Edit') }}</h2>
                <div class="card card-flush mt-10 mb-10">

                    {{-- About --}}
                    <div class="card mt-5">
                        <div class="card-header">
                            <h6 class="mb-0">{{ translate('Headings') }}</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="home-about-target">
                                        <div class="row gutters-5 mt-5">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="contact_heading">
                                                    <input type="text" class="form-control" placeholder="First Heading" name="contact_heading" value="{{ get_setting('contact_heading', null, $lang) ?? "" }}">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="contact_second_heading">
                                                    <input type="text" class="form-control" placeholder="Second Heading" name="contact_second_heading" value="{{ get_setting('contact_second_heading', null, $lang) ?? "" }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="home-about-target">
                                        <div class="row gutters-5 mt-5">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group mb-5">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="contact_address_heading_one">
                                                    <input type="text" class="form-control" placeholder="Address Heading" name="contact_address_heading_one" value="{{ get_setting('contact_address_heading_one', null, $lang) ?? "" }}">
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="contact_address_one">
                                                    <textarea class="aiz-text-editor" data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
                                                    name="contact_address_one" placeholder="Address One" data-min-height="150">{{ get_setting('contact_address_one',null,$lang) }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-12 mt-5">
                                                <div class="form-group mb-5">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="contact_address_heading_second">
                                                    <input type="text" class="form-control" placeholder="Address Heading Second" name="contact_address_heading_second" value="{{ get_setting('contact_address_heading_second', null, $lang) ?? "" }}">
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="contact_address_second">
                                                    <textarea class="aiz-text-editor" data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
                                                    name="contact_address_second" placeholder="Address Second" data-min-height="150">{{ get_setting('contact_address_second',null,$lang) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="home-about-target">
                                        <div class="row gutters-5 mt-5">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group mb-5">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="contact_form_heading">
                                                    <input type="text" class="form-control" placeholder="Heading" name="contact_form_heading" value="{{ get_setting('contact_form_heading', null, $lang) ?? "" }}">
                                                </div>
                                                <div class="form-group mb-5">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="contact_form_second_heading">
                                                    <input type="text" class="form-control" placeholder="Heading" name="contact_form_second_heading" value="{{ get_setting('contact_form_second_heading', null, $lang) ?? "" }}">
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" name="types[][{{ $lang }}]" value="contact_form">
                                                    <textarea class="aiz-text-editor" data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
                                                    name="contact_form" placeholder="" data-min-height="150">{{ get_setting('contact_form',null,$lang) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-5">
                                    <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
    <script type="text/javascript">
		$(document).ready(function(){
			$('.js-data-example-ajax').select2();

			$("#homecategories").on("click",function(){
				$('.js-data-example-ajax').select2();
			});
		    AIZ.plugins.bootstrapSelect('refresh');
		});
        function infocontent() {
            $('.home-about-target').append($('#homeabout').html());
            AIZ.plugins.textEditor();
        }
    </script>
@endsection
<script id="homeabout" type="text/template">
    <div class="row gutters-5 mt-5">
        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group" data-toggle="aizuploader" data-type="image">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}<b>(1000 x 750)</b></div>
                    </div>

                    <input type="hidden" name="types[]" value="home_about_images">
                    <input type="hidden" name="home_about_images[]" class="selected-files">
                </div>
                <div class="file-preview box sm">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group" data-toggle="aizuploader" data-type="image">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Gif Browse')}}<b>(400 x 400)</b></div>
                    </div>
                    <input type="hidden" name="types[]" value="home_about_gif">
                    <input type="hidden" name="home_about_gif[]" class="selected-files">
                </div>
                <div class="file-preview box sm">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="hidden" name="types[][{{ $lang }}]" value="home_about_heading">
                <input type="text" class="form-control" placeholder="Text" name="home_about_heading[]">
            </div>
        </div>
        <div class="col-md-auto">
            <div class="form-group">
                <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-light-danger" data-toggle="remove-parent" data-parent=".row">
                    <i class="las la-times"></i>
                </button>
            </div>
        </div>
        <div class="col-md mt-5">
            <div class="form-group">
                <input type="hidden" name="types[][{{ $lang }}]" value="home_about_description">
                <textarea class="aiz-text-editor" data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
                name="home_about_description[]" placeholder="Description" data-min-height="150">

                </textarea>
            </div>
        </div>

    </div>
</script>
