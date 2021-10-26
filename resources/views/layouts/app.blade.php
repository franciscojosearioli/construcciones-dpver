@php
use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

<title>Sistema Administrativo de Construcciones - D.P.V.E.R.</title>
    <!-- Styles -->
  <link rel="shortcut icon" type="image/png" href="{{ asset('web/includes/assets/images/favicon.png') }}"/>
  <link href="{{ asset('web/includes/assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('web/includes/assets/css/mdb.min.css') }}" rel="stylesheet">  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
  <link href="{{ asset('web/includes/assets/css/style.css') }}" rel="stylesheet">  
  <link href="{{ asset('web/includes/assets/css/compiled-4.6.1.min.css') }}" rel="stylesheet">  
  <link href="{{ asset('web/includes/assets/images/favicon.png') }}" rel="shortcut icon" type="image/png">
  <link href="{{ asset('web/includes/assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('web/includes/assets/css/themes/codexar.css') }}" id="theme" rel="stylesheet">
  <link href="{{ asset('web/includes/assets/css/icons/font-awesome/css/font-awesome.css') }}" rel="stylesheet">  
  <link href="{{ asset('web/includes/assets/plugins/leaflet/css/leaflet.css') }}" rel="stylesheet">
  <link href="{{ asset('web/includes/assets/plugins/leaflet/css/leaflet.fullscreen.css') }}" rel="stylesheet">
  <link href="{{ asset('web/includes/assets/css/front.login.css') }}" rel="stylesheet">
  <link href="{{ asset('web/includes/assets/font/icomoon/style.css') }}" rel="stylesheet">
  <!-- SCRIPTS JS -->
  <script src="{{ asset('web/includes/assets/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('web/includes/assets/plugins/jquery/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('web/includes/assets/plugins/leaflet/js/leaflet.js') }}"></script>
  <script src="{{ asset('web/includes/assets/plugins/leaflet/js/leaflet.fullscreen.min.js') }}"></script>
  <script src='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css' rel='stylesheet' />
  <script src="{{ asset('web/includes/assets/js/isMobile.js') }}"></script>
  
</head>
<body>
    <div id="app">
  

        @yield('content')
    </div>

    <!-- Scripts -->
<script src="{{ asset('web/includes/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('web/includes/assets/js/waves.js') }}"></script>
<script src="{{ asset('web/includes/assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/js/custom.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/chartist-js/dist/chartist.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/echarts/echarts-all.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/dropzone-master/dist/dropzone.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/datatables/dataTables.select.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/datatables-buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/datatables-buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/file_tree/js/php_file_tree.js') }}" type="text/javascript"></script>
<script src="{{ asset('web/includes/assets/plugins/typeahead/js/typeahead.js') }}"></script>  
<script src="{{ asset('web/includes/assets/plugins/wizard/jquery.steps.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/wizard/jquery.validate.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('web/includes/assets/plugins/wizard/steps.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('web/includes/assets/js/ajustes.js') }}"></script>
<script src="{{ asset('web/includes/assets/js/consultas.js') }}"></script>
</body>
</html>
