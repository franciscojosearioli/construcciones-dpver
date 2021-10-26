@php
use Illuminate\Support\Facades\Auth;

@endphp
@if(Auth::user())
@php
$user = Auth::user();
@endphp
@endif



<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('images/favicon.png') }}"rel="shortcut icon" type="image/png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">  
  <link href="{{ asset('css/themes/codexar.css') }}" rel="stylesheet">  
  <link href="{{ asset('css/compiled-4.6.1.min.css') }}" rel="stylesheet"> 
  <link href="{{ asset('plugins/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/chartist-js/dist/chartist-init.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/css-chart/css-chart.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/datatables/select.dataTables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/datatables-buttons/buttons.dataTables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/c3-master/c3.min.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/file_tree/default.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/leaflet/css/leaflet.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/leaflet/css/leaflet.fullscreen.css') }}" rel="stylesheet">

  <link href="{{ asset('plugins/dropify/dist/css/dropify.min.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/dropzone-master/dist/dropzone.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/typeahead/css/typeahead.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

    <!--<link href="includes/assets/plugins/mensajes/css/messenger.css" rel="stylesheet">
    <link href="includes/assets/plugins/notificaciones/css/notificaciones.css" rel="stylesheet">
    <script src="http://simile.mit.edu/timeline/api/timeline-api.js" type="text/javascript"></script>
    <link href="includes/assets/plugins/recordatorios/css/style.css" rel="stylesheet">
    <link href="includes/assets/plugins/wizard/steps.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="includes/assets/plugins/timeline/css/timeline.css" />-->

  <!-- SCRIPTS JS -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/jquery/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('plugins/leaflet/js/leaflet.js') }}"></script>
  <script src="{{ asset('plugins/leaflet/js/leaflet.fullscreen.min.js') }}"></script>
  <script src='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css' rel='stylesheet' />
  <script src="{{ asset('js/isMobile.js') }}"></script>
</head>
<body class="fix-header fix-sidebar card-no-border mini-sidebar">
    <div id="main-wrapper">
        <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-brand">
                <a class="sidebartoggler text-muted" ><i class="ti-menu"></i></a>
                    <a  href="index.php">
                        <b>
                            <img src="{{ asset('images/logo-light-icon.png" alt="homepage" class="light-logo" /><img src="{{ asset('images/logo-light-text.png" class="light-logo mt- ml-2" height="50px" style="opacity: 0.9;" alt="homepage">
                        </b>
                        <span style="">
                            </span>
                        </a>
                    </div>
                    <div class="navbar-collapse">



                        <ul class="navbar-nav mr-auto mt-md-0">
                        </ul>                  
                        <ul class="navbar-nav my-lg-0">
                            <li class="nav-item dropdown">
                            <span style="color:#fff;">{{!! $user['name'] !!}}</span>
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" title="<?php echo $user['nombre'].' '.$user['apellido']; ?>">
                                    <?php if(!empty($user['imagen'])){ ?>
                                        <img src="../uploads/Usuarios/Perfiles/<?php echo $user['id'].'/'.$user['imagen']; ?>" class="profile-pic" />
                                    <?php }else{ ?>
                                        <img src="../uploads/Usuarios/Perfiles/avatar.png" class="profile-pic" />
                                    <?php } ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right scale-up">
                                    <ul class="dropdown-user">
@if(Auth::user())
                                            <li>
                                            
                                                <div class="dw-user-box">
                                                <div class="u-text">    
                                                <div class="row">                                    
                                                <div class="col-3 my-auto">
                                                <?php if(!empty($user['imagen'])){ ?>
                                        <img src="../uploads/Usuarios/Perfiles/<?php echo $user['id'].'/'.$user['imagen']; ?>" class="profile-pic" />
                                    <?php }else{ ?>
                                        <img src="../uploads/Usuarios/Perfiles/avatar.png" class="profile-pic" />
                                    <?php } ?></div>
           <div class="col-9 my-auto" style="padding-left:0px"> <h4><?php echo $user['nombre'].' '.$user['apellido']; ?></h4>
              <p class="text-muted"><?php echo $user['email']; ?></p><p class="text-muted"><?php echo $user['telefono']; ?></p></div></div></div>

                                                    
                                                </li>
                                                <?php if($user['idusuarios'] != NULL && $user['idusuarios'] != 0){ ?>
                                                    <li role="separator" class="divider"></li>
                                                    <li><a href="" style="pointer-events: none;"><i class="ti-user"></i> <span class="ml-2"><?php echo inspector_name($user['idusuarios']); ?></span></a></li>
                                                <?php } ?>
                                                <li role="separator" class="divider"></li>
                                                <li><a class="menu-item-no-border" href="usuario?id=<?php echo $user['id']; ?>"><i class="mdi mdi-account"></i> <span class="ml-2">Mi cuenta</span></a></li>
                                                <li><a class="menu-item-no-border" href="chat"><i class="mdi mdi-email"></i> <span class="ml-2">Mis Mensajes</span></a></li>
                                                <li><a class="menu-item-no-border" href="recordatorios"><i class="mdi mdi-format-list-bulleted"></i> <span class="ml-2">Mis Notas</span></a></li>
                                                
                                                <li><a class="menu-item-no-border" href="perfil"><i class="mdi mdi-settings"></i> <span class="ml-2">Editar cuenta</span></a></li>
                                                <li role="separator" class="divider"></li>
