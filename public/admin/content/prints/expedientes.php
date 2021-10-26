<?php
$results = '';
  require_once($_SERVER["DOCUMENT_ROOT"]."/construcciones/sac/includes/load.php");
  if($_POST['todos'] == 1){
  $results = buscar_por_fecha_todo('expedientes',$_POST['fecha_inicio'],$_POST['fecha_fin']);
  }else{
  $results =  buscar_por_fecha('expedientes',$_POST['fecha_inicio'],$_POST['fecha_fin'],$_POST['iddireccion'],$_POST['iddepartamentos']);
}
?>
<!doctype html>
<html lang="en-US">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <link rel="shortcut icon" type="image/png" href="assets/favicon.png"/>
   <title>Planilla - Expedientes</title>
    <link rel="stylesheet" href="assets/style.css" />
     <link rel="stylesheet" href="assets/print.css" media="print" />   
   <style>
   body{
    background:#e4e4e4;
   }
   .container{
    background:#fff;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
   }
   .hocultarstyle{
    width: 100%;
    background:#f9f9f9;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
   }
   .pull-left{
    float: left!important;
    margin-left: 0px;
    margin-bottom: 20px;
   }
   .pull-right{
    float: right!important;
    margin-right: 0px;
    margin-bottom: 20px;
   }
   .pagina{
    padding:80px;
   }
   @media print
    only screen
     and (max-width: 760px), (min-device-width: 768px)
     and (max-device-width: 1024px)  {
       html,body{
          font-size: 9.5pt;
          padding:10px;
          width:100%;
          max-width: 950%;
          background:#000;
       }
       .page-break {
       page-break-before:always;
       width: auto;
       margin: auto;
      }
      .pagina{
        padding:0px;
      }
    .page-break{
      width: 200px;
      margin: 25px;
      border-bottom: 2px solid #eee;
    }
     .sale-head{
       margin: 10px 0;
       text-align: center;
     }.sale-head p,.sale-head strong{
       padding: 10px 20px;
       display: block;
     }.sale-head p{
       margin: 0;
       border-bottom: 1px solid #212121;
     }
  }
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
@media all {
   div.saltopagina{
      display: none;
   }
}
   
@media print{
   div.saltopagina{ 
      display:block; 
      page-break-before:always;
   }
         .pagina{
        padding:0px;
      }
}
@media (min-width: 1200px){}
.container{
    width: 100%;
}}
   </style>
</head>
</head>
<body>
      <div class="hocultar"><div class="hocultarstyle"> <br><div class="form-group"><div class="row"><div class="col-12"><center>Este documento fue emitido desde el sistema administrativo de construcciones, la informacion esta sujetas a cambios colectivos.<br><a onclick="window.print();">IMPRIMIR</a></center></div></div> </div> <hr></div></div>
<div class="container">
  <div class="pagina">
<div class="panel-body">
      <div class="form-group">
      <div class="row">
      <div class="col-md-12">
      <div class="pull-left">
     <H4 style="font-size:120%;"><b>DIRECCION PROVINCIAL DE VIALIDAD<br>DIRECCION DE CONSTRUCCIONES</b></H4>
      </div>
      <div class="pull-right"><br>
     <h4 style="font-size:90%;">Paraná, <?php echo format_date(date("d-m-Y")); ?></h4>
   </div>
     </div></div><hr>
   </div>
      <table class="table table-border">
                  <thead><tr>
              <th class="theader" style="background: #fff;" colspan="10"><center>REGISTRO DE EXPEDIENTES</center></th></tr></thead></table>
      <table class="table table-border">
        <thead>
          <tr>
              <th class="theader" style="font-size:90%;">Prioridad</th>
              <th class="theader" style="font-size:90%;">Expediente</th>
              <th class="theader" style="font-size:90%;">Asunto</th>
              <th class="theader" style="font-size:90%;">Iniciador</th>
              <th class="theader" style="font-size:90%;">Ubicacion</th>
              <th class="theader" style="font-size:90%;">Envia</th>
              <th class="theader" style="font-size:90%;">Recibe</th>
              <th class="theader" style="font-size:90%;">Observacion</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          foreach($results as $expediente):
                    $buscar_expediente = buscar_expediente($expediente['expediente']);
          ?>
           <tr>
                      <td class="text-center"> <?php
                      if($expediente['prioridad'] == 1){ echo 'Urgente';}
                      if($expediente['prioridad'] == 2){ echo 'Alto';}
                      if($expediente['prioridad'] == 3){ echo 'Medio';}
                      if($expediente['prioridad'] == 4){ echo 'Bajo'; }
                      ?></td>
                      <td class="text-center"><?php echo clean($expediente['expediente']); ?></td>
                      <td><?php if(!empty($expediente['asunto'])){ echo utf8_encode($expediente['asunto']); }else{ echo utf8_encode($buscar_expediente['asunto']);} ?></td>
                      <td class="text-center"><b><?php if(!empty($buscar_expediente['iniciador'])){ echo utf8_encode($buscar_expediente['iniciador']) ?></b> el <?php  echo format_date($buscar_expediente['fechareg']); } ?></td>
                      <td class="text-center"><b><?php
                      if($expediente['iddepartamentos'] == 1){ echo 'Administracion';}
                      if($expediente['iddepartamentos'] == 2){ echo 'Mesa de entrada';}
                      if($expediente['iddepartamentos'] == 3){ echo 'Obras por Contrato';}
                      if($expediente['iddepartamentos'] == 4){ echo 'Certificaciones y Costos';}
                      if($expediente['iddepartamentos'] == 5){ echo 'Iluminacion y Semaforizacion';}
                      if($expediente['iddepartamentos'] == 6){ echo 'Señalizacion y Seguridad Vial';}
                      if($expediente['iddepartamentos'] == 7){ echo 'Cuadrilla de Bacheos'; }
                      if($expediente['iddepartamentos'] == 8){ echo 'Inspector/Caja'; }         
                      if($expediente['iddepartamentos'] == 10){ echo 'Salio de la Direccion'; } ?></b><?php echo ' desde el '.format_date($expediente['fecha_pase']);?></td>
                      <td class="text-center"><?php echo $expediente['emisor']; ?></td>
                      <td class="text-center"><?php echo $expediente['receptor']; ?></td> 
                      <td class="text-center"><?php echo $expediente['observaciones']; ?></td>
                    </tr>
                <?php endforeach; ?>
        </tbody>
      </table>
    </div>
</body>
</html>
