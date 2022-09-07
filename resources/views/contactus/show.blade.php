<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-center text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-75px">{{ translate('Name') }}</th>
            <th class="min-w-75px">{{ translate('Email') }}</th>
            <th class="min-w-75px">{{ translate('Phone') }}</th>
            <th class="min-w-75px">{{ translate('Subject') }}</th>
        </tr>
        <!--end::Table row-->
    </thead>
    <!--end::Table head-->
    <!--begin::Table body-->
    <tbody class="fw-bold">
        <tr class="text-center">
            <td> {{$contacts->name}} </td>
            <td>
                <a href="mailto:{{$contacts->email}}" class="text-hover-primary fs-5">
                    {{$contacts->email}}
                </a>
             </td>
            <td>
                <a href="tel:{{$contacts->phone}}" class="text-hover-primary fs-5">
                 {{$contacts->phone}}
                </a>
            </td>
            <td> {{$contacts->subject}} </td>
            <tr class="text-center">
                <th colspan="4">
                    {{translate("Message")}}
                </th>
            </tr>
            <tr class="text-center">
                <td colspan="4">
                    <div class="card">
                        <div class="card-body">
                            {{$contacts->message}}
                        </div>
                    </div>
                </td>
            </tr>
        </tr>
        <!--begin::Table row-->
    </tbody>
</table>
