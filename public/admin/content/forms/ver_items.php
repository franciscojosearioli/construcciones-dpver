<div class="row justify-content-center" id="ver-items">
  <div class="col-8">
    <div class="card">
      <div class="card-body cards-titulo">
        <div class="d-flex flex-wrap">
          <div class="my-auto ml-3">
            ITEMS > id:<?php echo $_POST['id']; ?>
          </div>
          <div class="ml-auto my-auto mr-3">
            <a onclick="cancelar_items()" title="Cerrar" data-toggle="tooltip"><i class="fas fa-times"></i></a>
          </div>
        </div>
      </div>
      <div class="card-body">
        Descripcion de precios: <input type="text" name="">
        <table>
          <tr>
            <th>Item</th>
            <th>Unidad</th>
            <th>Precio unitario</th>
            <th></th>
          </tr>
          <tr>
            <td><input type="text" name=""></td>
            <td><input type="text" name=""></td>
            <td><input type="text" name=""></td>
            <td>+</td>
          </tr>
        </table>
      </div>

            <div class="card-body">
<hr class="m-t-0 m-b-0">
              <div class="row p-t-20">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h6 class="text-muted"><a onclick="cancelar_agregar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                        <h6 class="text-muted"><a onclick="submit_agregar();" class="dropdown-item a-icon" data-toggle="tooltip" title="Confirmar"><i class="fas fa-check fa-2x"></i></a></h6> 
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
            </div>  
    </div>
  </div>
</div>