@extends('layouts.app')
@section('title','Dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
    @parent
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$users}}</h3>
                <p>User</p>
            </div>
            <div class="icon">
                <i class="ion ion-users"></i>
            </div>
            <a href="{{route('user.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$device}}<sup style="font-size: 20px"></sup></h3>

                <p>Devices</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('devices.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-6 col-6">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <div class="timeline">
                <!-- timeline time label -->
                <div class="time-label">
                    <span class="bg-red">{{now()->format('Y-m-d')}}</span>
                </div>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                @foreach ($listnotifikasi as $key => $notifikasi )
                    @foreach ($notifikasi as $item )
                        <div>
                            <i class="fas
                                @switch($key)
                                    @case('user') fa-user bg-success @break
                                    @case('devices') fa-user bg-dark @break
                                @endswitch
                            "></i>
                            <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> {{ now()->parse($item->created_at)->diffForHumans() }}</span>
                            <h3 class="timeline-header"><a  href="{{route("$key.index")}}">{{ $item->name ?? $item->email ?? $item->user->name ?? "" }} </a>{{ $key }} baru</h3>
                            </div>
                        </div>
                    @endforeach
                @endforeach
                {{-- <div>
                    <i class="fas fa-envelope bg-blue"></i>
                    <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                    </div>
                </div>
                <div>
                    <i class="fas fa-user bg-green"></i>
                    <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                    <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                    </div>
                </div> --}}
                </div>
            </div>
        </div>
        <!-- ./col -->
        </div>
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
                    var ph = response.sensor.ph
                    var z = (new Date()).getTime()
                    if (chartT.series[0].data.length > 30) {
                    chartT.series[0].addPoint([z,  parseFloat(response.sensor.temp)], true, true,
                        true);
                    } else {
                        chartT.series[0].addPoint([z, parseFloat(response.sensor.temp)], true, false,
                        true);
                    }

                   if (response.sensor.ph > 0 && response.sensor.ph <= 6) {
                    $('.ph').addClass('text-danger').removeClass('text-success text-danger text-primary text-warning');
                    $('#bg-ph').addClass('info-box-icon bg-danger elevation-1').removeClass(
                        'bg-warning bg-primary bg-success');
                    $('#text-level1').html('Acid');

                } else if (response.sensor.ph == 7) {
                    $('.ph').addClass('text-danger').removeClass('text-success text-warning');
                    $('#bg-ph').addClass('info-box-icon bg-success elevation-1').removeClass(
                        'bg-danger bg-primary bg-c-warning');
                    $('#text-level1').html('Natural');
                }

                else {
                    $('.ph').addClass('text-success').removeClass('text-danger text-warning');

                    $('#bg-ph').addClass('info-box-icon bg-primary elevation-1').removeClass(
                        'bg-danger bg-success bg-warning');

                    $('#text-level1').html('Alkaline');

                }
                document.getElementById("ph_1").innerHTML = ph;
                }
            })
        };
        setInterval(function(){
            AllData();
        },1000)

    </script>
    {{-- <script src="{{asset('template/js/waktu-peringatan.js')}}"></script> --}}

@endpush
