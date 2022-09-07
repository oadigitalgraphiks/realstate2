@extends('backend.layouts.app')

@section('content')
    @if ($errors->any())

        <div class="alert alert-danger">
            <p><strong>Opps Something went wrong</strong></p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="row">
        <div class="col-lg-7 mx-auto">
            <div class="card card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <h5 class="mb-0 h6">{{ translate('Install/Update Themes') }}</h5>
                </div>
                <form class="form-horizontal" action="{{ route('themes.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        {{-- <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="purchase_code">{{ translate('Purchase code')}}</label>
                        <div class="col-sm-9">
                            <input type="text" id="purchase_code" name="purchase_code" class="form-control" autocomplete="off" required>
                        </div>
                    </div> --}}
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="name">{{ translate('Theme Name') }}</label>
                            <div class="col-sm-9 mb-2">
                                <input type="text" id="theme_name" name="name" class="form-control" autocomplete="off" required>
                            </div>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <!--begin::Input group-->
                        <div class="row mb-2">
                            <label class="form-label">{{ translate('Theme File') }}</label>
                            <!--begin::Dropzone-->
                            <input type="file" name="theme_zip" class="selected-files">
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Install/Update') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')


<script>

$('form').bind('submit', function(e) {
            // Disable the submit button while evaluating if the form should be submitted
            // $("button[type='submit']").prop('disabled', true);
            $("button[type='submit']").hide();

            var valid = true;

            if (!valid) {
                e.preventDefault();

                // Reactivate the button if the form was not submitted
                // $("button[type='submit']").button.prop('disabled', false);
                $("button[type='submit']").show();
            }
        });

</script>

@endsection
