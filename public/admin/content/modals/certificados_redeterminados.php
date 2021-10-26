<div class="modal fade" id="certificados_redeterminados" tabindex="-1" role="dialog" aria-labelledby="certificados_redeterminados" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="certificados_redeterminados">Certificado redeterminado</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <form method="post" action="obra?id=<?php echo (int)$_GET['id']; ?>">
            <div class="form-group p-20">
              <div class="row p-t-20">
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
                    <input type="number" id="provisorio" name="monto_provisorio" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" class="form-control">
                  </div>
                  <div class="md-form form-md">
                    <label class="control-label">Monto definitivo</label>
                    <input type="number" id="definitivo" name="monto_definitivo" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" class="form-control">
                  </div>
                </div>                       
              </div>                    
          </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="certificados_redeterminados" class="btn btn-info waves-effect waves-light">Agregar nuevo</button>
        </form>
      </div>
    </div>
  </div>
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
