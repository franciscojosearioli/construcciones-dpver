<?php
require_once('../../includes/load.php');
$user = current_user();
$direcciones = find_all('direcciones');
cabecera('Imprimir expedientes');
?>
      <div class="row">
        <div class="col-lg-12">
          <?php echo display_msg($msg); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <h3 class="card-title">Imprimir expedientes</h3>
              <h6 class="card-subtitle">Filtrar informacion</h6>
            </div>
            <div>
              <hr class="m-t-0 m-b-0">
            </div>
            <div class="card-body">

              <form method="post" action="../includes/prints/expedientes">    
                <div class="form-group p-20">
                  <center>Seleccione entre que fechas desea buscar</center>
                  <div class="row p-t-20">
                    <div class="col-6">
   <input class="form-check-input" type="checkbox" name="todos" id="todos" value="1">
    <label class="form-check-label" for="todos">
      Buscar todas las direcciones y departamentos
    </label>
                      </div> 
<div class="col-6">
     <input class="form-check-input" type="checkbox" name="all_direccion" id="all_direccion" value="1">
    <label class="form-check-label" for="all_direccion">
      Solo direccion
    </label>
</div>
                    </div>
                  <div class="row p-t-20">
                    <div class="col-12">
                        <select class="form-control custom-select" name="iddireccion" id="select_direccion">
                          <option selected disabled>Seleccione una direccion</option>
                          <?php foreach ($direcciones as $direccion ):?>
                            <option value="<?php echo $direccion['iddireccion'];?>"><?php echo ucwords($direccion['nombre']);?></option>
                          <?php endforeach;?>
                        </select>
                      </div> 
                    </div>
                    <div id="departamentos"></div>
                  <div class="row p-t-20">
                    <div class="col-6">
                      <input type="date" class="form-control" name="fecha_inicio" required>
                    </div>
                    <div class="col-6">
                      <input type="date" class="form-control" name="fecha_fin" required>
                    </div>
                  </div>
                  <div class="row p-t-20 justify-content-center">
                    <input type="submit" name="consultar" class="btn btn-info waves-effect waves-light" value="Consultar expedientes" >
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>    
      </div>
      <script type="text/javascript">

$("#todos").change(function() {
    if ($("#todos").is(':checked') ) {
        $("#select_direccion").prop( "disabled", true );
        $("#departamentos").hide();
        $("#all_direccion").prop( "disabled", true );
    } else {
        $("#select_direccion").prop( "disabled", false );
        $("#departamentos").show();
        $("#all_direccion").prop( "disabled", false );
    }
});
$("#all_direccion").change(function() {
    if ($("#all_direccion").is(':checked') ) {
        $("#departamentos").hide();
        $("#todos").prop( "disabled", true );
    } else {
        $("#departamentos").show();
        $("#todos").prop( "disabled", false );
    }
});

        $( "#select_direccion" ).change(function() {
      var valor = $(this).val();
        $.post("includes/ajax/direccion-departamentos.php",  { valor: valor }).done(function(data) {
                    $('#departamentos').html(data);
});
});
      </script>
      <?php pie(); ?>