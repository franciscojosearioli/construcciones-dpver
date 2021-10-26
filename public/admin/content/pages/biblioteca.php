<?php
require_once('../../includes/load.php');
$user = current_user();

require_once('../../includes/functions/php_file_tree.php');   
cabecera('Biblioteca de archivos');
 ?>
         <div class="row justify-content-center" >
        <div class="col-8">
          <div class="card">
                <div class="card-body cards-titulo">
            <div class="d-flex flex-wrap">
              <div class="my-auto ml-3" style="padding:10px">
                Archivos  de obras
              </div>
            </div>
            <div class="table-responsive p-20" style="background-color: #f9f9f9">
          <?php
          $allowed_extensions = array("gif", "jpg", "jpeg", "png", "xls", "doc", "dwg", "pdf");
          echo php_file_tree("../../../uploads/Obras", "[link]", $allowed_extensions);
          ?> 
        </div>
           </div>
          </div>
        </div>
</div>
<script>
$(document).ready(function(){
        init_php_file_tree();
    });
</script>
<?php 
pie(); 
?>