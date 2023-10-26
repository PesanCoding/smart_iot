@push('css_vendor')
    <link rel="stylesheet" href="{{asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush
@extends('layouts.app')
@section('title','Volume Air')
@section('breadcrumb')
    <li class="breadcrumb-item">@yield('title')</li>
    @parent
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="body">
                    <center>
                        <i class="fas fa-faucet fa-10x"></i>
                    </center>
                </div>
                <div class="card-footer">
                    <h6>Jumlah Pemakaian Air Hari ini :</h6>
                    <table class="table">
                        <tr>
                            <td>Volume</td>
                            <td>:</td>
                            <td><span id="deb"></span><sup> mL</sup></td>
                        </tr>
                        <tr>
                            <td>Debit</td>
                            <td>:</td>
                            <td> <span id="vol"></span> <sup>L/min</sup></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <table class="table mont" id="mont">
                            <thead>
                                <tr>
                                    <th>Waktu</th>
                                    <th>Username </th>
                                    <th>Volume <sup><sup>mL</sup></sup></th>
                                    <th>Debit <sup><sup>L/min</sup></sup></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script_vendor')
    <script src="{{asset('template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
@endpush
@push('script')
    <script type="text/javascript">
        var table = $('.mont').DataTable({
        processing: true,
        serverSide: true,
        responsive : true,
        rowGroup:{
            dataSrc: 2
        },
        ajax: "{{ route('volair.index') }}",
        columns: [
            {data: 'waktu', name: 'waktu'},
            {data: 'id_user', name: 'user'},
            {data: 'volume_air', name: 'volume_air'},
            {data: 'debit', name: 'debit'},
        ]
    });
    </script>
    <script>
        var APP_URL = "{{ url('/') }}";
        function GetVol()
        {
            $.ajax({
                type : 'GET',
                url: APP_URL + '/volume',
                dataType: "json",
                success: function (response) {
                    var volume = response.volume
                    var debit = response.debit

                    document.getElementById("vol").innerHTML = volume;
                    document.getElementById("deb").innerHTML = debit;
                 }
            })
        };
        setInterval(function() {
            GetVol();
        }, 1000);
    </script>
@endpush
