<?php
require_once('../../includes/load.php');
$exp = $_GET['id'];
if(!empty($exp)){ 
$tramite = find_by_id('tramites','numero',$exp);
$pases_tramite = tramites_movimientos($tramite['idtramites']);
$inicio_exp = buscar_expediente($exp);
$pases_expediente = pases_expediente($exp);
$pases_construcciones = tramites_movimientos($tramite['idtramites']);

cabecera('Tramite N: '.$exp);
if(!empty($inicio_exp)){

  
?>   
<div class="row">
    <p class="titulo-bienvenida p-20">
   Tramite
    </p>
  </div>
     <div class="row justify-content-center" >
         <div class="col-7">
          <div class="card">
            <div class="card-body mx-4">
              <div class="d-flex flex-wrap p-b-30">
            
                         <div class="my-auto">
<label class="control-label text-muted" style="font-size:11px;">Tipo de tramite</label> 
<h4><?php if(isset($exp)){ echo $inicio_exp['tipo'];} ?></h4>
<label class="control-label text-muted" style="font-size:11px;">Numero del tramite</label> 
<h1><?php echo $exp; ?></h1>

<label class="control-label text-muted" style="font-size:11px;">Asunto del tramite</label> 
<h3><?php echo utf8_encode($inicio_exp['asunto']); ?></h3>
<label class="control-label text-muted" style="font-size:11px;">Iniciador del tramite</label> 
<h4>Iniciado por <?php echo utf8_encode($inicio_exp['iniciador']); ?> el <?php if(isset($exp)){ echo format_date($inicio_exp['fechareg']);} ?></h4>
<?php
if(ifexist($exp)){  
$ul_mov_exp = ul_mov_exp($exp); ?>
<label class="control-label text-muted" style="font-size:11px;">Ultimo movimiento del tramite</label> 
<h4><?php echo utf8_encode($ul_mov_exp['tramite']); if(!empty($ul_mov_exp['fecha'])){ echo ' desde '.format_date($ul_mov_exp['fecha']);} ?></h4>
  <?php } ?>
<?php
if(ifexist($exp)){  
$ul_mov_tramite = ul_mov_tramite($tramite['idtramites']); 
if(!empty($ul_mov_tramite)){?>
<label class="control-label text-muted" style="font-size:11px;">Ultimo movimiento del tramite en Construcciones</label> 
<h3><?php  echo find_select('nombre','departamentos','iddepartamentos',$ul_mov_tramite['iddepartamentos']); if(!empty($ul_mov_tramite['fecha'])){ echo ' desde '.format_date($ul_mov_tramite['fecha']);}}else{echo ''; ?></h3>
  <?php }} if(!empty($tramite['observaciones'])){ ?>
<label class="control-label text-muted" style="font-size:11px;">Observaciones</label> 
<h4><?php  echo $tramite['observaciones'];?></h4>
<?php } ?>
              </div>
              </div>
            </div></div></div> 
            <div class="col-3">
               
            <div class="card">
            <div class="card-body mx-4 text-center">
            <form method="get" action="tramite"> 
<div><button type="submit" class="btn-sm" style="border: 1px solid #000;background: none;margin-bottom:15px;">Nueva consulta</button> </div>
<i class='ti-search'></i> <input type="number" name="id" style="background: #fff;width:100px;height:20px;min-height:20px; border:none;" class="form-control" autocomplete="off" value="<?php echo $exp; ?>" required>

</form>  
            </div>
          </div>
            
          <!--<div class="row">
    <p class="titulo-bienvenida p-20">
    Injerencias en tramite
    </p>
  </div>
  <div class="card">
            <div class="card-body mx-4">
<label class="control-label text-muted" style="font-size:11px;">Adjunto al tramite</label> 
<h3>N ___ el ___</h3>
<label class="control-label text-muted" style="font-size:11px;">Desgloso al tramite</label> 
<h3>N ___ el ___</h3>
            </div>
          </div>-->

          </div>
          
          </div>      
               <div class="row">
    <p class="titulo-bienvenida p-20">
   Movimientos del tramite
    </p>
  </div>
<div class="row justify-content-center" >
         <div class="col-10">
          <div class="card">
            <div class="card-body mx-4">              
                <div class="table-responsive">
                  <table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                      <th></th>
                      <th></th>
                        <th class='text-center' style='width: 10%;'> Fecha </th>
                        <th class='text-center' style='width: 50%;'> Ubicacion </th>
                        <th class='text-center' style='width: 10%;'> Nota </th>
                        <th class='text-center' style='width: 10%;'> Folios </th>
                        <th class='text-center' style='width: 10%;'> Norma </th>
                        <th class='text-center' style='width: 10%;'> Norma Nº </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($pases_expediente as $pases_exp): ?>
                        <tr>
                        <td></td>
                        <td></td>
                          <td><b><?php echo format_date($pases_exp['fecha']); ?></b></td>
                          <td><b><?php echo utf8_encode($pases_exp['tramite']); ?></b></td>
                          <td><b><?php echo utf8_encode($pases_exp['nota']); ?></b></td>
                          <td><b><?php echo utf8_encode($pases_exp['nfolios']); ?></b></td>
                          <td><b><?php echo utf8_encode($pases_exp['norma_tipo']); ?></b></td>
                          <td><center><b><?php echo utf8_encode($pases_exp['norma_nro']); ?></b></center></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                      <th></th>
                      <th></th>
                        <th class='text-center' style='width: 10%;'> Fecha </th>
                        <th class='text-center' style='width: 50%;'> Ubicacion </th>
                        <th class='text-center' style='width: 10%;'> Nota </th>
                        <th class='text-center' style='width: 10%;'> Folios </th>
                        <th class='text-center' style='width: 10%;'> Norma </th>
                        <th class='text-center' style='width: 10%;'> Norma Nº </th>
                      </tr>
                    </tfoot>
                  </table>
              </div>
            </div>
          </div>
        </div>  
        </div>    
        <div class="row">
    <p class="titulo-bienvenida p-20">
   Movimientos del tramite en Construcciones
    </p>
  </div>
<div class="row justify-content-center" >
         <div class="col-10">
          <div class="card">
            <div class="card-body mx-4">              
                <div class="table-responsive">
                  <table id="all2" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                      <th></th>
                      <th></th>
                        <th class='text-center' style='width: 10%;'> Fecha </th>
                        <th class='text-center' style='width: 30%;'> Ubicacion </th>
                        <th class='text-center' style='width: 10%;'> Folios </th>
                        <th class='text-center' style='width: 10%;'> Norma </th>
                        <th class='text-center' style='width: 10%;'> Norma Nº </th>
                        <th class='text-center' style='width: 25%;'> Observaciones </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($pases_tramite as $pases): ?>
                        <tr>
                        <td></td>
                        <td></td>
                          <td><?php echo format_date($pases['fecha']); ?></td>
                          <td><?php echo find_select('nombre','departamentos','iddepartamentos',$pases['iddepartamentos']); ?> (<?php echo find_select('nombre','direcciones','iddireccion',$pases['iddireccion']); ?>)</td>
                          <td><?php echo $pases['folios']; ?></td>
                          <td><?php echo $pases['norma_tipo']; ?></td>
                          <td><?php echo $pases['norma_numero']; ?></td>
                          <td><?php echo $pases['observaciones']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                      <th></th>
                      <th></th>
                        <th class='text-center' style='width: 10%;'> Fecha </th>
                        <th class='text-center' style='width: 30%;'> Ubicacion </th>
                        <th class='text-center' style='width: 10%;'> Folios </th>
                        <th class='text-center' style='width: 10%;'> Norma </th>
                        <th class='text-center' style='width: 10%;'> Norma Nº </th>
                        <th class='text-center' style='width: 25%;'> Observaciones </th>
                      </tr>
                    </tfoot>
                  </table>
              </div>
            </div>
          </div>
        </div>  
        </div>    
        <?php }else{ ?>  
 
                       <div class="row">
    <p class="titulo-bienvenida p-20">
   Tramite
    </p>
  </div>
     <div class="row justify-content-center" >
         <div class="col-7">
          <div class="card">
            <div class="card-body mx-4">
              <div class="d-flex flex-wrap p-b-30">
            
                         <div class="my-auto">
<label class="control-label text-muted" style="font-size:11px;">Tipo de tramite</label> 
<h3><?php if(isset($exp)){ echo ucfirst($tramite['tipo']);} ?></h3>
<label class="control-label text-muted" style="font-size:11px;">Numero del tramite</label> 
<h1><?php echo $exp; ?></h1>

<label class="control-label text-muted" style="font-size:11px;">Asunto del tramite</label> 
<h2><?php echo utf8_encode($tramite['asunto']); ?></h2>
<label class="control-label text-muted" style="font-size:11px;">Iniciador del tramite</label> 
<h3>Iniciado por <?php echo utf8_encode($tramite['iniciador']); ?> el <?php if(isset($exp)){ echo format_date($tramite['fecha_inicio']);} ?></h3>
<?php
if(ifexist($exp)){  
$ul_mov_tramite = ul_mov_tramite($tramite['idtramites']); ?>
<label class="control-label text-muted" style="font-size:11px;">Ultimo movimiento del tramite en Construcciones</label> 
<h3><?php if(!empty($ul_mov_tramite)){ echo find_select('nombre','departamentos','iddepartamentos',$ul_mov_tramite['iddepartamentos']); if(!empty($ul_mov_tramite['fecha'])){ echo ' desde '.format_date($ul_mov_tramite['fecha']);}}else{echo 'No hay movimientos';} ?></h3>
  <?php } ?>

              </div>
              </div>
            </div></div></div> 
            <div class="col-3">
               
            
            

          </div>
          
          </div>      
<div class="row">
    <p class="titulo-bienvenida p-20">
   Movimientos del tramite en Construcciones
    </p>
  </div>
<div class="row justify-content-center" >
         <div class="col-10">
          <div class="card">
            <div class="card-body mx-4">              
                <div class="table-responsive">
                  <table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                      <th></th>
                        <th class='text-center' style='width: 10%;'> Fecha </th>
                        <th class='text-center' style='width: 30%;'> Ubicacion </th>
                        <th class='text-center' style='width: 10%;'> Folios </th>
                        <th class='text-center' style='width: 10%;'> Norma </th>
                        <th class='text-center' style='width: 10%;'> Norma Nº </th>
                        <th class='text-center' style='width: 25%;'> Observaciones </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($pases_construcciones as $pases): ?>
                        <tr>
                        <td></td>
                          <td><?php echo format_date($pases['fecha']); ?></td>
                          <td><?php echo find_select('nombre','departamentos','iddepartamentos',$pases['iddepartamentos']); ?> (<?php echo find_select('nombre','direcciones','iddireccion',$pases['iddireccion']); ?>)</td>
                          <td><?php echo $pases['folios']; ?></td>
                          <td><?php echo $pases['norma_tipo']; ?></td>
                          <td><?php echo $pases['norma_numero']; ?></td>
                          <td><?php echo $pases['observaciones']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                      <th></th>
                        <th class='text-center' style='width: 10%;'> Fecha </th>
                        <th class='text-center' style='width: 30%;'> Ubicacion </th>
                        <th class='text-center' style='width: 10%;'> Folios </th>
                        <th class='text-center' style='width: 10%;'> Norma </th>
                        <th class='text-center' style='width: 10%;'> Norma Nº </th>
                        <th class='text-center' style='width: 25%;'> Observaciones </th>
                      </tr>
                    </tfoot>
                  </table>
              </div>
            </div>
          </div>
        </div>  
        </div>    

            
             
          <?php } } ?>
                      
          <?php 
