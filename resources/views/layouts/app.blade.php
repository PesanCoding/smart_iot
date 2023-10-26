
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('template/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{asset('template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  @stack('css_vendor')
  <link rel="stylesheet" href="{{asset('template/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('sweetalert::alert')
<div class="wrapper">
  @includeIf('layouts.partials.header')
  @includeIf('layouts.partials.sidebar')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
             <h1 class="m-0">@yield('title')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              @section('breadcrumb')
                <li class="breadcrumb-item active"><a href="{{route('dashboard.index')}}">Home</a></li>
                @show
            </ol>
          </div>
        </div>
      </div>
    </div>
    @includeIf('layouts.partials.content')
  </div>
  @includeIf('layouts.partials.footer')
</div>
<script src="{{asset('template/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('template/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('template/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('template/plugins/sparklines/sparkline.js')}}"></script>
<script src="{{asset('template/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('template/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
@stack('script_vendor')
<script src="{{asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('template/dist/js/adminlte.js')}}"></script>
<script src="{{asset('template/dist/js/pages/dashboard.js')}}"></script>
<script>
    $('.custom-file-input').on('change', function () {
        let filename = $(this).val().split('\\').pop();
        $(this)
        .next('.custom-file-label')
        .addClass('selected')
        .html(filename);
    });
    function preview(target, image) {
        $(target)
        .attr('src',window.URL.createObjectURL(image))
        .show();
     }
</script>
@stack('script')
</body>
</html>
