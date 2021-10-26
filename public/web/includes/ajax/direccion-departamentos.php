<?php 
require_once('../../includes/load.php');
$valor = $_POST['valor'];
$departamentos = find_departamentos($valor);
 ?>
                     <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Departamento</label>
                        <select class="form-control custom-select" name="iddepartamentos">
                          <option selected disabled>Seleccione un departamento</option>
                          <?php foreach ($departamentos as $dpto ):?>
                            <option value="<?php echo $dpto['iddepartamentos'];?>"><?php echo ucwords($dpto['nombre']);?></option>
                          <?php endforeach;?>
                        </select>
                      </div> 
                    </div>