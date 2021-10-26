<?php 
require_once('../../includes/load.php');
$valor = $_POST['valor'];
if($valor == 3){
 ?>
                     <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Detalles estado finalizado</label>
                        <select class="form-control custom-select" name="idestado_finalizado">
                          <option selected disabled>Seleccione un estado</option>
                            <option value="0">Finalizada sin recibir</option>
                            <option value="1">En garantia</option>
                            <option value="2">Finalizada definitiva</option>
                        </select>
                      </div> 
                    </div>
                  <?php } ?>
