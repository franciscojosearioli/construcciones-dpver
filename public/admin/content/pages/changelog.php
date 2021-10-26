<?php
require_once('../../includes/load.php');

// USUARIOS
$user = current_user();
$user_director = find_by_id('departamentos','iddireccion',$user['iddireccion']);
$user_departamento = find_by_id('departamentos','iddepartamentos',$user['iddepartamentos']);
$all_users = find_all_user_msj('usuarios',$user['id']);
$notificaciones = notificaciones();
$today = getdate();
$hora=$today["hours"];
// HEADER
cabecera('Informacion del sistema'); 
?>

<div class="container">

<div class="row justify-content-center pt-4 text-center">
	<p class="titulo-bienvenida">Version</p>
</div>


<div class="row justify-content-center">
    <div class="col-6">
<div class="card" >
<div class="header pt-2 b-header">
<div class="row d-flex justify-content-start">
<h5 class="deep-grey-text mx-5">Changelog</h5>
</div>
</div>
<div class="card-body">  
<div class="row">
<div class="col-12">
<div><i class="fas fa-angle-right"></i> <span></span></div>
</div>
</div>
</div>
</div>
<div class="card" >
<div class="header pt-2 b-header">
<div class="row d-flex justify-content-start">
<h5 class="deep-grey-text mx-5">Informar un nuevo cambio</h5>
</div>
</div>
<div class="card-body">  
<div class="row">
<div class="col-12">
Version: <input type="text" ><br/>
Informe <br/><textarea></textarea>
</div>
</div>
</div>
</div>
    </div>






</div>
</div>

            <?php pie(); ?>