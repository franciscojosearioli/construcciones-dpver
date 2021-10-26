<?php 
require_once('../../includes/load.php');
require_once('../../includes/functions/tramites.php');
cabecera('Mesa virtual');
$user = current_user();
?>
<div id="container_libro-diario">
<div class="container">
  <div class="row">
    <p class="titulo-bienvenida p-b-20">Registrar nuevo tramite </p>
  </div>
  </div>

<div class="row justify-content-center">
<div class="col-lg-10 col-md-12 col-sm-12 offset-md-3">
<div class="row justify-content-center" id="tramites">
<div class="p-20">
<a id="btn_agregar_notas" onclick="form_agregar_nota(true)" title="Agregar nuevo" data-toggle="tooltip">
<div class="card">
<div class="card-body mx-4">
Presentacion / Nota
</div>
</div>
</a>
</div>
<div class="p-20">
<a id="btn_agregar_expedientes" onclick="form_agregar_expediente(true)" title="Agregar nuevo" data-toggle="tooltip">
<div class="card">
<div class="card-body mx-4">
Expediente
</div>
</div>
</a>
</div>
<div class="p-20">
<a id="btn_agregar_memorandums" onclick="form_agregar_memorandum(true)" title="Agregar nuevo" data-toggle="tooltip">
<div class="card">
<div class="card-body mx-4">
Memorandum
</div>
</div>
</a>
</div>
      </div>

<?php
require_once('../forms/tipo_memorandum.php'); ?>
    </div>
 <!--
      <div class="container">
  <div class="row">
    <p class="titulo-bienvenida p-b-20">Ultimos tramites ingresados</p>
  </div>
  </div>
  <div class="row justify-content-md-center">
    <div class="col-lg-3 col-md-3 col-sm-12 offset-md-3">
        <div class="card card-signin">
<div class="card-body mx-4" >   
  
<h4>Expedientes</h4>
</div>
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-12 offset-md-3">
        <div class="card card-signin">
<div class="card-body mx-4" >   
  
<h4>Notas</h4>
</div>
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-12 offset-md-3">
        <div class="card card-signin">
<div class="card-body mx-4" >   
  
<h4>Recepciones</h4>
</div>
</div>
</div>
</div>
  <div class="row justify-content-md-center">
<div class="col-lg-3 col-md-3 col-sm-12 offset-md-3">
        <div class="card card-signin">
<div class="card-body mx-4" >   
  
<h4>Modificaciones</h4>
</div>
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-12 offset-md-3">
        <div class="card card-signin">
<div class="card-body mx-4" >   
  
<h4>Ampliaciones</h4>
</div>
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-12 offset-md-3">
        <div class="card card-signin">
<div class="card-body mx-4" >   
  
<h4>Neutralizaciones</h4>
</div>
</div>
</div>
</div>

  <div class="row justify-content-md-center">
<div class="col-lg-3 col-md-3 col-sm-12 offset-md-3">
        <div class="card card-signin">
<div class="card-body mx-4" >   
  
<h4>Certificados de obra</h4>
</div>
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-12 offset-md-3">
        <div class="card card-signin">
<div class="card-body mx-4" >   
  
<h4>Certificados redeterminados</h4>
</div>
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-12 offset-md-3">
        <div class="card card-signin">
<div class="card-body mx-4" >   
  
<h4>Redeterminaciones de precios</h4>
</div>
</div>
</div>
</div>
    
 <div class="container">
  <div class="row">
    <p class="titulo-bienvenida p-b-20">Consultar movimientos del tramite </p>
  </div>
  </div>

  <div class="row justify-content-md-center">
    <div class="col-lg-10 col-md-12 col-sm-12 offset-md-3">
      <div class="row justify-content-md-center">

        <div class="col-lg-4 col-md-4 col-sm-12">

          <div class="card">
            <div class="card-body mx-4">
              Numero o asunto del tramite
            </div>
          </div>
          <div><button class="btn btn-warning">Consultar</button></div><br><br>

        </div>

        <div class="col-lg-2 col-md-2 col-sm-12">

          <div class="card">
            <div class="card-body mx-4">
            Fecha desde
            </div>
          </div>

        </div>
        <div class="col-lg-2 col-md-2 col-sm-12">

          <div class="card">
            <div class="card-body mx-4">
            Fecha hasta
            </div>
          </div>

        </div>

      </div>

    </div>-->

      <div class="container">
  <div class="row">
    <p class="titulo-bienvenida p-b-20">Consultar Reportes </p>
  </div>
  </div>
  <div class="row justify-content-md-center">
    <div class="col-lg-8 col-md-8 col-sm-12 offset-md-3">
        <div class="card card-signin">
<div class="card-body mx-4" >   
  
<h4>Generar Nuevo Reporte</h4>
              <form method="post" action="reportes">    
                <div class="form-group p-20">
                    Informacion del tramite
                <div class="row p-t-20">
                    <div class="col-12">
                        <select class="form-control custom-select" name="tema">
                          <option selected disabled>Seleccione el tipo de tramite</option>
                            <option value="expedientes">Expediente</option>
                            <option value="notas">Presentacion / Nota</option>
                        </select>
                      </div> 
                    </div>
                <div class="row p-t-20">
                    <div class="col-6">
                    Desde
                      <input type="date" class="form-control" name="fecha_inicio" required>
                    </div>
                    <div class="col-6">
                    Hasta
                      <input type="date" class="form-control" name="fecha_fin" required>
                    </div>
                  </div>
                  <br>
                    Dependencia del tramite

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
                    <div class="col-12">
   <input class="form-check-input" type="checkbox" name="todos" id="todos" value="1">
    <label class="form-check-label" for="todos">
      Buscar todo
    </label>
                      </div> 
                    </div>
                  <div class="row p-t-20 justify-content-center">
                    <input type="submit" name="consultar" value="Generar" >
                  </div>
                </div>
              </form> 
</div>
    </div>

  </div></div>
                </div>
  
  
  </div>
  
  <script type="text/javascript" src="includes/ajax/scripts/mesa-virtual.js"></script>
<?php 
     require_once('../forms/memo_llegada_tarde.php');
     require_once('../forms/memo_comision.php');
     require_once('../forms/memo_egreso.php');
     require_once('../forms/agregar_notas.php');
require_once('../forms/localizar_expedientes.php');
pie(); ?>