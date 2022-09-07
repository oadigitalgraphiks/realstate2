@extends('frontend.layouts.user_panel')

@section('panel_content')
<div class="col-12">
    <div class="card">
        <div class="row">
            <div class="col-md-12 mb-10 mt-10 ml-10">
                <button type="button" data-bs-toggle="modal" data-bs-target="#addAddress" onclick="add_new_address()" class="btn btn-fill-out font-weight-bold" name="button" value="Submit">
                    <i class="fi-rs-plus mr-10"></i>{{translate('Add Address')}}</button>
            </div>
        </div>
            <div class="row ml-10">
                @foreach (Auth::user()->addresses as $key => $address)
                    <div class="col-lg-6 col-md-6 mb-10">
                        <div class="card mb-3 mb-lg-0">
                            <div class="card-header">
                                <h3 class="mb-0">{{ucfirst($address->type)}}</h3>
                            </div>
                            <div class="card-body">
                                <div>
                                    <span class="w-50 fw-600">{{ translate('Address') }}:</span>
                                    <span class="ml-2">{{ $address->address }}</span>
                                </div>
                                <div>
                                    <span class="w-50 fw-600">{{ translate('Postal Code') }}:</span>
                                    <span class="ml-2">{{ $address->postal_code }}</span>
                                </div>
                                <div>
                                    <span class="w-50 fw-600">{{ translate('City') }}:</span>
                                    <span class="ml-2">{{ optional($address->city)->name }}</span>
                                </div>
                                <div>
                                    <span class="w-50 fw-600">{{ translate('State') }}:</span>
                                    <span class="ml-2">{{ optional($address->state)->name }}</span>
                                </div>
                                <div>
                                    <span class="w-50 fw-600">{{ translate('Country') }}:</span>
                                    <span class="ml-2">{{ optional($address->country)->name }}</span>
                                </div>
                                <div>
                                    <span class="w-50 fw-600">{{ translate('Phone') }}:</span>
                                    <span class="ml-2">{{ $address->phone }}</span>
                                </div>
                                <a data-bs-toggle="modal" class="btn-small"
                                    data-bs-target="#editAddress" onclick="edit_address('{{$address->id}}')">{{translate('Edit')}}</a>
                                <a class="btn-small ml-10" href="{{ route('addresses.destroy', $address->id) }}">{{translate('Delete')}}</a>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
    </div>
</div>
@endsection

@section('modal')
    @include('frontend.partials.address_modal')
@endsection

@section('script')
<script>
        function edit_address(address) {
            var url = '{{ route('addresses.edit', ':id') }}';
            url = url.replace(':id', address);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#edit_modal_body').html(response.html);
                    $('#edit-address-modal').modal('show');
                    AIZ.plugins.bootstrapSelect('refresh');

                    @if (get_setting('google_map') == 1)
                        var lat = -33.8688;
                        var long = 151.2195;

                        if(response.data.address_data.latitude && response.data.address_data.longitude) {
                        lat = response.data.address_data.latitude;
                        long = response.data.address_data.longitude;
                        }

                        initialize(lat, long, 'edit_');
                    @endif
                }
            });
        }
</script>
@endsection
