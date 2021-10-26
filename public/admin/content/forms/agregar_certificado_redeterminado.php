      <div class="card-body hide" id="agregar_certificado_redeterminado">
<form method="post" action="obra?id=<?php echo (int)$_GET['id']; ?>" id="form_agregar_certificado_redeterminado">
            <div class="form-group p-20">
              <center><h3>Agregar certificado redeterminado</h3></center>
              <div class="row p-t-20">
                <input type="text" name="agregar_certificado_redeterminado" hidden>
                <div class="col-6">
                  <div class="md-form form-md">
                    <label class="control-label">Expediente</label>
                    <input type="number" name="expediente" class="form-control" required>
                  </div>
                  <div class="md-form form-md">
                    <label class="control-label">Numero</label>
                    <input type="text" name="numero" class="form-control" required>
                  </div>
                  <div class="md-form form-md">
                    <label class="control-label">Fecha</label>
                    <input type="text" name="fecha" class="form-control" required>
                  </div>
                  <div class="md-form form-md">
                    <label class="control-label">A precios de</label>
                    <input type="text" name="informacion" class="form-control" required>
                  </div>
                </div>       
                <div class="col-6">
                  <div class="md-form form-md">
                    <label class="control-label">Monto provisorio</label>
                    <input type="number" id="provisorio" name="monto_provisorio" pattern="^\d*(\.\d{0,2})?$" class="form-control">
                  </div>
                  <div class="md-form form-md">
                    <label class="control-label">Monto definitivo</label>
                    <input type="number" id="definitivo" name="monto_definitivo" pattern="^\d*(\.\d{0,2})?$" class="form-control">
                  </div>
                </div>                       
              </div>                    
          </div>

          <center>
          <a onclick="cancelar_agregar_certificado_redeterminado()" class="btn btn-danger waves-effect waves-light text-white">Cerrar</a>
          <a onclick="submit_agregar_certificado_redeterminado();" class="btn btn-info waves-effect waves-light text-white">Agregar</a>
        </center>

</form>
      </div>
<script>
    $("#provisorio").keyup( function() {
        if ($(this).val() != "") {
            $("#definitivo").prop("disabled", true);
        } else {
            $("#definitivo").prop("disabled", false);
        }
    });
    $("#definitivo").keyup( function() {
        if ($(this).val() != "") {
            $("#provisorio").prop("disabled", true);
        } else {
            $("#provisorio").prop("disabled", false);
        }
    });
</script>