<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-center">
            <th colspan="5">
                <h3>{{$histories[0]->product->name}}  {{$histories[0]->variant}}</h3>
            </th>
        </tr>
        <tr class="text-center text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-75px">{{ translate('Tracking') }}#</th>
            <th class="text-center min-w-75px">{{ translate('Unit Price') }}</th>
            <th class="text-center min-w-175px">{{ translate('Receive Quantity') }}</th>
            <th class="text-center min-w-175px">{{ translate('Purchase Quantity') }}</th>
            <th class="text-center min-w-175px">{{ translate('Purchase Date') }}</th>
        </tr>
        <!--end::Table row-->
    </thead>
    <!--end::Table head-->
    <!--begin::Table body-->
    <tbody class="fw-bold text-gray-600 text-center">

        @foreach ($histories as $history)
            <tr>
                <td>
                    {{$history->tracking_number}}
                </td>
                <td>
                    {{$history->purchase_price}}
                </td>
                <td>
                    {{$history->receive_qty}}
                </td>
                <td>
                    {{$history->total_quantity}}
                </td>
                <td>
                    {{$history->created_at->format("Y-m-d")}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
