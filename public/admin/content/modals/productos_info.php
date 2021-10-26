<?php
require_once('../../includes/load.php');
 $producto = find_by_id('insumos','idinsumos',$_POST['id']) ?>
<!-- Central Modal Small -->
<div class="modal fade" id="producto_info" tabindex="-1" role="dialog" aria-labelledby="producto_info" aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-md" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="producto_info">Informacion del producto</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          
            <div class="form-group p-l-20 p-r-20">
              <div class="row"><h3>
                <?php echo ucwords($producto['nombre']); ?></h3>
                </div>
                <div class="row">
                <?php echo find_select('nombre','categorias','idcategorias',$producto['idcategorias']) ?>
                </div>
                <div class="row p-10" style="border:1px solid #000;font-size: 24px; background:#f0f0f0;">
                <?php echo 'Stock: '.numero_stock($producto['unidad'],$producto['cantidades']).' '.$producto['unidad']; ?>
                </div>
                <div class="row p-t-10">
                <?php echo 'Responsable: '.$producto['cargo']; ?>
                </div>
                <div class="row">
                <?php echo 'Departamento: '.find_select('nombre','departamentos','iddepartamentos',$producto['iddepartamentos']) ?>
                </div>
                <div class="row">
                <?php echo 'Direccion: '.find_select('nombre','direcciones','iddireccion',$producto['iddireccion']) ?>
                </div>
                <div class="row p-t-20">
                <?php echo 'Registro: '.format_dyt($producto['registro_fecha']).''.user_name($producto['registro_usuario']); ?>
                </div>
          </div>
        </div>
        <div class="modal-footer">

      </div>
    </div>
  </div>
</div>