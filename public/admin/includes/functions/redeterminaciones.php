<?php 
$user = current_user();
$registro_fecha = make_date();

if(!empty($_POST['nuevo_titulo'])){
	$expediente = $_POST['expediente'];	
	$titulo = $_POST['nuevo_titulo'];
	$idobra = $_POST['idobras'];	
	$n_reso = $_POST['n_reso'];	
	$f_reso = $_POST['f_reso'];
	$importe = $_POST['total_importe'];
	$tipo = $_POST['tipo'];
	$camino = $_POST['valor_camino'];
	$puente = $_POST['valor_puente'];
if($tipo == 'provisorio'){
	$query  = "INSERT INTO redeterminaciones (idobras,expediente,titulo,numero_resolucion,fecha_resolucion,importe,camino,puente,tipo,condicion) VALUES ('{$idobra}',  '{$expediente}', '{$titulo}' ,'{$n_reso}' ,'{$f_reso}' ,'{$importe}','{$camino}','{$puente}', '1', '1');";
}
if($tipo == 'definitivo'){
	$query  = "INSERT INTO redeterminaciones (idobras,expediente,titulo,numero_resolucion,fecha_resolucion,importe,tipo,condicion) VALUES ('{$idobra}',  '{$expediente}', '{$titulo}' ,'{$n_reso}' ,'{$f_reso}' ,'{$importe}', '2', '1');";
}
	if(isset($_POST['idobras_items_add'])){
		$db->query($query);
		$ultimo_id = $db->insert_id(); 
		$cantidad_items = count($_POST['idobras_items']);
		$i=0;
		$insert_item = '';
		foreach ($_POST as $indice=>$cadena) { 
			while($i<$cantidad_items){  
				$insert_item .= $db->query("INSERT INTO redeterminaciones_precios (idredeterminaciones_actas, idobras, idobras_items, disponibles,precio_referencia, precio_unitario, importe) VALUES ('{$ultimo_id}','{$idobra}','".$_POST['idobras_items'][$i]."', '".$_POST['cantidad'][$i]."', '".$_POST['precio_unitario_fijo'][$i]."', '".$_POST['precio_unitario'][$i]."', '".$_POST['importe'][$i]."'); ");
				$i++; 
			
}
		}
		$insert_item .= '';
	if($db->query($insert_item)){
		$session->msg('s',"Agregado exitosamente. ");
		redirect('redeterminaciones-actas', false);
	} else {
		$session->msg('d',' Lo siento, registro falló.');
		redirect('redeterminaciones-actas', false);
	}
}
}


if(isset($_POST['edit_redeterminacion'])){
	$titulo = clean($db->escape( $_POST['titulo']));
	$idredeterminaciones_actas = clean($db->escape($_POST['edit_redeterminacion']));
	$idobra = $_POST['idobras'];
	$expediente = $_POST['expediente'];	
	$n_reso = $_POST['n_reso'];	
	$f_reso = $_POST['f_reso'];
	$importe = $_POST['total_importe'];
	$tipo = $_POST['tipo'];
	$camino = $_POST['valor_camino'];
	$puente = $_POST['valor_puente'];

	$importe = $_POST['total_importe'];
	$query2  = "UPDATE redeterminaciones SET expediente='".$expediente."', titulo='".$titulo."', numero_resolucion='".$n_reso."', fecha_resolucion='".$f_reso."' , importe='".$importe."', camino='".$camino."', puente='".$puente."' WHERE idredeterminaciones_actas='".$idredeterminaciones_actas."' ";

if($db->query($query2) ){
  	$cantidad_items = count($_POST['idobras_items']);
  	$i=0;
  	$update = '';
   	
   	while($i<$cantidad_items){  
	   $update .= $db->query("UPDATE redeterminaciones_precios SET precio_unitario='".$_POST['precio_unitario'][$i]."', importe='".$_POST['importe'][$i]."' WHERE idobras_items=".$_POST['idobras_items'][$i]."; ");
	   $i++; 
	}
   	
	$update .= '';

if($db->query($update)){
		$session->msg('s',"Editado exitosamente. ");
		redirect('redeterminaciones-actas', false);
	} else {
		$session->msg('d',' Lo siento, registro falló.');
		redirect('redeterminaciones-actas', false);
	}

}
}


?>