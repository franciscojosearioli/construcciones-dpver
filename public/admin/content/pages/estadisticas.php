<?php
require_once('../../includes/load.php');
// USUARIOS
$user = current_user();
$user_director = find_by_id('departamentos','iddireccion',$user['iddireccion']);
$user_departamento = find_by_id('depratamentos','iddepartamentos',$user['iddepartamentos']);
$all_users = find_all_user_msj('usuarios',$user['id']);
$notificaciones = notificaciones();

// CONTEOS
$conteo_expedientes = conteo_expedientes('expedientes','idexpedientes',$user['iddepartamentos']);
$conteo_expedientes_direccion = conteo_expedientes_direccion('expedientes','idexpedientes',1);
$conteo_all_expedientes = conteo_all_expedientes('expedientes','idexpedientes');

$conteo_notas = conteo_expedientes('notas','idnotas',$user['iddepartamentos']);
$conteo_notas_direccion = conteo_expedientes('notas','idnotas',1);
$conteo_all_notas = conteo_all_expedientes('notas','idnotas');


$conteo_proyectos = conteo_proyectos_construcciones('obras','idobras');

$conteo_proyectos_iluminacion = conteo_proyectos_iluminacion('obras','idobras');
$conteo_proyectos_senialamiento = conteo_proyectos_senialamiento('obras','idobras');
$conteo_bacheos = conteo_bacheos('obras_bacheos','idbacheos');

$conteo_obras = conteo_obras_construcciones('obras','idobras');
$conteo_obras_ejecutadas = conteo_obras_ejecutadas('obras','idobras');

$conteo_obras_finalizadas = conteo_obras_finalizadas('obras','idobras');
$conteo_obras_neutralizadas = conteo_obras_neutralizadas('obras','idobras');
$conteo_obras_rescindidas = conteo_obras_rescindidas('obras','idobras');

$conteo_obras_modificaciones = conteo_modificaciones('idmodificaciones');
$conteo_obras_ampliaciones = conteo_ampliaciones('idampliaciones');
$conteo_obras_neutralizaciones = conteo_neutralizaciones('idneutralizaciones');

// ULTIMOS REGISTROS
$ultimos_proyectos = ultimos_proyectos(1,0,'idobras',5);
$ultimas_modificaciones = ultimos_registros('obras_modificaciones','idmodificaciones',5);

$usuarios_registrados = all_usuarios_registrados();
$usuarios_activos = usuarios_activos();
$usuarios_inactivos = usuarios_inactivos();

$obras_iniciadas = fechas_inicios_obra();
$obras_finalizadas = fechas_fin_obra();

$proyectos_a_finalizar = fechas_fin_proyecto();

$conteo_relevamientos_filtro = conteo_relevamientos_construcciones();
$conteo_relevamientos_ilu = conteo_relevamientos_filtro($user['iddireccion'],5);
$conteo_relevamientos_sen = conteo_relevamientos_filtro($user['iddireccion'],6);

// HEADER
cabecera('Estadisticas'); 
?>

