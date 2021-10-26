<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/memorandums.php');
$user = current_user();
$memorandums = all_memorandums();
cabecera('Memorandums');
?>
<div id="listar_memorandums">
<div class="row justify-content-center">
<div class="col-10">
<div class="d-flex flex-wrap p-b-30">
<div class="my-auto ml-3">
<h3 class="titulo-bienvenida">Memorandums</h3>
</div>
<div class="ml-auto my-auto mr-3">
<?php if(permiso('admin') || permiso('memorandums')){ ?>
              <a id="btn_comision" onclick="form_comision(true)" title="Memorandum de Comision de Servicios" data-toggle="tooltip" class="btn btn-dark btn-rounded btn-warning"><i class="fas fa-plus"></i> Comision</a>
              <a id="btn_llegada_tarde" onclick="form_llegada_tarde(true)" title="Memorandum de Llegada tarde" data-toggle="tooltip" class="btn btn-dark btn-rounded btn-warning"><i class="fas fa-plus"></i> Llegada tarde</a>
              <a id="btn_egreso" onclick="form_egreso(true)" title="Memorandum de Egreso" data-toggle="tooltip" class="btn btn-dark btn-rounded btn-warning"><i class="fas fa-plus"></i> Egreso</a>
                                <?php } ?>
</div>
</div>
</div>
</div>
         <div class="row justify-content-center" >
         <div class="col-10">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
      <div class="table-responsive">
              <table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th> </th>
                    <th class="text-center">  </th>    
                    <th class="text-center"> Tipo </th>    
                    <th class="text-center"> Agentes </th>
                    <th class="text-center"> Emisor </th> 
                    <th class="text-center"> Fecha del tramite </th>   
                    <th class="text-center"> Receptor </th>      
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($memorandums as $memo){
                    $agentes = find_by_id('memorandums_agentes','idmemorandums',$memo['idmemorandums']);
                    $agentes_comision = obtener_user_memo($memo['idmemorandums']);  ?>
                  <tr>
                    <td></td>
                    <td>
                      <?php if($memo['tipo'] == 1){ ?>
                        <a class="i-dt-list" href="content/prints/memo-llegada-tarde.php?id=<?php echo $memo['idmemorandums']; ?>" target="_blank"><i class="fa fa-file-pdf"></i></a>
     <a class="i-dt-list" href="content/prints/memo-llegada-tarde-docs.php?id=<?php echo $memo['idmemorandums']; ?>" target="_blank"><i class="fa fa-file-word"></i></a>
                      <?php } ?>
                      <?php if($memo['tipo'] == 2){ ?>
                      <a class="i-dt-list" href="content/prints/memo-comision.php?id=<?php echo $memo['idmemorandums']; ?>" target="_blank"><i class="fa fa-file-pdf"></i></a>
        <a class="i-dt-list" href="content/prints/memo-comision-docs.php?id=<?php echo $memo['idmemorandums']; ?>" target="_blank"><i class="fa fa-file-word"></i></a>
        <?php } ?>
        <?php if($memo['tipo'] == 3){ ?>
                      <a class="i-dt-list" href="content/prints/memo-egreso.php?id=<?php echo $memo['idmemorandums']; ?>" target="_blank"><i class="fa fa-file-pdf"></i></a>
        <a class="i-dt-list" href="content/prints/memo-egreso-docs.php?id=<?php echo $memo['idmemorandums']; ?>" target="_blank"><i class="fa fa-file-word"></i></a>
        <?php } ?>
                    </td>
                    <td><?php if($memo['tipo'] == 1){ echo 'Llegada tarde';} if($memo['tipo'] == 2){ echo 'Comision de servicio'; } if($memo['tipo'] == 3){ echo 'Egreso'; } ?></td>
                    <td><?php if($memo['tipo'] == 1){ echo user_name_memo_llegada_tarde($agentes['agente']);} ?>
                      <?php if($memo['tipo'] == 2){ foreach($agentes_comision as $ag){ echo '- '.user_nya($ag['agente']); }} ?>
                      <?php if($memo['tipo'] == 3){ echo user_name_memo_llegada_tarde($agentes['agente']);} ?>
                    </td>
                    <td><?php echo find_select('nombre','direcciones','iddireccion',$memo["emisor"]); ?></td>
                    <td><?php if($memo['tipo'] == 1){ echo format_date($memo["fecha"]); } ?>
                    <?php 
                      if($memo['tipo'] == 2){
                    $fecha_fin_result1 = date("d-m-Y",strtotime($memo["fecha_inicio"]."- 1 days"));
                    $fecha_fin_result2 = date("d-m-Y",strtotime($fecha_fin_result1."+ ".$memo["dias"]." days"));      
                    if($memo['dias'] != NULL){ echo format_date($memo["fecha_inicio"]).' a '.format_date($fecha_fin_result2); }else{ echo format_date($memo["fecha_inicio"]).' a '.format_date($memo['fecha_fin']); }
                    } ?>
                     <?php if($memo['tipo'] == 3){ if($memo['fecha_fin'] != NULL){ echo format_date($memo["fecha_fin"]); }else{ echo format_date($memo["fecha"]); } } ?></td>
                    <td class="text-center" ><?php  echo find_select('nombre','departamentos','iddepartamentos',$memo["receptor"]); ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th> </th>
                    <th class="text-center">  </th>      
                    <th class="text-center"> Tipo </th>    
                    <th class="text-center"> Agentes </th>
                    <th class="text-center"> Emisor </th>  
                    <th class="text-center"> Fecha del tramite </th>    
                    <th class="text-center"> Receptor </th>             
                  </tr>
                </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>    
  </div>
</div>
</div>
</div>
<script type="text/javascript" src="includes/ajax/scripts/memorandums.js"></script>
    <?php 
     require_once('../forms/memo_llegada_tarde.php');
     require_once('../forms/memo_comision.php');
     require_once('../forms/memo_egreso.php');
    pie(); 
    ?>
        <script type="text/javascript">
  $(document).ready(function () {
    $('.agentes').select2();
  });

    </script>