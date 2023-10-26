@push('css')
 <link rel="stylesheet" href="{{asset('template/css/button.css')}}">
@endpush
@push('css_vendor')
    <link rel="stylesheet" href="{{asset('template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/plugins/toastr/toastr.min.css')}}">
@endpush
@extends('layouts.app')
@section('title','Control')
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
    <div class="row mb-3">
        <div class="col-lg-12">
            @if ($controlCount < 2)
                <a href="javascript:void(0)" id="btn-create-control" class="btn btn-sm btn-success mb-3">Create Control</a>
            @endif
        </div>
    </div>
    <div class="row">
        @if ($status == 0)
        <div class="col-lg-12">
            <div class="alert alert-dark alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="fas fa-bullhorn"></i> Alert!</h5>
                <strong>Peingatan !</strong> Alat dalam Mode<strong> Otomatis</strong>
                Silahkan ubah terlebih dahulu mode device</br> <a href="{{route('mode.index')}}" class="btn btn-success">Manual</a>
            </div>
        </div>
        @else
        @foreach ($data as $item )
        <div class="col-lg-4">
        <div class="card">
                <div class="card-header">
                    <h4>{{$item->nama_device}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="checkbox" data-id="{{$item->id}}" data-toggle="toggle" data-on="On" data-off="Off"
                            data-onstyle="success" class="toggle-class" data-offstyle="danger" {{$item->state ? 'checked' : ''}}>
                        </div>
                        <div class="col-lg-6">
                            <i class="fas fa-plug fa-4x icon-lampu"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    <div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Controller</label>
                        <input type="text" class="form-control" id="nama_device">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama_device-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="">PIN MODULE</label>
                        <input type="text" class="form-control" id="gpio">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-gpio-edit"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">TUTUP</button>
                    <button type="button" class="btn btn-success" id="store">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
@push('script_vendor')
    <script src="{{asset('template/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('template/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('template/js/button.js')}}"></script>
    <script>
        $(function(){
            $('.toggle-class').change(function () {
                var state = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: '/changeState',
                    data: {'state' : state, 'id' : id},

                });
                        console.log(status);
                // console.log(id,status);
                // if (id == '1') {
                //     $('.icon-lampu').addClass('text-success').removeClass('text-danger');
                // } else {
                //     $('.icon-lampu').addClass('text-danger').removeClass('text-success');
                // }
            })
        })
    </script>
@endpush
@push('script')
    <script>
        $('body').on('click','#btn-create-control',function(){
            $('#modal-create').modal('show');
        });
    $('#store').click(function(e){
        e.preventDefault();

        let nama_device = $('#nama_device').val();
        let gpio = $('#gpio').val();
        let token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url : `/control`,
            type : "POST",
            cache: false,
            data:{
                "nama_device" : nama_device,
                "gpio":gpio,
                "_token": token
            },
            success:function(response){
                Swal.fire({
                    type : 'success',
                    icon : 'success',
                    title : `$response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });
                $('#nama_device').val('');
                $('#gpio').val('');
                location.reload();
                $('#modal-create').modal('hide');
            }
        });
    });
    </script>
@endpush
