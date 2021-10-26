<?php
require_once('../../../includes/load.php');

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
	<p class="titulo-bienvenida">Informacion del sistema</p>
</div>


<div class="row justify-content-center">
    <div class="col-5">
<div class="card" >
<div class="header pt-2 b-header">
<div class="row d-flex justify-content-start">
<h5 class="deep-grey-text mx-5">PROTOCOLO N 11 COVID-19</h5>
</div>
</div>
<div class="card-body">  
<div class="row">
<div class="col-12">
<center><a target="_blank" href="../uploads/PROTOCOLO11.pdf">VER MODALIDAD DE TRABAJO</a></center>
</div>
</div>
</div>
</div>
    </div>
    <div class="col-4">

<?php
if ($hora<5) { ?>
<div class="card">
<div class="card-body mx-4" >  
<div class="row justify-content-center">
	<div class="col-5 text-center my-auto justify-content-center">
		<img src="includes/assets/css/images/luna.png" width="100px">
	</div>
	<div class="col-7 my-auto text-center justify-content-center">
		<div class="date">
			<span id="weekDay" class="weekDay"></span><br>
			<span class="fecha-bienvenida"><span id="day" class="day"></span> <span id="month" class="month"></span> <span id="year" class="year"></span></span>
		</div>
		<div class="clock">   
			<span id="hours" class="hours"></span>:<span id="minutes" class="minutes"></span>:<span id="seconds" class="seconds"></span>
		</div>
	</div>
</div>
</div>
</div>
<?php }elseif($hora<8){ ?>
<div class="card">

<div class="card-body mx-4" >  
<div class="row justify-content-center">
	<div class="col-5 text-center my-auto">
		<img src="includes/assets/css/images/sol.png" width="100px">
	</div>
	<div class="col-7 my-auto text-center">
		<div class="date">
			<span id="weekDay" class="weekDay"></span><br>
			<span class="fecha-bienvenida"><span id="day" class="day"></span> <span id="month" class="month"></span> <span id="year" class="year"></span></span>
		</div>
		<div class="clock">   
			<span id="hours" class="hours"></span>:<span id="minutes" class="minutes"></span>:<span id="seconds" class="seconds"></span>
		</div>
	</div>
</div>
</div></div>

<?php }elseif($hora<=13){ ?>
<div class="card">

<div class="card-body mx-4" >  
<div class="row justify-content-center">
	<div class="col-5 text-center my-auto">
		<img src="includes/assets/css/images/sol.png" width="100px">
	</div>
	<div class="col-7 my-auto text-center">
		<div class="date">
			<span id="weekDay" class="weekDay"></span><br>
			<span class="fecha-bienvenida"><span id="day" class="day"></span> <span id="month" class="month"></span> <span id="year" class="year"></span></span>
		</div>
		<div class="clock">   
			<span id="hours" class="hours"></span>:<span id="minutes" class="minutes"></span>:<span id="seconds" class="seconds"></span>
		</div>
	</div>
</div>
</div></div>



<?php }elseif($hora<=19){ ?>
<div class="card">

<div class="card-body mx-4" >  
<div class="row justify-content-center">
	<div class="col-5 text-center my-auto">
		<img src="includes/assets/css/images/sol.png" width="100px">
	</div>
	<div class="col-7 my-auto text-center">
		<div class="date">
			<span id="weekDay" class="weekDay"></span><br>
			<span class="fecha-bienvenida"><span id="day" class="day"></span> <span id="month" class="month"></span> <span id="year" class="year"></span></span>
		</div>
		<div class="clock">   
			<span id="hours" class="hours"></span>:<span id="minutes" class="minutes"></span>:<span id="seconds" class="seconds"></span>
		</div>
	</div>
</div>
</div></div>




<?php }else{ ?>
<div class="card">

<div class="card-body mx-4" >  
<div class="row justify-content-center">
	<div class="col-5 text-center my-auto">
		<img src="includes/assets/css/images/luna.png" width="100px">
	</div>
	<div class="col-7 my-auto text-center">
		<div class="date">
			<span id="weekDay" class="weekDay"></span><br>
			<span class="fecha-bienvenida"><span id="day" class="day"></span> <span id="month" class="month"></span> <span id="year" class="year"></span></span>
		</div>
		<div class="clock">   
			<span id="hours" class="hours"></span>:<span id="minutes" class="minutes"></span>:<span id="seconds" class="seconds"></span>
		</div>
	</div>
</div>
</div></div>


<?php } ?>




</div>
</div>
<?php
//ADMINISTRADOR
if(permiso('admin')){ include_once('paneles/admin.php') ; }
            

if(!permiso('admin')){         
            
//CONSTRUCCIONES
if($user['iddireccion'] == 1){
//DIRECTOR
if($user['iddepartamentos'] == 1){ include_once('paneles/construcciones/1.php') ;}  
//DEPARTAMENTOS
if($user['iddepartamentos'] == 2){ include_once('paneles/construcciones/2.php') ;}
elseif($user['iddepartamentos'] == 3){ include_once('paneles/construcciones/3.php') ;}
elseif($user['iddepartamentos'] == 4){ include_once('paneles/construcciones/4.php') ;}
elseif($user['iddepartamentos'] == 8){ include_once('paneles/construcciones/8.php') ;}

}

if($user['iddireccion'] == 2){ 

if($user['iddepartamentos'] == $user_director['iddepartamentos']){ include_once('paneles/mantenimiento/75.php'); }
}


//OBRAS POR ADMINISTRACION
if($user['iddireccion'] == 21){
//DIRECTOR
//if($user['iddepartamentos'] == $user_director['iddepartamentos']){ include_once('paneles/obrasporadministracion/director.php') ;}  
//DEPARTAMENTOS
if($user['iddepartamentos'] == 5){ include_once('paneles/obrasporadministracion/5.php') ;}
elseif($user['iddepartamentos'] == 6){ include_once('paneles/obrasporadministracion/6.php') ;}
elseif($user['iddepartamentos'] == 7){ include_once('paneles/obrasporadministracion/7.php') ;}

}

//ESTUDIOS Y PROYECTOS
if($user['iddireccion'] == 8){
//DIRECTOR
if($user['iddepartamentos'] == 50){ include_once('paneles/eyp/director.php') ;}  
//DEPARTAMENTOS
}


//ING JEFE
if($user['iddireccion'] == 11){
//DIRECTOR
if($user['iddepartamentos'] == 74){ include_once('paneles/ingenierojefe/74.php') ;}  
//DEPARTAMENTOS
}

//ING JEFE
if($user['iddireccion'] == 22){
//DIRECTOR
if($user['iddepartamentos'] == 89){ include_once('paneles/informatica/desarrollo.php') ;}  
//DEPARTAMENTOS
}

}


?>

<script src="includes/assets/js/clock.js"></script> 
<!--<?php include('../popup/video.php'); ?>-->
            <?php pie(); ?>