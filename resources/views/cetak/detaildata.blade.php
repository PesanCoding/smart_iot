@extends('layouts.app')
@section('title','Detail Cetak')
@section('breadcrumb')
    <li class="breadcrumb-item active">@yield('title')</li>
    @parent
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
            <div class="card-header">
                <h6>Detail Data</h6>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td>{{$username}}</td>
                    </tr>
                    <tr>
                        <td>Sensor Date</td>
                        <td>:</td>
                        <td>
                            <span class="badge badge-primary">
                                <i>
                                    {{tanggal_indonesia($date)}}
                                </i>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Jumlah data</td>
                        <td>:</td>
                        <td>
                            <span class="badge badge-danger">
                                {{$datacount}}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <center><h6>Rekap Nilai Sensor {{tanggal_indonesia($date)}} </h6></center>
                </div>
                <div class="card-body">
                    <h6>Nilai Rata-rata</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th>Suhu Udara</th>
                            <th>Kelembaban Udara</th>
                            <th>Kelembaban Tanah</th>
                        </tr>
                        <tr>
                            <td>{{$suhu_udara}}</td>
                            <td>{{$kel_udara}}</td>
                            <td>{{$kel_tanah}}</td>
                        </tr>
                    </table>
                    <br>
                     <h6>Nilai Tertinggi</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th>Suhu Udara</th>
                            <th>Kelembaban Udara</th>
                            <th>Kelembaban Tanah</th>
                        </tr>
                        <tr>
                            <td>{{$suhu_udaraMax}}</td>
                            <td>{{$kel_udaraMax}}</td>
                            <td>{{$kel_tanahMax}}</td>
                        </tr>
                    </table>
                     <br>
                     <h6>Nilai Terrendah</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th>Suhu Udara</th>
                            <th>Kelembaban Udara</th>
                            <th>Kelembaban Tanah</th>
                        </tr>
                        <tr>
                            <td>{{$suhu_udaraMin}}</td>
                            <td>{{$kel_udaraMin}}</td>
                            <td>{{$kel_tanahMin}}</td>
                        </tr>
                    </table>
                    <h6>Data terakhir</h6>
                    <table class="table">
                        <tr>
                            <th>Waktu</th>
                            <th>Suhu Udara</th>
                            <th>Kelembaban Udara</th>
                            <th>Kelembaban Tanah</th>
                            <th>Status</th>
                        </tr>
                        @foreach ($dataterakhir as $item )
                            <tr>
                                <td>{{$item->waktu}}</td>
                                <td>{{$item->suhu_udara}}</td>
                                <td>{{$item->kel_udara}}</td>
                                <td>{{$item->kel_tanah}}</td>
                                <td>
                                    @if ($item->kel_tanah <= 40.00)
                                        <span class="btn btn-sm btn-primary disable">
                                            Lembab
                                        </span>
                                    @elseif ($item->kel_tanah >= 80.01)
                                        <span class="btn btn-sm btn-warning disable">
                                            Kering
                                        </span>
                                    @else
                                    <span class="btn btn-sm btn-info disable">
                                        Basah
                                    </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
