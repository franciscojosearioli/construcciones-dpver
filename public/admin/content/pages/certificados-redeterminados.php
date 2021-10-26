<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/certificados_redeterminados.php');   
cabecera('Certificados redeterminados de obras');
$ultimos_certificados = ultimos_valores_tabla('certificados_obras_redeterminados','','idcertificados_obras_redeterminados','10');
$user = current_user();

?>
<div  id="listar_certificados" >
<?php if(!empty($ultimos_certificados)){ ?> 
<div class="row justify-content-center">
<div class="col-10">
<h3 class="titulo-bienvenida">Ultimos certificados de obras</h3><br>
</div></div>
<div class="row justify-content-center">
<div class="col-10">
<div class="owl-carousel certificados">
<!-- inic ITEM -->
<?php 
foreach($ultimos_certificados as $row): 
$obra = find_by_id('obras','idobras',$row['idobras']);  ?>
<div class="card"  style="border: 1px solid #00000040;height:100%;"> 
<div class="card-body mx-2">
<p>   <?php if($row['numero'] == 0){
        echo 'Certificado N° '.$row['numero'];
        } ?></p>
<label class="control-label text-muted" style="font-size:11px;">Estado</label>
<p><?php if($row['estado'] == 0){ echo 'Confeccionado'; }elseif($row['estado'] == 1){ echo 'Emitido' ; }elseif($row['estado'] == 2){ echo 'Aprobado'; }elseif($row['estado'] == 3){ echo 'En Revision'; }?></p>
<?php if(!empty($row['expediente'])){ ?>
<label class="control-label text-muted" style="font-size:11px;">Expediente</label>
<p><?php echo $row['expediente']; ?></p>
<?php } ?>
<label class="control-label text-muted" style="font-size:11px;">Obra</label>
<p><?php echo $obra['numero'].' - '.$obra['expediente'].'<br>'.$obra['alias']; ?></p>
<p><a href="obra?id=<?php echo $obra['idobras']; ?>">Ver Informe de Obra</a></p>
</div>
<div class="card-footer">
<a href="../uploads/Obras/<?php echo $obra['idobras']; ?>/Certificaciones/Certificados/<?php echo $row['archivo_copia']; ?>" target="_blank">Ver Certificado</a>
</div>
</div>
<?php endforeach; ?>
<!-- fin item -->
</div>
</div>
</div>
<?php } ?>

<div class="row justify-content-center">
  <div class="col-10">
    <div class="d-flex flex-wrap p-b-30">
      <div class="my-auto ml-3">
<h3 class="titulo-bienvenida">Certificados redeterminados</h3>
      </div>
      <div class="ml-auto my-auto mr-3">
  <?php if(permiso('admin') || permiso('certificaciones')){ ?>
        <a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip"
          class="btn btn-warning btn-rounded btn-light"><i class="fas fa-plus"></i> Cargar nuevo</a>
          <?php } ?>
      </div>
    </div>
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-10">
    <div class="card">
      <div class="card-body">

        <div class="row">
          <div class="col-12">
            <ul class="nav nav-tabs customtab justify-content-center" role="tablist">
              <li class="nav-item"><a class="nav-link active" data-toggle="tab" role="tab"
                  aria-controls="certificados-provisorios" href="certificados-provisorios.php"
                  data-target="#certificados-provisorios">Provisorios</a></li>
              <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab"
                  aria-controls="certificados-definitivos" href="certificados-definitivos.php"
                  data-target="#certificados-definitivos">Definitivos</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane show active fade" id="certificados-provisorios" role="tabpanel"></div>
              <div class="tab-pane fade" id="certificados-definitivos" role="tabpanel" aria-expanded="false"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div></div>
<script>
  $(document).ready(function() {
    $('#certificaciones_tabs').show();
    var contentResult;

    $("a[data-toggle='tab']").on("show.bs.tab", function (e) {
      if ( e.relatedTarget ) {
        $( $(e.relatedTarget).data("target") ).empty();
      }
      var url = $(e.target).attr("href");
      var $tabTarget = $( $(e.target).data("target") );
      $.get( url, function( result ) {
        $tabTarget.html(result);
      });
      $( $(e.relatedTarget).data("target") ).removeClass('active');
    });


});

   $(document).ready(function(){
     $.ajax({async: true,url:"certificados-provisorios.php",success:function(tabdata){
     $("#certificados-provisorios").append(tabdata);
    }});

});
</script>








<script type="text/javascript" src="includes/ajax/scripts/certificaciones.js"></script>

  <?php 
    require_once('../forms/agregar_certificado_red.php');
  pie(); ?>