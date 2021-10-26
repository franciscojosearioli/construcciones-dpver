<?php
$notificaciones = all_notificaciones_activos();
if(!isset($_SESSION['user_id'])){
header('Location: /construcciones/public/');
session_destroy();
}
if($user['condicion'] == 0){
header('Location: /construcciones/public/');
session_destroy();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="robots" content="noindex">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $titulo; ?></title>

<!-- CSS --> 

<link href="includes/assets/images/favicon.png" rel="shortcut icon" type="image/png">
<link href="includes/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="includes/assets/plugins/accordion/style.css" rel="stylesheet">
<link href="includes/assets/css/style.css" rel="stylesheet">
<link href="includes/assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
<link href="includes/assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
<link href="includes/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
<link href="includes/assets/plugins/css-chart/css-chart.css" rel="stylesheet">
<link href="includes/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet">
<link href="includes/assets/plugins/datatables/select.dataTables.min.css" rel="stylesheet">
<link href="includes/assets/plugins/datatables-buttons/buttons.dataTables.min.css" rel="stylesheet">
<link href="includes/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="includes/assets/plugins/file_tree/default.css" rel="stylesheet" type="text/css" media="screen">  
<link href="includes/assets/plugins/leaflet/css/leaflet.css" rel="stylesheet">
<link href="includes/assets/plugins/leaflet/css/leaflet.fullscreen.css" rel="stylesheet">
<link href="includes/assets/css/icons/font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="includes/assets/plugins/owl-carousel/style.css" rel="stylesheet">  
<link href="includes/assets/plugins/dropify/dist/css/dropify.min.css" rel="stylesheet">
<link href="includes/assets/plugins/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />
<link href="includes/assets/plugins/typeahead/css/typeahead.css" rel="stylesheet">
<link href="includes/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
<?php if($user['theme'] == 'light'){ ?>
<link href="includes/assets/css/themes/light-mode.css" id="theme" rel="stylesheet">
<?php } elseif($user['theme'] == 'dark'){ ?>
<link href="includes/assets/css/themes/dark-mode.css" id="theme" rel="stylesheet">
<?php } else{ ?>
<link href="includes/assets/css/themes/light-mode.css" id="theme" rel="stylesheet">
<?php } ?>
<link rel="stylesheet" href="includes/assets/plugins/owl-carousel2/assets/owl.carousel.min.css">
<link rel="stylesheet" href="includes/assets/plugins/owl-carousel2/assets/owl.theme.default.min.css">

<!-- JS -->
<script src="includes/assets/plugins/jquery/jquery.min.js"></script>
<script src="includes/assets/plugins/jquery/jquery-ui.min.js"></script>

<!-- MAS -->

<script src="includes/assets/plugins/leaflet/js/leaflet.js"></script>
<script src="includes/assets/plugins/leaflet/js/leaflet.fullscreen.min.js"></script>
<script src='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css' rel='stylesheet' />
<script src="includes/assets/js/isMobile.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ti-icons@0.1.2/css/themify-icons.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="includes/assets/css/custom.css" rel="stylesheet">  

</head>
<body class="fix-header fix-sidebar card-no-border mini-sidebar">
<script src="includes/assets/plugins/pushjs/push.min.js"></script>
<script src="includes/assets/plugins/Chart.js/Chart.min.js"></script>
<script src="includes/assets/js/notify.min.js"></script>
<script src="includes/assets/js/jquery-validate.min.js"></script>


<div id="main-wrapper">
<header class="topbar">
<nav class="navbar top-navbar navbar-expand-md navbar-light">
<div class="navbar-brand">
<a class="p-l-10">
<span style="padding-left:10px"></span>
<a class="sidebartoggler" ><i class="mdi mdi-menu nav-color"></i></a> 
<b><a href="index.php">
<?php if($user['theme'] == 'light'){ ?>
<img src="includes/assets/images/logo-dark-text.png" class="light-logo" height="50px" style="opacity: 0.9;" alt="homepage">
<?php } elseif($user['theme'] == 'dark'){ ?>
<img src="includes/assets/images/logo-light-text.png" class="light-logo" height="50px" style="opacity: 0.9;" alt="homepage">
<?php } else{ ?>
<img src="includes/assets/images/logo-dark-text.png" class="light-logo" height="50px" style="opacity: 0.9;" alt="homepage">
<?php } ?>
</a></b>
<span style="">
</span>
</a>
</div>
<div class="navbar-collapse">
<ul class="navbar-nav mr-auto mt-md-0">
</ul>                  
<ul class="navbar-nav my-lg-0">
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggletext-muted waves-effect waves-dark" onclick="change_theme();"> <i class="mdi mdi-theme-light-dark nav-color"></i>
</a></li>
<script>function change_theme(){$.ajax({type: "POST",url: "includes/ajax/change-theme.php",success: function() {location.reload();}});}</script>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell nav-color"></i>
</a>
<div class="dropdown-menu dropdown-menu-right mailbox scale-up">
<ul>
<li style="overflow: visible;">
<div class="slimScrollDiv" style="position: relative; overflow: visible hidden; width: auto; height: 250px;"><div class="message-center position-relative" style="overflow: hidden; width: auto; height: 250px;">
<!--Si el usuario realiza alguna accion en algun expediente, obra, proyecto, recepcion, etc, se notifica aca si algun participante incidio en el caso informando el caso del hecho y la posibilidad de acceder a mas informacion o seguir participando del tema-->
<?php 
foreach($notificaciones as $n): ?>
<a class="border-bottom d-block text-decoration-none py-2 px-3">
<div class="btn btn-success btn-circle mr-2"><i class="ti-calendar"></i>
</div>
<div class="mail-contnet d-inline-block align-middle">
<h5 class="my-1"><?php echo $n['asunto']; ?></h5> <span class="mail-desc font-12 text-truncate overflow-hidden text-nowrap d-block">
<?php echo $n['mensaje']; ?>
</span> <span class="time font-12 mt-1 text-truncate overflow-hidden text-nowrap d-block"><?php echo $n['registro_fecha']; ?></span>
</div>
</a>
<?php endforeach; ?>
</div><div class="slimScrollBar" style="background: rgb(220, 220, 220); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 191.131px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
</li>
<li style="display:none;">
<a class="nav-link text-center border-top pt-3" href="javascript:void(0);">
<strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
</li>
</ul>
</div>
</li>&nbsp;&nbsp;
<li class="nav-item dropdown">
<a style="font-size: 12px;" class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" title="<?php echo $user['nombre'].' '.$user['apellido']; ?>">
<?php if(!empty($user['imagen'])){ ?>
<img src="../uploads/Usuarios/Perfiles/<?php echo $user['id'].'/'.$user['imagen']; ?>" class="profile-pic" />
<?php }else{ ?>
<img src="../uploads/Usuarios/Perfiles/avatar.png" class="profile-pic" />
<?php } ?>
<i style="font-size:18px;padding-right:10px;padding-left:10px" class="mdi mdi-dots-vertical nav-color"></i>
</a>
<div class="dropdown-menu dropdown-menu-right scale-up">
<ul class="dropdown-user">
<?php if($_SESSION['user_id'] != 'consultas'){ ?>
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
<div class="col-9 my-auto nav-color" style="padding-left:10px;text-align:center;"> <h4><?php echo $user['nombre'].' '.$user['apellido']; ?></h4>
</div>
</div>
</div>
</li>
<?php if($user['idusuarios'] != NULL && $user['idusuarios'] != 0){ ?>
<li role="separator" class="divider"></li>
<li><a href="" style="pointer-events: none;"><i class="ti-user"></i> <span class="ml-2"><?php echo inspector_name($user['idusuarios']); ?></span></a></li>
<?php } ?>
<li role="separator" class="divider"></li>
<li><a class="menu-item-no-border menu-usuario-dropdown" href="usuario?id=<?php echo $user['id']; ?>"><i class="mdi mdi-account"></i> <span class="ml-2">Mi perfil</span></a></li>
<li><a class="menu-item-no-border menu-usuario-dropdown" href="tutoriales"><i class="mdi mdi-settings"></i> <span class="ml-2">Videos tutoriales</span></a></li>
<li role="separator" class="divider"></li>
<?php } ?>
<li><a class="menu-item-no-border menu-usuario-dropdown" href="includes/functions/cerrar-session.php"><i class="mdi mdi-power"></i> <span class="ml-2">Cerrar sesion</span></a></li>
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
<li>
<a class="menu-item" href="panel">
<i class="fas fa-th-large"></i> <span class="hide-menu pl-2">Escritorio</span>
</a>
</li>    
<?php 
include('../menu/construcciones.php');
//if($user['admin'] == 1){ include('../menu/administrador.php'); } 
//if($user['iddireccion'] == 1){ include('../menu/construcciones.php'); }  
//if($user['iddireccion'] == 2){ include('../menu/mantenimientos_y_suministros.php'); } 
//if($user['iddireccion'] == 11){ include('../menu/ingeniero_jefe.php'); } 
//if($user['iddireccion'] == 21){ include('../menu/obras_por_administracion.php'); } 
//if($user['iddireccion'] == 8){ include('../menu/estudios_y_proyectos.php'); } 
//if($user['iddireccion'] == 22){ include('../menu/informatica.php'); } 
if(permiso('moderador')){  include('../menu/administrador.php'); } 
if($user['admin_sistema'] == 1){ include('../menu/sistema.php'); } 
?>
</ul>
</nav>
</div>
</aside>
<div class="page-wrapper">
<div class="row p-20 nav-bread-custom">
<span style="padding-left:10px"></span><a href="javascript: history.go(-1)"><i class="mdi mdi-arrow-left nav-color"></i></a> <span style="padding-left:15px"></span> <a href="javascript: history.go(01)"><i class="mdi mdi-arrow-right nav-color"></i></a> <span style="padding-left:15px"></span> <a href="javascript:location.reload()"><i class="mdi mdi-autorenew nav-color"></i></a> <span style="padding-left:15px"></span><a href="index.php"><i class="mdi mdi-home-outline nav-color"></i></a> 
</span>
<div class="ml-auto">
<label class=" text-muted" style="position:absolute;margin-top:20px;font-size:11px;padding-right:5px;">Informacion actualizada a la fecha</label>
<div class="titulo-bienvenida" style="padding-right:5px;font-size:12px;" id="tiempo"></div>
<script type="text/javascript">
var d=new Date();
var dia=new Array(7);
var mm=new Date();
var m2 = mm.getMonth() + 1;
var mesok = (m2 < 10) ? '0' + m2 : m2;
var mesok=new Array(12);
var hora = d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
mesok[0]="Enero";
mesok[1]="Febrero";
mesok[2]="Marzo";
mesok[3]="Abril";
mesok[4]="Mayo";
mesok[5]="Junio";
mesok[6]="Julio";
mesok[7]="Agosto";
mesok[8]="Septiembre";
mesok[9]="Octubre";
mesok[10]="Noviembre";
mesok[11]="Diciembre";
dia[0]="Domingo";
dia[1]="Lunes";
dia[2]="Martes";
dia[3]="Miercoles";
dia[4]="Jueves";
dia[5]="Viernes";
dia[6]="Sabado";
$('#tiempo').html(dia[d.getDay()]+" "+d.getDate()+" de "+mesok[mm.getMonth()]+" a las "+hora);
</script>
</div>
</div>
<div class="container-fluid">                                            