@endif
                                            <li><a class="menu-item-no-border" href="includes/functions/cerrar-session.php"><i class="mdi mdi-power"></i> <span class="ml-2">Cerrar sesion</span></a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>
                <aside class="left-sidebar">
                    <div class="scroll-sidebar">
                        <nav class="sidebar-nav">
                            <ul id="sidebarnav">
                                <!--<li class="nav-small-cap">
                                    <form class="app-search" method="post" action="consultas">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1" style="background: #f0f0f0"><i class='ti-search'></i></span>
                                            <input type="number" name="numero" style="background: #f0f0f0" class="form-control buscarexpediente" placeholder="Expedientes" aria-describedby="basic-addon1" autocomplete="off">
                                        </div></form></li>
<li class="nav-small-cap">
    <a class="btn btn-danger waves-effect waves-dark text-white" style="background-color: #bf1333;border-color: #bf1333;" href="../sac-app.apk" aria-expanded="false"><i class="mdi mdi-cellphone-android text-white"></i><span class="hide-menu text-white">ANDROID APP</span></a>

</li>-->
         
@include('menu/sistema')
@if($user['admin_sistema'] == 1)
@include('/admin/content/menu/sistema.php')
@endif
@if($user['admin'] == 1)
@include('content/menu/administrador.php')
@endif
@if($user['iddireccion'] == 1)
@include('../menu/construcciones.php')
@endif
@if($user['iddireccion'] == 2)
@include('../menu/mantenimientos_y_suministros.php')
@endif
@if($user['iddireccion'] == 11)
@include('../menu/ingeniero_jefe.php')
@endif
@if($user['iddireccion'] == 21)
@include('../menu/obras_por_administracion.php')
@endif
@if($user['iddireccion'] == 8)
@include('../menu/estudios_y_proyectos.php')
@endif
@if($user['iddireccion'] == 22)
@include('../menu/informatica.php')
@endif 


                                    </ul>
                                </nav>
                            </div>
                                                        
                        </aside>
                        <div class="page-wrapper">
  <div class="bredcrumb"></div>
  <div class="container-fluid">      
    

        @yield('content')

        </div>
<footer class="footer">
    © Dirección Provincial de Vialidad de Entre Ríos
</footer>
</div>
</div>

<script src="{{ asset('plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('js/waves.js') }}"></script>
<script src="{{ asset('js/sidebarmenu.js') }}"></script>
<script src="{{ asset('plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('js/custom.min.js') }}"></script>
<script src="{{ asset('plugins/chartist-js/dist/chartist.min.js') }}"></script>
<script src="{{ asset('plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>
<script src="{{ asset('plugins/echarts/echarts-all.js') }}"></script>
<script src="{{ asset('plugins/dropify/dist/js/dropify.min.js') }}"></script>
<script src="{{ asset('plugins/dropzone-master/dist/dropzone.js') }}"></script>
<script src="{{ asset('plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.select.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/file_tree/js/php_file_tree.js') }}"></script>
<script src="{{ asset('plugins/typeahead/js/typeahead.js') }}"></script>
<script src="{{ asset('plugins/wizard/jquery.steps.min.js') }}"></script>
<script src="{{ asset('plugins/wizard/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('plugins/wizard/steps.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



<!--<script src="includes/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="includes/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="includes/assets/plugins/mensajes/js/messenger.js"></script>
<script src="includes/assets/plugins/mensajes/js/progressbar.min.js"></script>
<script src="includes/assets/plugins/notificaciones/js/notificaciones.js"></script>  
<script src="includes/assets/plugins/recordatorios/js/recordatorios.js"></script>
<script src="includes/assets/plugins/mensajes/js/chat.js"></script> -->








<script src="{{ asset('js/ajustes.js') }}"></script>

</body>
</html>




