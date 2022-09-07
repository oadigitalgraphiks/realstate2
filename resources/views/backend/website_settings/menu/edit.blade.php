<style>
form input[type="text"], form input[type="email"], form input[type="password"], form select, form textarea {
    border: 1px solid #ddd;
    padding: 5px 15px;
}
</style>
<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-body p-0">
               	<ul class="nav nav-tabs nav-fill border-light">
					@if(empty($lang))
					    @php $lang='en'; @endphp
                    @endif
                    @foreach (\App\Models\Language::all() as $key => $language)
                    <li class="nav-item">
                        <a href="javascript:;" data-lang-code="{{$language->code}}" data-id="{{$menu->id}}" class="change nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"  >
                            <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
                            <span>{{$language->name}}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
                <form class="p-4" action="{{ route('menu.update') }}" method="POST" enctype="multipart/form-data">
                	@csrf
                    <input type="hidden" name="lang" value="@if(!empty($lang)){{ $lang }}@else {{'en'}}@endif">
					<input type="hidden" name="id" value="{{ $menu->id }}"  required>
					<input type="hidden" name="main_menu_id" value="{{ $menu->menu_id }}"  required>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Name')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
                        <div class="col-md-9">
                            <input type="text" name="name" value="{{ $menu->getTranslation('name', $lang) }}" class="form-control" id="name" placeholder="{{translate('Name')}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Link With')}}</label>
                        <div class="col-md-9">
                            <select class="form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Select an option" id="type" name="type" required>
                                <option value="category" @if ($menu->type == 'category') selected @endif>{{translate('Categories')}}</option>
                                <option value="brand" @if ($menu->type == 'brand') selected @endif>{{translate('Brands')}}</option>
								 <option value="custom" @if ($menu->type == 'custom') selected @endif>{{translate('Custom')}}</option>
                            </select>
                        </div>
                    </div>


					<div class="form-group row" id="category_row" @if ($menu->type != 'category') style="display:none;" @endif>
                        <label class="col-md-3 col-form-label">{{translate('Select Category')}}</label>
                        <div class="col-md-9">
                            <select class="form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Select an option" id="category_id" name="category_id" data-live-search="true" data-selected="{{ $menu->category_id }}">
                                <option value="">{{ translate('Select Category') }}</option>
								@foreach ($categories as $acategory)
                                    <option value="{{ $acategory->id }}">{{ $acategory->getTranslation('name',$lang) }}</option>
                                    @foreach ($acategory->childrenCategories as $childCategory)
                                        @include('categories.child_category', ['child_category' => $childCategory , 'lang' => $lang])
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>

					<div class="form-group row" id="brand_row" @if ($menu->type != 'brand') style="display:none;" @endif>
                        <label class="col-md-3 col-form-label">{{translate('Select Brand')}}</label>
                        <div class="col-md-9">
                            <select class="form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Select an option" id="brand_id" name="brand_id" data-live-search="true" data-selected="{{ $menu->brand_id }}">
                                <option value="">{{ translate('Select Brand') }}</option>
								@foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->getTranslation('name',$lang) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


					<div class="form-group row" id="custom_row" @if ($menu->type != 'custom') style="display:none;" @endif>
                        <label class="col-md-3 col-form-label">{{translate('URL')}}</label>
                        <div class="col-md-9">
                          <input type="text" name="url" value="{{ $menu->url }}" class="form-control" id="name" placeholder="{{translate('URL')}}"  >
                        </div>
                    </div>


					@if ($menu->parent_id == 0)
                    <div class="fv-row mt-5 mb-2">
                        <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5">
                            <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">{{translate('Mega Menu')}}</span>
                            <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                <input class="form-check-input" type="checkbox" name="menu_type" value="1" @if($menu->menu_type == '1') checked @endif>
                            </span>
                        </label>
                    </div>
					@endif
                    <div class="fv-row mt-5 mb-2">
                        <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5">
                            <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">{{translate('Open in a new tab')}}</span>
                            <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                <input class="form-check-input" type="checkbox" name="target" value="_blank" @if($menu->target == '_blank') checked @endif>
                            </span>
                        </label>
                    </div>
                    <div class="fv-row mt-5 mb-2">
                        <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5">
                            <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">{{translate('Hide')}}</span>
                            <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                <input class="form-check-input" type="checkbox" name="status" value="1" @if($menu->status == '1') checked @endif>
                            </span>
                        </label>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{translate('Update')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function (){
	AIZ.plugins.bootstrapSelect('refresh');


//	menu_modal_edit
	$('.change').click(function(event) {
	//alert();
	 var menu_id=$(this).data('id');
	 var lang_code=$(this).data('lang-code');
	 edit_menu_modal2(menu_id,lang_code);
	  });

	function edit_menu_modal2(id,lang_code){
	csrf=$('[name=_token]').val();
	//alert();
            $.post( '{{ route("menu.changge.lang")  }}' ,{_token:csrf, id:id ,lang:lang_code}, function(data){
                $('#menu_modal_edit .modal-content').html(data);
                $('#menu_modal_edit').modal('show', {backdrop: 'static'});
            });
        }

});


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
