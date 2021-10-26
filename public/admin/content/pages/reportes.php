<?php
require_once('../../includes/load.php');
// USUARIOS
$user = current_user();
$user_director = find_by_id('departamentos','iddireccion',$user['iddireccion']);
$user_departamento = find_by_id('depratamentos','iddepartamentos',$user['iddepartamentos']);
$all_users = find_all_user_msj('usuarios',$user['id']);
$notificaciones = notificaciones();
$direcciones = find_all('direcciones');
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
cabecera('Reportes'); 
?>
<!--<div class="row p-t-20">
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
</div>-->
                    
                    <div class="col-lg-5 col-md-5 col-sm-12 mx-auto">
                    <br>
  <div class="alert alert-info" role="alert">
  Este complemento esta siendo modificado. 
  <a href="javascript:history.back();">Haga click aqui para volver a la pagina anterior.</a>
</div>
        <!--<div class="card card-signin">
          <div class="header pt-3">
                              <div class="row d-flex justify-content-start">
                                  <h3 class="deep-grey-text pb-1 mx-5">Generar reporte</h3>
                              </div>
                          </div>

<div class="card-body mx-4" >   
              <form method="post" action="reportes">    
                <div class="form-group p-20">
                  <div class="row p-t-20">
                    <div class="col-12">
                        <select class="form-control custom-select" name="tema" required>
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
                    <input type="submit" name="consultar" value="Generar" >
                  </div>
                </div>
              </form> 
</div>
    </div>-->


</div>
</div>
</div>

</div>

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