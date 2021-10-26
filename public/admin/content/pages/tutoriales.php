<?php
require_once('../../includes/load.php');
require_once('../../../uploads/files.php'); 
$user = current_user();
$videos_tutoriales = find_all('tutoriales');
$ultimos_tutoriales = ultimos_valores_tabla('tutoriales','','idtutorial','10');
cabecera('Tutoriales');
?>


<div id="listar_tutoriales">
<?php if(!empty($ultimos_tutoriales)){ ?> 
<div class="row justify-content-center">
<div class="col-10">
<h3 class="titulo-bienvenida">Ultimos videos tutoriales</h3><br>
</div></div>
<div class="row justify-content-center">
<div class="col-10">
<div class="owl-carousel videos-tutoriales">
<!-- inic ITEM -->
<?php 
foreach($ultimos_tutoriales as $row):   ?>
<div class="card"  style="border: 1px solid #00000040;height:100%;"> 
<div class="card-body mx-2">
<video src="../uploads/Tutoriales/<?php echo $row['archivo']; ?>" width="100%" height="150px" controls ></video>
    <h5 class="card-title"><?php echo $row['titulo']; ?></h5>
</div>
<div class="card-footer">
    <a href="../uploads/Tutoriales/<?php echo $row["archivo"]; ?>" target="_blank" class="btn btn-sm btn-dark btn-rounded text-white">Descargar</a>
</div>
</div>
<?php endforeach; ?>
<!-- fin item -->
</div>
</div>
</div>
<?php } ?>




<?php if(permiso('admin') || permiso('tutoriales')){ ?>
  <div class="row justify-content-center">
<div class="col-10">
<div class="d-flex flex-wrap p-b-30">
<div class="my-auto ml-3">
<h3 class="titulo-bienvenida">Videos tutoriales</h3>
</div>
<div class="ml-auto my-auto mr-3">
<?php if(permiso('admin') || permiso('tutoriales')){ ?>
             <a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip" class="btn btn-warning btn-rounded btn-light">Cargar nuevo</a>
                  <?php } ?>
</div>
</div>
</div>
</div>
         <div class="row justify-content-center">
         <div class="col-10">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
              <table id="tabla_tutoriales" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th> </th>
                    <th class="text-center">  </th>
                    <th class="text-center"> Titulo </th>
                    <th class="text-center"> Descripcion </th>   
                    <th class="text-center"> Archivo </th>
                    <th class="text-center"> Estado </th>    
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th> </th>
                    <th class="text-center">  </th>
                    <th class="text-center"> Titulo </th>
                    <th class="text-center"> Descripcion </th>   
                    <th class="text-center"> Archivo </th>
                    <th class="text-center"> Estado </th>               
                  </tr>
                </tfoot>
            </table>
          </div>
    </div>    
  </div>
</div>
</div>
</div>
<?php } ?>
<script type="text/javascript" src="includes/ajax/scripts/tutoriales.js"></script>
    <?php 
require_once('../forms/agregar_tutorial.php');
    pie(); 
    ?>















