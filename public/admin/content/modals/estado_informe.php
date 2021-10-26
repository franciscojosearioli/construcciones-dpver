<?php
require_once('../../includes/load.php');
$obra_id = $_POST['id'];
$obra = find_by_id('obras', 'idobras', $obra_id);
$user = current_user();
?>
<div class="modal" id="estado_informe" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Estado del informe de obra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4">

            <div class="container">

        </div>
<div class="container">
<?php 
                      //$columnas = obtener_columnas('obras');
                     // echo $columnas;
                      ?>
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                            <h5>Datos actualizados a la fecha</h5>
                            <?php if($obra['nombre'] != NULL){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Titulo de obra</p>
                            <?php } ?>
                            <?php if($obra['descripcion'] != NULL){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Descripcion de obra</p>
                            <?php } ?>
                            <?php if($obra['numero'] != NULL){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Numero de caja</p>
                            <?php } ?>
                            <?php if($obra['expediente'] != NULL){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Expediente</p>
                            <?php } ?>
                            <?php if(!empty($obra['proyecto_monto'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Presupuesto de proyecto</p>
                            <?php } ?>
                            <?php if(!empty($obra['proyecto_monto_fecha'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Fecha del presupuesto de proyecto</p>
                            <?php } ?>
                            <?php if(!empty($obra['proyecto_plazo'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Fecha Plazo de ejecucion</p>
                            <?php } ?>
                            <?php if(!empty($obra['longitud'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Longitud de obra</p>
                            <?php } ?>
                            <?php if(!empty($obra['fecha_inicio'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Fecha Inicio de obra</p>
                            <?php } ?>
                            <?php if(!empty($obra['fecha_fin_no_define'])){ if(!empty($obra['fecha_fin'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Fecha Fin de obra</p>
                            <?php }} ?>
                            <?php if(!empty($obra['proyectista'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Proyectista</p>
                            <?php } ?>
                            <?php if(!empty($obra['memoria_descriptiva'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Memoria descriptiva</p>
                            <?php } ?>
                            <?php if(!empty($obra['memoria_descriptiva_vigente'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Memoria descriptiva vigente</p>
                            <?php } ?>
                            <?php if(!empty($obra['plazo_garantia'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Fecha Plazo de garantia</p>
                            <?php } ?>
                            <?php if(!empty($obra['tipo_financiamiento'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Fuente de Financiacion</p>
                            <?php } ?>
                            <?php if(!empty($obra['tipo_contratacion'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Tipo de contratacion</p>
                            <?php } ?>
                            <?php if(!empty($obra['aprobacion_res_num']) || empty($obra['aprobacion_res_fecha'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Resolucion de aprobacion</p>
                            <?php } ?>
                            <?php if(!empty($obra['adjudicacion_res_num']) || empty($obra['adjudicacion_res_fecha'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Resolucion de adjudicacion</p>
                            <?php } ?>
                            <?php if(!empty($obra['contratista'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Contratista</p>
                            <?php } ?>
                            <?php if(!empty($obra['contrato_fecha'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Fecha de contrato</p>
                            <?php } ?>
                            <?php if(!empty($obra['contrato_monto'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Monto de contrato</p>
                            <?php } ?>
                            <?php if(!empty($obra['monto_vigente'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Monto de obra vigente</p>
                            <?php } ?>
                            <?php if(!empty($obra['monto_redeterminado'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Monto de obra redeterminado</p>
                            <?php } ?>
                            <?php if(!empty($obra['idinspector'])){ ?>
                            <p style="color:green"><i class="fas fa-check p-r-10"></i> Inspector de obra</p>
                            <?php } ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                            <h5>Datos incompletos</h5>
                        <?php if($obra['nombre'] == NULL){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Titulo de obra</p>
                            <?php } ?>
                            <?php if($obra['descripcion'] == NULL){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Descripcion de obra</p>
                            <?php } ?>
                            <?php if($obra['numero'] == NULL){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Numero de caja</p>
                            <?php } ?>
                            <?php if($obra['expediente'] == NULL){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Expediente</p>
                            <?php } ?>
                            <?php if(empty($obra['proyecto_monto'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Presupuesto de proyecto</p>
                            <?php } ?>
                            <?php if(empty($obra['proyecto_monto_fecha'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Fecha del presupuesto de proyecto</p>
                            <?php } ?>
                            <?php if(empty($obra['proyecto_plazo'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Fecha Plazo de ejecucion</p>
                            <?php } ?>
                            <?php if(empty($obra['longitud'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Longitud de obra</p>
                            <?php } ?>
                            <?php if(empty($obra['fecha_inicio'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Fecha Inicio de obra</p>
                            <?php } ?>
                            <?php if(empty($obra['fecha_fin_no_define'])){ if(empty($obra['fecha_fin'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Fecha Fin de obra</p>
                            <?php }} ?>
                            <?php if(empty($obra['proyectista'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Proyectista</p>
                            <?php } ?>
                            <?php if(empty($obra['memoria_descriptiva'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Memoria descriptiva</p>
                            <?php } ?>
                            <?php if(empty($obra['memoria_descriptiva_vigente'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Memoria descriptiva vigente</p>
                            <?php } ?>
                            <?php if(empty($obra['plazo_garantia'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Fecha Plazo de garantia</p>
                            <?php } ?>
                            <?php if(empty($obra['tipo_financiamiento'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Fuente de Financiacion</p>
                            <?php } ?>
                            <?php if(empty($obra['tipo_contratacion'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Tipo de contratacion</p>
                            <?php } ?>
                            <?php if(empty($obra['aprobacion_res_num']) || empty($obra['aprobacion_res_fecha'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Resolucion de aprobacion</p>
                            <?php } ?>
                            <?php if(empty($obra['adjudicacion_res_num']) || empty($obra['adjudicacion_res_fecha'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Resolucion de adjudicacion</p>
                            <?php } ?>
                            <?php if(empty($obra['contratista'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Contratista</p>
                            <?php } ?>
                            <?php if(empty($obra['contrato_fecha'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Fecha de contrato</p>
                            <?php } ?>
                            <?php if(empty($obra['contrato_monto'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Monto de contrato</p>
                            <?php } ?>
                            <?php if(empty($obra['monto_vigente'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Monto de obra vigente</p>
                            <?php } ?>
                            <?php if(empty($obra['monto_redeterminado'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Monto de obra redeterminado</p>
                            <?php } ?>
                            <?php if(empty($obra['idinspector'])){ ?>
                            <p style="color:red"><i class="fas fa-times p-r-10"></i> Inspector de obra</p>
                            <?php } ?>
                            </div>
                        </div>
                        
                       


                            </div>
                          </div>    

            </div>
        </div>
    </div>
</div>