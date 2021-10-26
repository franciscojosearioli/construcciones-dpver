<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/version.php');

// USUARIOS
$user = current_user();
$user_director = find_by_id('departamentos','iddireccion',$user['iddireccion']);
$user_departamento = find_by_id('departamentos','iddepartamentos',$user['iddepartamentos']);
$all_users = find_all_user_msj('usuarios',$user['id']);
$today = getdate();
$hora=$today["hours"];
$versiones= find_all('version');
// HEADER
cabecera('Informacion del sistema'); 
?>

<div class="container">

<div class="row justify-content-center pt-4 text-center">
	<p class="titulo-bienvenida">Informacion del sistema</p>
</div>


<div class="row justify-content-center">
        <?php if(permiso('admin')){ ?>
    <div class="col-5">
<div class="card" >
<div class="header pt-2 b-header">
<div class="row d-flex justify-content-start">
<h5 class="deep-grey-text mx-5">Informacion del servidor web</h5>
</div>
</div>
<div class="card-body">  
<div class="row">
<div class="col-12">
<div><i class="fas fa-angle-right"></i> <span>Apache/2.4.17 (Win32) OpenSSL/1.0.2d PHP/5.6.20 </span></div>
<div><i class="fas fa-angle-right"></i> <span>Versión de PHP: 5.6.20 </span></div>
</div>
</div>
</div>
</div>
<div class="card" >
<div class="header pt-2 b-header">
<div class="row d-flex justify-content-start">
<h5 class="deep-grey-text mx-5">Informacion de la base de datos</h5>
</div>
</div>
<div class="card-body">  
<div class="row">
<div class="col-12">
<div><i class="fas fa-angle-right"></i> <span>Servidor: 127.0.0.1 via TCP/IP </span></div>
<div><i class="fas fa-angle-right"></i> <span>Tipo de servidor: MariaDB </span></div>
<div><i class="fas fa-angle-right"></i> <span>Versión del servidor: 10.1.13-MariaDB </span></div>
<div><i class="fas fa-angle-right"></i> <span>Versión del protocolo: 10 </span></div>
<div><i class="fas fa-angle-right"></i> <span>Servidor: 127.0.0.1 via TCP/IP </span></div>
<div><i class="fas fa-angle-right"></i> <span>phpMyAdmin versión: 4.5.1 </span></div>
</div>
</div>
</div>
</div>
    </div>
<?php } ?>
    <?php 
    
 require_once('../forms/agregar_version.php');
 require_once('../forms/agregar_changelog.php');
    ?>
    <div class="col-7" id="version">
    <div class="my-auto ml-3 p-10">
<?php if(permiso('admin')){ ?>
<a id="btn_version" onclick="form_version(true)" title="Agregar nuevo" data-toggle="tooltip" class="btn btn-light"><i class="fas fa-plus"></i> Nueva version</a>
<a id="btn_changelog" onclick="form_changelog(true)" title="Agregar nuevo" data-toggle="tooltip" class="btn btn-light"><i class="fas fa-plus"></i> Nuevos cambios</a>
<?php } ?>
</div>
<div class="card">
<div class="card-body mx-4" >  
<div class="row ">
<div class="col-12">
<?php foreach($versiones as $version): ?>
<div class="text-center">
<h4>Version: <?php echo $version['numero']; ?> </h4></div>
<hr>
<ul>
<?php
$changelogs = cambios_version($version['idversion']);
foreach($changelogs as $c): ?>
<li><?php echo $c['descripcion']; ?></li>
<?php endforeach; ?>    
</ul>
<?php endforeach; ?>
</div>
</div>
</div>
</div>

</div>
</div>
<script type="text/javascript" src="includes/ajax/scripts/ajustes.js"></script>
 <?php 
 
 pie(); ?>