<div class="card">
<h3 class="p-20">Modulo en desarrollo...</h3>
</div>
            <div class="row p-t-20">
                <div class="col-lg-7 col-md-7 col-sm-12 mx-auto">
              <?php if(permiso('admin') || permiso('observador') || permiso('expedientes') || permiso('notas')){ ?>
        <div class="card card-signin">
          <div class="header pt-3">
                              <div class="row d-flex justify-content-start">
                                  <h3 class="deep-grey-text pb-1 mx-5">Administrativo</h3>
                              </div>
                          </div>

<div class="card-body mx-4" >   
<div class="lista_conteos"> 
<span class="conteos"><?php echo $conteo_expedientes['total']; ?></span> Expedientes en el departamento <br />
<span class="conteos"><?php echo $conteo_expedientes_direccion['total']; ?></span> Expedientes en la direccion <br />
<span class="conteos"><?php echo $conteo_all_expedientes['total']; ?></span> Expedientes totales registrados <br /> 
<hr>
<span class="conteos"><?php echo $conteo_notas['total']; ?></span> Notas en el departamento <br />
<span class="conteos"><?php echo $conteo_notas_direccion['total']; ?></span> Notas en la direccion <br />
<span class="conteos"><?php echo $conteo_all_notas['total']; ?></span> Notas totales registradas <br />
<hr>
Certificados aprobados este mes <br />
Certificados redeterminados este mes <br />
<hr>
<span class="conteos"><?php echo $usuarios_registrados['total']; ?></span> Usuarios registrados <br />
<span class="conteos"><?php echo $usuarios_activos['total']; ?></span> Usuarios activos <br />
<span class="conteos"><?php echo $usuarios_inactivos['total']; ?></span> Usuarios inactivos <br />
</div>
</div>
</div>
<?php } ?>
<?php if(permiso('admin') || permiso('observador') || permiso('obras') || permiso('proyectos') || permiso('relevamientos')){ ?>
        <div class="card card-signin">
          <div class="header pt-3">
                              <div class="row d-flex justify-content-start">
                                  <h3 class="deep-grey-text pb-1 mx-5">Obras por Contrato</h3>
                              </div>
                          </div>

<div class="card-body mx-4" >     
<div class="lista_conteos"> 
<span class="conteos"><?php echo $conteo_relevamientos_filtro['total']; ?></span> Relevamientos en tramite <br />    
<span class="conteos"><?php echo $conteo_proyectos['total']; ?></span> Proyectos en tramite <br />    
<span class="conteos"><?php echo $proyectos_a_finalizar['total']; ?></span> Proyectos prontos a terminar <br />
<hr>
<span class="conteos"><?php echo $conteo_obras['total']; ?></span> Obras contratadas <br />
<span class="conteos"><?php echo $conteo_obras_ejecutadas['total']; ?></span> Obras en ejecucion <br />    
<span class="conteos"><?php echo $conteo_obras_finalizadas['total']; ?></span> Obras finalizadas <br />
<span class="conteos"><?php echo $conteo_obras_neutralizadas['total']; ?></span> Obras neutralizadas <br />
<span class="conteos"><?php echo $conteo_obras_rescindidas['total']; ?></span> Obras rescindidas <br />
<span class="conteos"><?php echo $obras_iniciadas['total']; ?></span> Obras iniciadas este año <br />
<span class="conteos"><?php echo $obras_finalizadas['total']; ?></span> Obras prontas a terminar este año <br />
<hr>
<span class="conteos"><?php echo $conteo_obras_modificaciones['total']; ?></span> Modificaciones de obra <br />    
<span class="conteos"><?php echo $conteo_obras_ampliaciones['total']; ?></span> Ampliaciones de obra <br />
<span class="conteos"><?php echo $conteo_obras_neutralizaciones['total']; ?></span> Neutralizaciones de obra <br />
<hr>
<span class="conteos"><?php echo $conteo_bacheos['total']; ?></span> Trabajos de bacheos realizados <br />
</div>   
</div>
    </div>
  <?php } ?>
</div>
                    
                    <div class="col-lg-5 col-md-5 col-sm-12 mx-auto">
        <div class="card card-signin">
          <div class="header pt-3">
                              <div class="row d-flex justify-content-start">
                                  <h3 class="deep-grey-text pb-1 mx-5">Reportes</h3>
                              </div>
                          </div>

<div class="card-body mx-4" >   
              <form method="post" action="estadisticas">    
                <div class="form-group p-20">
                  <div class="row p-t-20">
                    <div class="col-12">
                        <select class="form-control custom-select" name="tema">
                          <option selected disabled>Seleccione un area</option>
                            <option value="expedientes">Expedientes</option>
                            <option value="notas">Notas</option>
                        </select>
                      </div> 
                    </div>
                  <div class="row p-t-20">
                    <div class="col-12">
   <input class="form-check-input" type="checkbox" name="todos" id="todos" value="1">
    <label class="form-check-label" for="todos">
      Buscar en todos lados
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
                    <input type="submit" name="consultar" class="btn btn-info waves-effect waves-light" value="Generar" >
                  </div>
                </div>
              </form> 
</div>
    </div>
