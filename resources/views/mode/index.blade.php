@push('css')
 <link rel="stylesheet" href="{{asset('template/css/button.css')}}">
@endpush
@extends('layouts.app')
@section('title','Mode')
@section('breadcrumb')
<li class="breadcrumb-item active">@yield('title')</li>
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
        @foreach ($data as $item )
            <div class="col-lg-4">
            <div class="card">
                <div class="card-header"><h4>Mode Device</h4></div>
                <div class="card-body">
                    <h5>Nama : {{$item->nama_devices}}</h5>
                    <p> <strong>Mode</strong> : <span class="badge badge-succcess">Manual</span></p>
                    <input type="checkbox" data-id="{{$item->id}}" data-toggle="toggle" data-on="Manual" data-off="Automatis"
                    data-onstyle="success" class="toggle-class" data-offstyle="danger" {{$item->mode ? 'checked' : ''}}>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
@push('script_vendor')
    <script src="{{asset('template/js/button.js')}}"></script>
    <script>

        $(function(){
            $('.toggle-class').change(function () {
                var mode = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: '/changeStatus',
                    data: {
                            'mode' : mode,
                            'id' : id
                            },
                    dataType: "json",
                });
            })
        });

    </script>
@endpush
