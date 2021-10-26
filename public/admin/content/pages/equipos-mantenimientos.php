<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/movilidades.php');
cabecera('Tareas de mantenimientos');
$user = current_user();
$fechaactual = date('Y-m-d');
$tareas_mantenimientos = tareas_mantenimientos($user['iddepartamentos']);
?>
<div class="row">
	<div class="col-lg-12">
		<?php echo display_msg($msg); ?>
	</div>
</div>
<div class="row" id="listar_equipos">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<div class="d-flex flex-wrap margin-dt">
							<div>
								<h3 class="card-title">Listado de tareas de mantenimientos de equipos registrados</h3>
								<h6 class="card-subtitle">Espere unos minutos hasta que cargue la planilla.</h6>
								<h6 class="card-subtitle">Deslice la planilla para ver mas información.</h6>
							</div>
							<div class="ml-auto">
								<ul class="list-inline">
									<?php if(permiso('admin') || permiso('movilidades')){ ?>
										<li>
											<h6 class="text-muted"><a class="dropdown-item a-icon" data-toggle="modal" data-target="#add_tarea" title="Agregar nuevo"><i class="fas fa-plus fa-2x"></i></a></h6>  
										</li>
									<?php } ?>
								</ul>
							</div>
						</div>
						<div class="table-responsive">
							<table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th class="w-5"></th>
										<?php if(permiso('admin') || permiso('movilidades')){ ?>
											<th class="text-center" style="width: 5%;"> </th>
										<?php } ?>
										<th>Equipo </th>
										<th>Patente </th>
										<th>Tarea de mantenimiento </th>
										<th>Ultima vez realizado </th>
										<th>Proximo establecido </th>
										<th>Tiempo restante </th>
										<th>Kilometraje restante </th>
										<?php if(permiso('admin') || permiso('observador')){ ?>
											<th class="text-center">Dependencia</th>
										<?php } ?>
									</tr>
								</thead>
								<tbody>
									<?php foreach($tareas_mantenimientos as $tarea): ?>
										<tr>
											<td class="w-5"></td>
											<?php if(permiso('admin') || permiso('movilidades')){ ?>
												<td class="text-center">
													<div class="btn-group">
														<a class="btn btn-info btn-sm" href="includes/windows/editar_tarea.php?id=<?php echo $tarea['idtareas_mantenimientos'] ?>" target="_blank" data-toggle="tooltip" title="Editar" onclick="window.open(this.href, this.target, 'width=600,height=500'); return false;"><i class="fas fa-edit"></i></a>
														<a class="btn btn-sm btn-danger" href="includes/functions/archivar.php?id=<?php echo (int)$tarea['idtareas_mantenimientos'];?>&url=equipos-mantenimientos&tipo=mantenimiento" data-toggle="tooltip" title="Archivar"><i class="mdi mdi-close"></i></a>
													</div>
												</td>
											<?php } 
											$fecha_restante = dias_transcurridos($fechaactual,$tarea['proximo_fecha']);
											$fecha_util= dias_transcurridos($tarea['ultimo_fecha'],$tarea['proximo_fecha']);
											?>
											<td><?php echo clean(ucwords($tarea['nombre'])); ?></td>
											<td><?php echo clean(ucwords($tarea['patente'])); ?></td>
											<td><?php echo clean(ucwords($tarea['descripcion'])); ?></td>
											<td><?php echo format_date($tarea['ultimo_fecha']).'<br>'.numero($tarea['ultimo_km']).' km'; ?></td>
											<td><?php echo format_date($tarea['proximo_fecha']).'<br>'.numero($tarea['proximo_km']).' km'; ?></td>
											<td><?php echo $fecha_restante.' Dias del total de '.$fecha_util.' dias '; ?></td>
											<td><?php echo $tarea['proximo_km']-$tarea['ultimo_km'].' km'; ?></td>
											<?php if(permiso('admin') || permiso('observador')){ ?>
												<td class="text-center"> <b><?php echo find_select('nombre','departamentos','iddepartamentos',$tarea['iddepartamentos']) ?></b> (<?php echo find_select('nombre','direcciones','iddireccion',$tarea['iddireccion']) ?>)  
												</td>
											<?php } ?>
										</tr>
									<?php endforeach;?>
								</tbody>
								<tfoot>
									<tr>
										<th class="w-5"></th>
										<?php if(permiso('admin') || permiso('movilidades')){ ?>
											<th class="text-center" style="width: 5%;"> </th>
										<?php } ?>
										<th>Equipo </th>
										<th>Patente </th>
										<th>Tarea de mantenimiento </th>
										<th>Ultima vez realizado </th>
										<th>Proximo establecido </th>
										<th>Tiempo restante </th>
										<th>Kilometraje restante </th>
										<?php if(permiso('admin') || permiso('observador')){ ?>
											<th class="text-center">Dependencia</th>
										<?php } ?>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>    
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$("#tareas-de-mantenimientos").html(function(){
			$.ajax({
				url: "includes/ajax/tareas-mantenimientos.php",
				data: data,
				dataType: 'json',
				success: function(result){
					$("#tareas-de-mantenimientos").html(result);
				}
			});
		});
	});
</script>
<?php 
require_once('../modals/add_tarea.php');
pie(); ?>