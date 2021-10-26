<?php
require_once('../../includes/load.php');
$user = current_user();
$all_direcciones = find_all('direcciones');
?>
<div class=" hide" id="localizar_expedientes">
         <div class="row justify-content-center" >
         <div class="col-4">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                <div class="card-body cards-titulo">
              <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Nuevo Expediente </h3>
                                                </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                      <h6 class="text-muted"><a onclick="cancelar_agregar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
            </div>  
            <div class="row justify-content-center p-20">
            <div class="md-form form-md">
                            <label class="control-label">Para Registrar un Nuevo Expediente debe ingresar el numero</label>
                            <input type="number" name="numero" id="numero" class="form-control" maxlength="6" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                          </div>
            </div>
           
            <div class="row justify-content-center">
            <div class="md-form form-md p-20">
                          <center><button id="enviar" class="btn btn-dark waves-effect waves-dark text-white" onclick="localizar_expediente()">Continuar</button></center>
                        </div>
            </div>
            </div>
      </div>
    </div>    
  </div>
</div>
</div> 
</div>

<div id="agregar_expedientes"></div>

<script type="text/javascript">
$("#numero").keyup(function(event) {
    if (event.keyCode === 13) {
        $("#enviar").click();
    }
});
</script>