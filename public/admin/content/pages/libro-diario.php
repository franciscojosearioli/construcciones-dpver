<?php 
require_once('../../includes/load.php');
cabecera('Libro diario');
$user = current_user();
?>
<div id="container_libro-diario">
<div class="container">
  <div class="row justify-content-center pt-4 text-center">
    <p class="titulo-bienvenida p-b-20">Registrar nuevo tramite </p>
  </div>
  </div>

  <div class="row justify-content-md-center">
    <div class="col-lg-10 col-md-12 col-sm-12 offset-md-3">
      <div class="row justify-content-md-center">

        <div class="col-lg-4 col-md-4 col-sm-12">

        <a id="btn_agregar_notas" onclick="form_agregar_nota(true)" title="Agregar nuevo" data-toggle="tooltip">
          <div class="card">
            <div class="card-body mx-4">
              Nota
            </div>
          </div>
        </a>

        </div>

        <div class="col-lg-4 col-md-4 col-sm-12">

        <a id="btn_agregar_expedientes" onclick="form_agregar_expediente(true)" title="Agregar nuevo" data-toggle="tooltip">
        <div class="card">
            <div class="card-body mx-4">
            Expediente
            </div>
          </div>
        </a>

        </div>

      </div>

    </div>
  </div>

  <div class="container">
  <div class="row justify-content-center pt-4 text-center">
    <p class="titulo-bienvenida p-b-20">Consultar tramites </p>
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
          <div class="card">
            <div class="card-body mx-4">
              Numero o asunto del tramite
            </div>
          </div>

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

    </div>
  </div>
  </div>
  <script type="text/javascript" src="includes/ajax/scripts/libro-diario.js"></script>
<?php 
     require_once('../forms/agregar_notas.php');
require_once('../forms/localizar_expedientes.php');
pie(); ?>