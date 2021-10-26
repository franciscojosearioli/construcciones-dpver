<?php require_once('../../includes/load.php'); 
$user = current_user();
?> 
         <!--<div class="row ">
            <div class="col-sm-12 col-md-5 col-8 align-self-center">
                <?php if($text != 'Resumen'){ ?>
                <h4 style="padding-top: 10px;"><?php echo $text; ?></h4>
            <?php }else{ ?>
                <h4 style="padding-top: 10px;">Panel principal</h4>
            <?php } ?>
                <ol class="breadcrumb m-b-10">
                                    <li class="breadcrumb-item"><a href="panel">Panel</a></li>
                                    <li class="breadcrumb-item active"><?php echo $text; ?></li>
                                </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center">
                <div class="d-flex m-t-10 justify-content-end">
                    <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                       <div class="chart-text m-r-10">
                            <h4 class="m-t-0 text-info text-right">
                                <?php if($user['admin'] == 1){ echo 'Administrador'; }else{ echo find_select('nombre','departamentos','iddepartamentos',$user['iddepartamentos']); } ?>
                            </h4>
                            <h6 class="m-b-0 text-right"><small><?php  echo find_select('nombre','direcciones','iddireccion',$user['iddireccion']); ?></small></h6>
                            <h6 class="m-b-0 text-right"><small>Direccion Provincial de Vialidad</small></h6>
                       </div>
                        </div>
                    </div>
                </div>
            </div>-->