pie(); ?><script>
$('#all2').DataTable({
    dom: '<"top"flBp>irt<"bottom"i><"clear">flBp',
        "fnInitComplete": function(){
            // Disable TBODY scoll bars
            
            // Enable TFOOT scoll bars
            //$('.dataTables_scrollFoot').css('overflow', 'auto');
            
            $('.dataTables_scrollHead').css('overflow', 'auto');
            
            // Sync TFOOT scrolling with TBODY
            $('.dataTables_scrollFoot').on('scroll', function () {
                $('.dataTables_scrollBody').scrollLeft($(this).scrollLeft());
            });      
            
            $('.dataTables_scrollHead').on('scroll', function () {
                $('.dataTables_scrollBody').scrollLeft($(this).scrollLeft());
            });
        },
        language: {
            buttons: {
                copy: 'Copiar',
                excel: 'Exportar a Excel',
                csv: 'Exportar a CSV',
                pdf: 'Exportar a PDF',
                colvis: 'Filtrar datos',
                print: 'Imprimir'
            }
        },
        fixedHeader: {
            header: true,
            footer: true
        },
        buttons: [
        {
            extend: 'collection',
            text: 'Exportar',
            buttons: ['copy','excel','csv','pdf','print']
        },
        { extend: 'colvis',
          text: 'Filtro'  }
        ],
        columnDefs: [
        {
            targets: 0,
            className: 'select-checkbox',
            checkboxes: {
                selectRow: true
            }
        },
        {
            orderable: false,
            targets: [0,1]
        }
        ],
        select: 
        {
            selector: 'td:first-child',
            style: 'multi'
        },
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        scrollY:        "300px",
        fixedColumns:   {
            heightMatch: 'none'
        }
        });
            </script>