<table class="table">
    <thead class="thead-dark">
        <tr>
            {{-- <th scope="col">Info</th> --}}
            <th scope="col">Type</th>
            <th scope="col">Table</th>
            <th scope="col">Time</th>
            <th scope="col">Done By</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">
                <span class="badge badge-inline {{$log->log_type == "edit" ? 'badge-warning' : 'badge-primary' }}">{{$log->log_type}}</span>
            </th>
            <td>{{$log->table_name}}</td>
            <td>{{ $log->dateHumanize }} - {{ $log->log_date }}</td>
            <td>{{ $log->user->name }} - <span class="text_light">{{ $log->user->email }}</span></td>
        </tr>
    </tbody>
</table>


<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
    <thead class="thead-dark">
        <tr>
            {{-- <th scope="col">Info</th> --}}
            <th scope="col">Field</th>
            <th scope="col">Pervious</th>
            <th scope="col">Current</th>
        </tr>
    </thead>
    <hr>
    @php
        $datas = $log->data;
    @endphp
    <tbody>
        @foreach (json_decode($datas,true) as $key => $data)
            @php
                if ($key == "id") {
                    $current_data = DB::table($log->table_name)->where("id",$data)->get();
                    $currents = json_decode($current_data,true);
                }
            @endphp
            <tr>
                <th>{{$key}}</th>
                <td>{{$data}}</td>
                <td>{{$currents[0][$key]}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