<?php if(permiso('admin') || permiso('observador') || permiso('obras')){ ?>    
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Estado de obras</h3>
                                <h6 class="card-subtitle">Contratadas</h6>
                                <canvas id="obrasporcontrato" width="100%" height="60%"></canvas>
                            </div>
                                <div>
                                <hr class="m-t-0 m-b-0">
                            </div>
                                <div class="card-body text-center">
                                    <ul class="list-inline">
                                        <li>
                                          <h6 class="text-muted text-info"><span style="color:#19b5fe;">Ejecucion</span></h6>
                                             </li>|
                                        <li>
                                          <h6 class="text-muted text-success"><span style="color:#ec644b;">Finalizadas</span></h6>
                                             </li>|
                                             <li>
                                          <h6 class="text-muted text-success"><span style="color:#FFCE56;">Neutralizadas</span></h6>
                                             </li>|
                                             <li>
                                          <h6 class="text-muted text-success"><span style="color:#bdc3c7;">Rescindidas</span></h6>
                                             </li>
                                    </ul>
                                </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Obras por Contrato</h3>
                                <h6 class="card-subtitle">Departamento técnico</h6>
                                <canvas id="proyectos" width="100%" height="60%"></canvas>
                              </div>
                                <div>
                                <hr class="m-t-0 m-b-0">
                            </div>
                                <div class="card-body text-center">
                                    <ul class="list-inline">
                                        <li>
                                          <h6 class="text-muted text-info"><a href="proyectos" style="text-decoration: none; color:#19b5fe;">Proyectos</a></h6>
                                             </li>|
                                        <li>
                                          <h6 class="text-muted text-success"><a href="modificaciones" style="text-decoration: none; color:#3fc380;">Modificaciones</a></h6>
                                             </li>|
                                             <li>
                                          <h6 class="text-muted text-success"><a href="ampliaciones" style="text-decoration: none; color:#FFCE56;">Ampliaciones</a></h6>
                                             </li>|
                                             <li>
                                          <h6 class="text-muted text-success"><a href="neutralizaciones" style="text-decoration: none; color:#bdc3c7;">Neutralizaciones</a></h6>
                                             </li>
                                    </ul>
                                </div>
                        </div>
                      <?php } ?>

</div>
</div>
</div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
var config2 = {
  type: 'horizontalBar',
  data: {
    labels: [' En ejecucion', ' Finalizadas', ' Neutralizadas', ' Rescindidas'],
    datasets: [{
      label: "Obras",
      data: [<?php  echo $conteo_obras_ejecutadas['total']; ?>,<?php echo $conteo_obras_finalizadas['total']; ?>,<?php  echo $conteo_obras_neutralizadas['total']; ?>,<?php  echo $conteo_obras_rescindidas['total']; ?>], 
      fill: false,
        backgroundColor: [
                  "#3fc380",
                  "#ec644b",
                  "#FFCE56",
                  "#bdc3c7",
             ]
    }]
  },
  options: {
    legend: {
      display: false
    },
            scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
  }
};
var config3 = {
  type: 'horizontalBar',
  data: {
    labels: [' Proyectos', ' Modificaciones', ' Ampliaciones', ' Neutralizaciones'],
    datasets: [{
      label: "Cantidad",
      data: [<?php  echo $conteo_proyectos['total']; ?>,<?php echo $conteo_obras_modificaciones['total']; ?>,<?php echo $conteo_obras_ampliaciones['total']; ?>,<?php echo $conteo_obras_neutralizaciones['total']; ?>], 
      fill: false,
        backgroundColor: [
                  "#19b5fe",
                  "#3fc380",
                  "#FFCE56",
                  "#bdc3c7",
             ]
    }]
  },
  options: {
    legend: {
      display: false
    },
        scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
  }
};

var obrasporcontrato = document.getElementById("obrasporcontrato").getContext("2d");
var proyectos = document.getElementById("proyectos").getContext("2d");
new Chart(obrasporcontrato, config2);
new Chart(proyectos, config3);
</script>
</div>
</div>
<script type="text/javascript">
        $( "#select_direccion" ).change(function() {
      var valor = $(this).val();
        $.post("includes/ajax/direccion-departamentos.php",  { valor: valor }).done(function(data) {
                    $('#departamentos').html(data);
});
});
</script>
<script>



$('#todos').on('change', function() {
    if ($(this).is(':checked') ) {
            $("#select_direccion").prop("disabled", true);
        } else  {
            $("#todos").prop("disabled", false);
            $("#select_direccion").prop("disabled", false);
        }
    });
    $("#select_direccion").change( function() {
        if ($(this).val() != "") {
            $("#todos").prop("disabled", true);
        } else {
            $("#select_direccion").prop("disabled", false);
        }
    });
</script>
<?php pie(); ?>


 pie(); ?>