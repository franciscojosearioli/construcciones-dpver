<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/construcciones/obras/includes/load.php');
$get_id = $_GET['id'];
$data = find_by_id('pedidos',$get_id);
$expediente = buscar_expediente($data['expediente']);
$user = current_user();
 if(isset($_POST['editar_expediente'])){
   if(empty($errors)){
     $observacion = clean($db->escape($_POST['observacion']));
     $prioridad   = clean($db->escape($_POST['prioridad']));
     $query  = "UPDATE pedidos SET";
     $query .=" observacion='{$observacion}', priority='{$prioridad}' WHERE id='{$get_id}'";
     if($db->query($query)){
       $session->msg('s',"Dato actualizado. ");
echo "<script languaje='javascript' type='text/javascript'>window.opener.document.location='../../expedientes'; window.close();</script>";
     } else {
       $session->msg('d',' Lo siento, registro falló.');
echo "<script languaje='javascript' type='text/javascript'>window.opener.document.location='../../expedientes'; window.close();</script>";
     }

   } else{
     $session->msg("d", $errors);
echo "<script languaje='javascript' type='text/javascript'>window.opener.document.location='../../expedientes'; window.close();</script>";
   }

 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edicion de datos</title>
  <link rel="shortcut icon" type="image/png" href="../../includes\assets\images\favicon.png"/>
  <link href="../../includes/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../includes/assets/css/mdb.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../includes/assets/css/addons/datatables.min.css"> 
  <link rel="stylesheet" type="text/css" href="../../includes/assets/css/bootstrap-datetimepicker.css">    
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
  <link href="../../includes/assets/css/style.css" rel="stylesheet">  
  <link href="../../includes/assets/css/compiled-4.6.1.min.css" rel="stylesheet">  
  <link href="../../includes/assets/file_tree/default.css" rel="stylesheet" type="text/css" media="screen" />  
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark lighten-1">
      <a class="navbar-brand" style="color:#fff;">Edicion de expediente </a>
          </nav>
        <div class="page">
          <div class="container-fluid2">
<style>
  .page{padding-top:0px;}
</style>
<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <b><?php echo $expediente['asunto']; ?></b>
    </ol>
    <div class="row">
      <div class="col-md-12">
        <?php echo display_msg($msg); ?>
      </div>
    </div>
  </div>
<div class="container">



  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="row">
          <div class="container">
          <div class="card-body">
           <form method="post" action="edit_expediente?id=<?php echo $get_id; ?>">
            <center>PRIORIDAD Y ESTADO</center><HR>
<div class="md-form input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Prioridad:</span>
  </div>
                    <select name="prioridad" class="browser-default custom-select">
                    <?php
                    if($data['priority'] == 1){ echo '<option value="1" selected>Urgente</option>';} 
                    if($data['priority'] == 2){ echo '<option value="2" selected>Alto</option>';} 
                    if($data['priority'] == 3){ echo '<option value="3" selected>Medio</option>';} 
                    if($data['priority'] == 4){ echo '<option value="4" selected>Bajo</option>';} 
                    ?>
                    <option value="1">Urgente</option>
                    <option value="2">Alto</option>
                    <option value="3">Medio</option>
                    <option value="4">Bajo</option>
                    </select>
</div>

<div class="md-form input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Observaciones:</span>
  </div>
  <textarea name="observacion" class="form-control md-textarea" rows="2"><?php echo $data["observacion"]; ?></textarea>
</div>
          <center><button type="submit" name="editar_expediente" class="btn btn-primary btn-md" >Guardar cambios</button></center>
</div>
</div></div></div></div></div>
          </form>
<br>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="row">
          <div class="container">
          <div class="card-body">


            <center>EXPEDIENTE ORIGINAL</center><HR>
<div class="md-form input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Expediente:</span>
  </div>
  <input type="text" name="expediente" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroupMaterial-sizing-default" value="<?php echo $expediente["numero"]; ?>" readonly>
</div>
<div class="md-form input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Asunto:</span>
  </div>
  <textarea name="asunto" class="form-control md-textarea" rows="3" readonly><?php echo $expediente["asunto"]; ?></textarea>
</div>
<div class="md-form input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Iniciador:</span>
  </div>
  <input type="text" name="iniciador" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroupMaterial-sizing-default" value="<?php echo $expediente["iniciador"]; ?>" readonly>
</div>
<div class="md-form input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Fecha de inicio:</span>
  </div>
  <input type="date" name="fecha_inicio" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroupMaterial-sizing-default" value="<?php echo $expediente["fechareg"]; ?>" readonly>
</div>
</div>
</div></div></div></div></div><br>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="row">
          <div class="container">
          <div class="card-body">

<center>MOVIMIENTOS</center><hr>
<div class="md-form input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Ubicacion actual:</span>
  </div>
    <input type="text" name="departamento" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroupMaterial-sizing-default" value="<?php 
                    if($data['dpto'] == 1){ echo 'Administracion (Director)';} 
                    if($data['dpto'] == 2){ echo 'Mesa de entrada (Administrativo)';} 
                    if($data['dpto'] == 3){ echo 'Obras por contrato';} 
                    if($data['dpto'] == 4){ echo 'Certificaciones y Costos';} 
                    if($data['dpto'] == 5){ echo 'Iluminacion';} 
                    if($data['dpto'] == 6){ echo 'Señalamiento';} 
                    if($data['dpto'] == 7){ echo 'Bacheos';} 
                    if($data['dpto'] == 8){ echo 'Inspector/Caja'; } 
                    if($data['dpto'] == 10){ echo 'SALIO DE LA DIRECCION'; } ?>" readonly>

</div>
<div class="md-form input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Enviado por:</span>
  </div>
  <input type="text" name="recibe" class="form-control" value="<?php echo $data['envio']; ?>" readonly>
</div>
<div class="md-form input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Recibido por:</span>
  </div>
  <input type="text" name="recibe" class="form-control" value="<?php echo $data['recibe']; ?>" readonly>
</div>
<div class="md-form input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Fecha de pase:</span>
  </div>
  <input type="date" name="fecha_pase" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroupMaterial-sizing-default" value="<?php echo $data['fecha_pase']; ?>" readonly>
</div>
<div class="md-form input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Estado:</span>
  </div>
    <input type="text" name="departamento" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroupMaterial-sizing-default" value="<?php
if($data['status'] == 1){ echo 'Activo';} 
if($data['status'] == 2){ echo 'Archivado';}  ?>" readonly>
</div><br>
</div>
</div></div></div></div></div>

<br>

</div>
</div>
  <script type="text/javascript" src="../../includes/assets/js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="../../includes/assets/js/popper.min.js"></script>
  <script type="text/javascript" src="../../includes/assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../../includes/assets/js/mdb.min.js"></script>
  <script type="text/javascript" src="../../includes/assets/js/addons/datatables.min.js"></script>
  <script type="text/javascript" src="../../includes/assets/js/ajustes.js"></script>
</body>
</html>
<?php if(isset($db)) { $db->db_disconnect(); } ?>
