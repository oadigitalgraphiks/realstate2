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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Sliders</h1>
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
                    <li class="breadcrumb-item text-muted">Website Setup</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Slider Edit</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="col-lg-8 mx-auto">
                <div class="card card-flush">
                    <ul class="nav nav-tabs nav-fill border-light">
                        @foreach (\App\Models\Language::all() as $key => $language)
                            <li class="nav-item">
                                <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('slider.edit', ['id'=>$slider->id, 'lang'=> $language->code] ) }}">
                                    <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
                                    <span>{{ $language->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="col text-md-left">
                            <h5 class="mb-md-0 h6">{{translate('Slider Information')}}</h5>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <form class="p-4" action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PATCH">
                            <input type="hidden" name="lang" value="{{ $lang }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-from-label" for="name">{{translate('Title1')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
                                <div class="col-sm-9 mb-2">
                                    <textarea type="text" placeholder="{{translate('Title1')}}" id="title1" name="title1" class="form-control"   autofocus>{{ $slider->getTranslation('title1', $lang) }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row d-none">
                                <label class="col-sm-3 col-from-label" for="name">{{translate('Title2')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
                                <div class="col-sm-9 mb-2">
                                    <input type="text" placeholder="{{translate('Title2')}}" id="title2" name="title2" value="{{ $slider->getTranslation('title2', $lang) }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row" {{$lang == 'en' ? '':'hidden'}}>
                                <label class="col-sm-3 col-from-label" for="name">{{translate('Sorting')}} </label>
                                <div class="col-sm-9 mb-2">
                                    <input type="text" placeholder="{{translate('Sorting')}}" id="sorting_id" name="sorting_id" value="{{ $slider->sorting_id}}" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group row d-none">
                                <label class="col-sm-3 col-from-label" for="name">{{translate('Button Text')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
                                <div class="col-sm-9 mb-2">
                                    <input type="text" placeholder="{{translate('Button Text')}}" id="button_text" name="button_text" value="{{ $slider->getTranslation('button_text', $lang) }}" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group row d-none">
                                <label class="col-sm-3 col-from-label" for="name">{{translate('Link With')}}</label>
                                <div class="col-sm-9 mb-2">
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Select an option" id="type" name="type" data-live-search="true">
                                        <option value="category" {{$slider->type == 'category' ? 'selected' : ''}}>{{translate('Categories')}}</option>
                                        <option value="brand" {{$slider->type == 'brand' ? 'selected' : ''}}>{{translate('Brands')}}</option>
                                        <option value="custom" {{$slider->type == 'custom' ? 'selected' : ''}}>{{translate('Custom')}}</option>
                                    </select>
                                </div>
                            </div>
                            {{-- category --}}
                            <div class="form-group row d-none" id="category_row" style="{{$slider->type != 'category' ? 'display:none;' : '' }}">
                                <label class="col-md-3 col-form-label">{{translate('Select Category')}}</label>
                                <div class="col-md-9">
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Select an option" id="category_id" name="category_id" data-live-search="true" >
                                        <option value="">{{ translate('No Parent') }}</option>
                                    @foreach ($categories as $acategory)
                                        <option value="{{ $acategory->id }}" {{$slider->category_id == $acategory->id ? 'selected' : ''}}>{{ $acategory->getTranslation('name') }}</option>
                                        @foreach ($acategory->childrenCategories as $childCategory)
                                            @include('slider.child_categories', ['child_category' => $childCategory , 'lang' => $lang ,'catgeory_id' => $slider->category_id])
                                        @endforeach
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- brand --}}
                            <div class="form-group row" id="brand_row" style="{{$slider->type != 'brand' ? 'display:none;' : '' }}">
                                <label class="col-md-3 col-form-label">{{translate('Select Brand')}}</label>
                                <div class="col-md-9">
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Select an option" id="brand_id" name="brand_id" data-live-search="true" >
                                        <option value="">{{ translate('Select Brand') }}</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" {{$slider->brand_id == $brand->id ? 'selected' : ''}}>{{ $brand->getTranslation('name') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- custom link --}}
                            <div class="form-group row" id="custom_row" style="{{$slider->type != 'custom' ? 'display:none;' : '' }}" >
                                <label class="col-md-3 col-form-label">{{translate('URL')}}</label>
                                <div class="col-md-9 mb-2">
                                <input type="text" name="link" value="{{ $slider->link }}" class="form-control" id="name" placeholder="{{translate('URL')}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" >{{translate('Photo')}} <small>({{env('SLIDER_IMAGE_WIDTH')}}x{{env('SLIDER_IMAGE_HEIGHT')}})</small></label>
                                <div class="col-md-9 mb-3">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                        <input type="hidden" name="photo" value="{{$slider->getTranslation('photo',$lang)}}" class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" >{{translate('Mobile Photo')}} <small>({{env('MOBILE_SILDER_IMAGE_WIDTH')}}x{{env('MOBILE_SILDER_IMAGE_HEIGHT')}})</small></label>
                                <div class="col-md-9 mb-3">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                        <input type="hidden" name="mobile_photo" value="{{$slider->getTranslation('mobile_photo',$lang)}}" class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-primary">{{translate('Update')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#type').on('change', function() {
 //alert();
        if($('#type').val()=='category'){
			$('#category_row').css('display', 'flex');
			$('#brand_row').css('display', 'none');
			$('#custom_row').css('display', 'none');
		}else if($('#type').val()=='brand'){
			$('#category_row').css('display', 'none');
			$('#brand_row').css('display', 'flex');
			$('#custom_row').css('display', 'none');
		}else if($('#type').val()=='custom'){
			$('#category_row').css('display', 'none');
			$('#brand_row').css('display', 'none');
			$('#custom_row').css('display', 'flex');
		}
            AIZ.plugins.bootstrapSelect('refresh');
    });
    </script>
@endsection
