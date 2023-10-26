@extends('layouts.app')
@section('title','Dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
    @parent
@endsection
@section('content')
@if ($ok == 0)
<div class="col-lg-12">
    <div class="alert alert-dark alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="fas fa-bullhorn"></i> Alert!</h5>
        <strong>Peingatan ! </strong>Device Belum <strong> Active</strong>
        Silahkan hubungi admin untuk aktivasi </br>
    </div>
</div>
@else
    <div class="row">
        <div class="col-lg-12">
        <div id="peringatan" class="alert alert-danger  alert-dismissible" style="display: none;">
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Peringatan ! Alat tidak berfungsi/dalam keadaan mati, segera periksa
                dan pastikan alat kembali berfungsi dengan
                baik. Data terakhir masuk pada <b><span id="time"></span></b>
        </div>
        </div>
    </div>
    <div id="kontent_data" style="display: block;">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <span id="container"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Device info
                </div>
                <div class="card-body">
                    <table class="table">
                        @foreach ($data as $item )
                            <tr>
                                <td>ID Device</td>
                                <td>:</td>
                                <td><span class="btn btn-sm btn-success">{{$item->user->id_device}}</span></td>
                            </tr>
                            <tr>
                                <td>Nama device</td>
                                <td>:</td>
                                <td>{{$item->nama_devices}}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Controller</td>
                                <td>:</td>
                                <td><span class="badge badge-danger">2</span></td>
                            </tr>
                            <tr>
                                <td>Status device</td>
                                <td>:</td>
                                <td>
                                    @if ($item->publish == 1)
                                        <span class="badge badge-primary">
                                            Aktif
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="card-body" id="bg-ph">
                    <h4 class="text-white"><span  id="text-level1"></span></h4>
                </div>
                <div class="card-body" id="bg-suhu">
                    <h4 class="text-white"><span  id="text-level"></span></h4>
                </div>
                <div class="card-footer">
                    <table>
                        <tr>
                            <th><h3 id="ph_1"></h3></th>
                            <th> C<sup>o</sup></th>
                        </tr>
                        <tr>
                            <th><h3 id="teg"></h3></th>
                            <th colspan="2"><sup> %</sup></th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
    </div>
@endif
@endsection
@push('script')
    <script src="{{asset('template/js/highcharts.js')}}"></script>
    <script src="{{asset('template/js/highcharts-more.js')}}"></script>

    <script>
        var APP_URL = "{{ url('/') }}";

            let chartT = new Highcharts.Chart({
                chart: {
                    renderTo: 'container',
                    type: 'spline'
                },
                title: {
                    text: 'Grafik Sensor'

                },
                series: [
                    {
                        name: 'Temperature',
                        color: '#00008B',
                        data: []
                    },
                ],
                yAxis: {
                    title: {
                        text: 'Data Sensor'
                    },
                },
                xAxis:{
                    type: 'datetime',
                    tickPixelInterval: 150
                },
                plotOptions: {
                    series: {
                        marker: {
                            enabled: false
                        },
                    }
                },
                credits: {
                    enabled: false
                },
            });
        function AllData(){
            Highcharts.setOptions({
                global:{
                    useUTC : false
                }
            });
            $.ajax({
                type: 'GET',
                url: APP_URL + '/ph',
                dataType: "json",
                success: function (response) {
                    var ph = response.sensor.suhu_udara
                    var teg = response.sensor.kel_tanah
                    var z = (new Date()).getTime()
                    if (chartT.series[0].data.length > 30) {
                    chartT.series[0].addPoint([z,  parseFloat(response.sensor.kel_tanah)], true, true,
                        true);
                    } else {
                        chartT.series[0].addPoint([z, parseFloat(response.sensor.kel_tanah)], true, false,
                        true);
                    }

                   if (response.sensor.kel_tanah > 40.00 && response.sensor.kel_tanah <= 60.00) {
                    $('.ph').addClass('text-danger').removeClass('text-success text-danger text-primary text-warning');
                    $('#bg-ph').addClass('info-box-icon bg-danger elevation-1').removeClass(
                        'bg-warning bg-primary bg-success');
                    $('#text-level1').html('Lembab');

                } else if (response.sensor.kel_tanah >= 80.01) {
                    $('.ph').addClass('text-danger').removeClass('text-success text-warning');
                    $('#bg-ph').addClass('info-box-icon bg-success elevation-1').removeClass(
                        'bg-danger bg-primary bg-c-warning');
                    $('#text-level1').html('Kering');
                }

                else {
                    $('.ph').addClass('text-success').removeClass('text-danger text-warning');

                    $('#bg-ph').addClass('info-box-icon bg-primary elevation-1').removeClass(
                        'bg-danger bg-success bg-warning');

                    $('#text-level1').html('Basah');

                }



                if (response.sensor.kel_udara > 40.00 && response.sensor.kel_udara <= 60.00) {
                    $('.ph').addClass('text-danger').removeClass('text-success text-danger text-primary text-warning');
                    $('#bg-suhu').addClass('info-box-icon bg-danger elevation-1').removeClass(
                        'bg-warning bg-primary bg-success');
                    $('#text-level').html('Lembab');

                } else if (response.sensor.kel_udara >= 80.01) {
                    $('.ph').addClass('text-danger').removeClass('text-success text-warning');
                    $('#bg-suhu').addClass('info-box-icon bg-danger  elevation-1').removeClass(
                        'bg-success  bg-primary bg-c-warning');
                    $('#text-level').html('Panas');
                }

                else {
                    $('.ph').addClass('text-success').removeClass('text-danger text-warning');

                    $('#bg-suhu').addClass('info-box-icon bg-primary elevation-1').removeClass(
                        'bg-danger bg-success bg-warning');

                    $('#text-level').html('Dingin');

                }
                document.getElementById("ph_1").innerHTML = ph;
                document.getElementById("teg").innerHTML = teg;
                }
            })
        };
        setInterval(function(){
            AllData();
        },1000)

    </script>
    {{-- <script src="{{asset('template/js/waktu-peringatan.js')}}"></script> --}}

@endpush
