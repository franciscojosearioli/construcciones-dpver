<?php
require_once('../../includes/load.php');
require_once('../../../uploads/files.php'); 
$user = current_user();
$recepciones_obras = all_recepciones_obras();
cabecera('Recepciones de obras');
?>
<div id="listar_recepciones">
<div class="row justify-content-center">
<div class="col-12">
<div class="d-flex flex-wrap p-b-30">
<div class="my-auto ml-3">
<h3 class="titulo-bienvenida">Recepciones de obras</h3>
</div>
<div class="ml-auto my-auto mr-3">
<?php if(permiso('admin') || permiso('obras') || permiso('recepciones')){ ?>
              <a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip" class="btn btn-dark btn-rounded btn-warning"><i class="fas fa-plus"></i> Cargar nuevo</a>
                  <?php } ?>
</div>
</div>
</div>
</div>
         <div class="row justify-content-center" >
         <div class="col-12">
          <div class="card">
          <!-- Nav tabs -->
       <ul class="nav nav-tabs customtab justify-content-center" role="tablist">


       <li class="nav-item"><a class="nav-link active" data-toggle="tab" role="tab" aria-controls="recepciones-todo" href="recepciones-todo.php" data-target="#recepciones-todo">TODOS</a></li>
<li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="recepciones-tramite" href="recepciones-tramite.php" data-target="#recepciones-tramite">EN TRAMITE</a></li>
<li class="nav-item"><a class="nav-link " data-toggle="tab" role="tab" aria-controls="recepciones-aprobado" href="recepciones-aprobado.php" data-target="#recepciones-aprobado">APROBADOS</a></li>

</ul>

<div class="tab-content">

<div class="tab-pane show active fade" role="tabpanel" id="recepciones-todo"></div>

<div class="tab-pane fade" role="tabpanel" id="recepciones-tramite"></div>

<div class="tab-pane fade" role="tabpanel" id="recepciones-aprobado"></div>
</div>

              
        </div>
      </div>
    </div>
    </div>
    <div id="editar_recepcion"></div>
    <div id="movimientos_recepcion"></div>
      <script>
      $(document).ready(function() {
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
     $.ajax({url:"recepciones-todo.php",success:function(tabdata){
     $("#recepciones-todo").append(tabdata);
    }});

});
  </script>
    <script type="text/javascript" src="includes/ajax/scripts/recepciones.js"></script>
    <?php 
    require_once('../forms/agregar_recepcion.php');
    pie(); ?>
    
    
