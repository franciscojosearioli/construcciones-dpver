            <div class="row p-20 justify-content-center">       
              <h5><b>NUEVA MODIFICACION DE OBRA </b></h5>
            </div> 
                        <div class="row p-t-20">
              <div class="col-12">
              <label class="control-label">Estado del tramite</label>
                <select class="form-control custom-select" name="add_estado">
                  <option selected disabled>Seleccione un estado</option>
                    <option value="1">1. Confeccion Inspeccion</option>
                    <option value="2">2. Revision Dpto. II Obras por contrato</option>
                    <option value="3">3. Autorizando Ing. Jefe</option>
                    <option value="4">4. Encuadre Legal</option>
                    <option value="5">5. Imputacion del Gasto</option>
                    <option value="6">6. Confeccionando Resolucion</option>
                    <option value="7">7. Resolucion aprobada</option>
                </select>
              </div> 
              </div>
              <div class="row p-t-20">
              <!--<div class="col-md-4">
                <div class="md-form form-md">
                  <label class="control-label">Porcentaje a tramitar</label>
                  <input type="number" name="add_porcentaje_monto" class="form-control" max="100" value="<?php echo $obra['porcentaje_monto'];?>" step=".001" required>
                </div>
              </div> -->
              <div class="col-md-6">
                <div class="md-form form-md">
                  <label class="control-label">Monto a tramitar</label>
                  <input type="number" name="add_monto" class="form-control" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" value="<?php echo $obra['monto'];?>" required>
                </div>
              </div> 
              <div class="col-md-6">
                <div class="md-form form-md">
                  <label class="control-label">Monto final</label>
                  <input type="number" name="add_monto_final" class="form-control" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" value="<?php echo $obra['monto'];?>" required>
                </div>
              </div>   
            </div>
            <div class="row p-t-20">
              <div class="col-md-2">
                <div class="md-form form-md">
                  <label class="control-label">Numero</label>
                  <input type="text" name="add_numero" class="form-control">
                  <small class="form-control-feedback"> Modificacion </small>
                </div>
              </div>  
              <div class="col-md-3">
                <div class="md-form form-md">
                  <label class="control-label">Nº Expediente</label>
                  <input type="text" name="add_expediente" class="form-control">
                </div>
              </div>                          
              <div class="col-md-4">
                <div class="md-form form-md">
                  <label class="control-label">Resolucion</label>
                  <input type="date" name="add_resolucion_fecha" class="form-control">
                  <small class="form-control-feedback"> Fecha </small> 
                </div>
              </div>   
              <div class="col-md-3">
                <div class="md-form form-md">
                  <label class="control-label">&nbsp;</label>
                  <input type="text" name="add_resolucion_numero" class="form-control">
                  <small class="form-control-feedback"> Numero </small> 
                </div>
              </div>  
            </div>
            <div class="row p-t-20">
              <div class="col-md-12">
                <div class="md-form">
                  <label class="control-label">Informacion general</label>
                  <textarea name="add_descripcion" class="form-control" rows="5" ></textarea>
                  <small class="form-control-feedback"> Descripcion de la modificacion </small> 
                </div>
              </div>                        
            </div>
            <hr> 
            <div class="row p-t-20">
              <div class="col-md-3">
                <div class="md-form form-md">
                  <label class="control-label">Computo</label>
                  <select class="form-control custom-select" name="add_computo_estado">
                    <option selected disabled="">Seleccione un estado</option>
                    <option value="0">Sin definir</option>
                    <option value="1">Recibido</option>
                    <option value="2">Empresa</option>
                    <option value="3">Aprobado</option>
                </select>
                  <small class="form-control-feedback"> Estado </small>
                </div>
              </div>  
              <div class="col-md-3">
                <div class="md-form form-md">
                  <label class="control-label">&nbsp;</label>
                  <input type="date" name="add_computo_fecha" class="form-control">
                  <small class="form-control-feedback"> Fecha </small>
                </div>
              </div>                          
              <div class="col-md-3">
                <div class="md-form form-md">
                  <label class="control-label">Precios</label>
                  <select class="form-control custom-select" name="add_precios_estado">
                    <option selected disabled="">Seleccione un estado</option>
                    <option value="0">Sin definir</option>
                    <option value="1">Recibido</option>
                    <option value="2">Empresa</option>
                    <option value="3">Aprobado</option>
                </select>
                  <small class="form-control-feedback"> Estado </small> 
                </div>
              </div>   
              <div class="col-md-3">
                <div class="md-form form-md">
                  <label class="control-label">&nbsp;</label>
                  <input type="date" name="add_precios_fecha" class="form-control">
                  <small class="form-control-feedback"> fecha </small> 
                </div>
              </div>  
            </div>
            <div class="row p-t-20">
              <div class="col-md-12">
                <div class="md-form">
                  <label class="control-label">Observaciones</label>
                  <textarea name="add_observaciones" class="form-control" rows="3" ></textarea>
                </div>
              </div>                        
            </div>