<?php
require_once('../../includes/load.php');
 $nota = find_by_id('notas','idnotas',$_POST['id']); 
 $all_direcciones = find_all('direcciones');
 $user = current_user();
 ?>
<!-- Central Modal Small -->
<div class="modal fade" id="pases_nota" tabindex="-1" role="dialog" aria-labelledby="pases_nota" aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-md" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="pases_nota">Movimientos del tramite</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          
            <div class="form-group p-20">
              <form method="post" action="notas" id="form_pase">
                <input type="text" name="pases_nota" value="<?php echo $nota['idnotas'] ?>" hidden>
                    <div class="row" >
                      <div class="col-12" style="border-left: 3px solid #000; background: #e0e0e030;" >
                        <label class="control-label"><u>Ubicacion actual</u></label><br/>
<b>Desde <?php echo format_date($nota['fecha_pase']); ?> en <?php echo find_select('nombre','departamentos','iddepartamentos',$nota['iddepartamentos']) ?> - <?php echo find_select('nombre','direcciones','iddireccion',$nota['iddireccion']) ?></b>
                      </div> 
                    </div>
                    <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Realizar un pase</label>
                        <select class="form-control custom-select" name="iddireccion" id="select_direccion_pase" required>
                          <option selected disabled>Seleccione una direccion</option>
                          <?php foreach ($all_direcciones as $direccion ):?>
                            <option value="<?php echo $direccion['iddireccion'];?>"><?php echo ucwords($direccion['nombre']);?></option>
                          <?php endforeach;?>
                        </select>
                      </div> 
                    </div>
                    <div id="departamentos_pase"></div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Fecha del pase</label>
                          <input type="date" name="fecha_pase" class="form-control" value="<?php echo date("Y-m-d");?>" required>
                        </div>
                      </div>
                      </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Emisor del tramite</label>
                          <input type="text" name="emisor" class="form-control" value="<?php echo $user['nombre'].' '.$user['apellido'] ?>" readonly required>
                        </div>
                      </div>
                      </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Recibe</label>
                          <input type="text" name="receptor" class="form-control">
                        </div>
                      </div>
                      </div>
          </div>
        </div>
        <div class="modal-footer">
              <button type="submit" class="btn btn-info waves-effect waves-light m-r-10" onclick="submit_pase();">Guardar</button>
              </form>
      </div>
    </div>
  </div>
</div>
    <script>
      $( "#select_direccion_pase" ).change(function() {
      var valor = $(this).val();
        $.post("includes/ajax/direccion-departamentos.php",  { valor: valor }).done(function(data) {
                    $('#departamentos_pase').html(data);
});
});
function submit_pase()
{
  validar = $("#form_pase").validate();
  if(validar){
  $('#form_pase').submit();
  }
}
    </script>