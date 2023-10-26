
@extends('layouts.app')
@section('title','Monitoring')
@section('breadcrumb')
    <li class="breadcrumb-item active">@yield('title')</li>
    @parent
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Monitoring Sensor</h4>
                <div class="col-lg-4 mt-2">
                    {!! Form::label('Id_Device','Pilih ID_Device') !!}
                    {!! Form::select('id_device', $Device, null, array('id' => 'devices','class' => 'custom-select')) !!}
                </div>
            <div class="card-body">

                <div class="col-lg-12 mb-3">
                    <table class="table table-striped">
                       <thead>
                            <tr>
                                <td>Waktu</td>
                                <td>Suhu Udara</td>
                                <td>Kelembaban Udara</td>
                                <td>Kelembaban Tanah</td>
                            </tr>
                       </thead>
                       <tbody id="data_id">
                            @php
                                $no = 0
                            @endphp
                            @foreach ($data as $item )
                            @php
                                $no++;
                            @endphp
                                <tr>
                                    <td>{{$item->waktu}}</td>
                                    <td>{{$item->suhu_udara}}</td>
                                    <td>{{$item->kel_udara}}</td>
                                    <td>{{$item->kel_tanah}}</td>
                                </tr>
                            @endforeach
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#devices').on('change',function(e){
                var id = e.target.value;
                $.get('{{url('id_devices')}}/'+id, function(data){
                    console.log(id);
                    console.log(data);
                $('#data_id').empty();
                $.each(data, function(index, element) {
                    $('#data_id').append("<tr><td>"+element.waktu+"</td><td>"+element.suhu_udara+"</td><td>"+element.kel_udara+"</td><td>"+element.kel_tanah+"</td></tr>")
                    });
                });
            });
        });
    </script>
@endpush

