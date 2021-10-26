<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/users.php'); 
require_once('../../../uploads/files.php'); 

$usuario = find_by_id('users','id',$_GET['id']);  
$user = current_user();  
$actividades = usuarios_movimientos($_GET['id']);  
$obras_construcciones = obras_inspeccion($usuario['id'],$usuario['idusuarios']);
$usuario_a_cargo = usuarios_a_cargo($usuario['id']);
$usuarios_responsable = usuarios_responsable($usuario['idusuarios']); 
cabecera('Usuario: '.ucwords($usuario['apellido']).', '.ucwords($usuario['nombre']));
?>
<div class="row justify-content-center">
<div class="col-lg-8 col-md-8 col-sm-12 offset-md-3">
<div class="row p-20">

  <div class="col-lg-4 col-md-4 col-sm-12">
    <div class="card">
      <div class="card-body mx-4">
        <label class="control-label text-muted" style="font-size:11px;">Foto de perfil</label>
        <center>
        <?php if(!empty($usuario['imagen'])){ ?>
        <img src="../uploads/Usuarios/Perfiles/<?php echo $usuario['id'].'/'.$usuario['imagen']; ?>" width="150px">
        <?php } else { ?>
        <img src="../uploads/Usuarios/Perfiles/avatar.png" width="150px">
        <?php } ?>
        </center><br />
        </div>
      </div>
      
<?php if(permiso('admin')){ ?>
  <div class="card">
  <div class="card-body mx-4">
  <h3 class="card-title">Actividades</h3>
  <?php if(!empty($actividades)){ ?>
  <div class="list-group usuarios_movimientos scrollbar-ripe-malinka">
  <?php foreach ($actividades as $a): ?>
  <a class="list-group-item" style="padding-bottom: 5px;" >
  <?php echo $a['evento']; ?>                
  <p style="color:#00000080;font-size: 11px;">               
  <span style="float:right;"><?php echo format_dyt($a['fecha']); ?></span>
  </p>
  </a>
  <?php endforeach; echo '</div>'; }else{ ?> <a class="list-group-item" style="padding-bottom: 5px;" >No se ha registrado actividad.</a> <?php } ?>
  
</div>
  </div>       
  <?php } ?>
  </div>

  <div class="col-lg-8 col-md-8 col-sm-12">
    <div class="card">
    <div class="card-body mx-4">
        <label class="control-label text-muted" style="font-size:11px;">Nombre completo</label>
        <h2><?php echo ucwords($usuario['apellido']).', '.ucwords($usuario['nombre']); ?></h2>
        <label class="control-label text-muted" style="font-size:11px;">Correo electronico</label>
        <p><?php if(!empty($usuario['email'])){ echo $usuario['email'];} ?></p>
        <label class="control-label text-muted" style="font-size:11px;">Telefono</label>
        <p><?php if(!empty($usuario['telefono'])){ echo $usuario['telefono']; } ?></p>
        <label class="control-label text-muted" style="font-size:11px;">Direccion</label>
        <p><?php if(!empty($usuario['direccion'])){ echo $usuario['direccion'].' '.$usuario['direccion_numeracion'].', '; }if(!empty($usuario['localidad'])){ echo $usuario['localidad']; } if(!empty($usuario['codigo_postal'])){ echo ', '.$usuario['codigo_postal']; } ?></p>
        <label class="control-label text-muted" style="font-size:11px;">Dependencia</label>
        <p><?php echo find_select('nombre','departamentos','iddepartamentos',$usuario['iddepartamentos']); ?> | <?php echo find_select('nombre','direcciones','iddireccion',$usuario['iddireccion']); ?></p>
        <label class="control-label text-muted" style="font-size:11px;">Cargo</label>
        <p></p>
      </div>
    </div>

  </div>
  
</div>
</div>

</div>
</div>


<?php if($usuario['iddepartamentos'] == 8){ ?>

  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-8 col-sm-12 offset-md-3">
    <div class="row p-20">
      <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="card">
    <div class="card-body mx-4">
        <label class="control-label text-muted" style="font-size:11px;">Obras designadas para inspeccion</label>
      <?php foreach ($obras_construcciones as  $obra): ?>
      <a href="obra?id=<?php echo $obra['idobras'] ?>" class="list-group-item" style="padding:15px; text-decoration: none; color:#00000080" >
      <span style="font-weight:500"><?php echo $obra['nombre']; ?></span>                
      <p style="color:#1e88e5;font-size: 14px;">                
      <span style="float:right;font-weight:600"><?php
      if($obra['estado'] == 1){ echo 'En proyecto'; } 
      if($obra['estado'] == 0){ echo 'En ejecucion'; }
      if($obra['estado'] == 3){ echo 'Finalizada'; }
      if($obra['estado'] == 4){ echo 'Neutralizada'; }
      if($obra['estado'] == 5){ echo 'Rescindida'; } ?></span>
      </p>
      </a>
      <?php endforeach; ?>
    </div>
    </div>
  </div>
  </div>
  <div class="row p-20">
    <div class="col-lg-12 col-md-12 col-sm-12">
  <div class="card">
  <div class="card-body mx-4">
          <label class="control-label text-muted" style="font-size:11px;"><?php if($usuario['iddepartamentos'] == '8' && $usuario['idusuarios'] != 0){ ?>Inspectores de obras <?php } if($usuario['iddepartamentos'] == '8' && $usuario['idusuarios'] == 0){ ?>Personal en obras <?php } ?></label>
    <?php if($usuario['iddepartamentos'] == '8' && $usuario['idusuarios'] == 0){ ?>
      <?php foreach($usuario_a_cargo as $u): ?>
      <a href="usuario.php?id=<?php echo $u['id'] ?>" class="list-group-item" style="padding:15px; text-decoration: none; color:#00000080" >
      <span style="font-weight:500"><?php echo $u['nombre'].' '.$u['apellido']; ?></span>
      </a>
      <?php endforeach; } ?>
      <?php if($usuario['iddepartamentos'] == '8' && $usuario['idusuarios'] != 0){ ?>
      <?php foreach($usuarios_responsable as $u): ?>
      <a href="usuario.php?id=<?php echo $u['id'] ?>" class="list-group-item" style="padding:15px; text-decoration: none; color:#00000080" >
      <?php echo $u['nombre'].' '.$u['apellido']; ?>
      </a>
      <?php endforeach; } ?>

    </div>
  </div>
</div>
</div>

<?php } ?>

<?php pie(); ?>