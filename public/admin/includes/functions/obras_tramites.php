
if (isset($_POST['agregar_modificaciones'])){
	$carpeta = "/";
	opendir($carpeta);
	$numero  = $_POST['numero'];
	$expediente   = $_POST['expediente'];
	$res_archivo = $_FILES['resolucion_archivo']['tmp_name'];
	$res_file_name = $_FILES['resolucion_archivo']['name'];
	$res_file_type = $_FILES['resolucion_archivo']['type'];
	$user = current_user();
	$date    = make_date();








	mkdir($_SERVER['DOCUMENT_ROOT']."/construcciones/public/uploads/Relevamientos/".$user['iddepartamentos']."/", 0755);
	$destino = $_SERVER['DOCUMENT_ROOT']."/construcciones/public/uploads/Relevamientos/".$user['iddepartamentos']."/".$file_name;
	copy($archivo, $destino);	

	foreach($_FILES["archivos_tramite"]['tmp_name'] as $key => $tmp_name)
	{
	//Validamos que el archivo exista
		if($_FILES["archivos_tramite"]["name"][$key]) {
	$tramite_archivo = $_FILES["archivos_tramite"]["name"][$key]; //Obtenemos el nombre original del archivo
	$tramite_file_name = $_FILES["archivos_tramite"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
	$filetype_pliego_completo = $_FILES['archivos_tramite']['type'][$key]; //Obtenemos el tipo del archivo
	//Validamos si la ruta de destino existe, en caso de no existir la creamos
	
	if(!file_exists($dir_obras.'/1-Pliego completo')){
		mkdir($dir_obras.'/1-Pliego completo', 0755) or die("No se puede crear el directorio Archivo/1-Pliego completo");		
	}
	$d_pliego_completo = $dir_obras."/1-Pliego completo/".utf8_decode($filename_pliego_completo);
	
	
	if(move_uploaded_file($source_pliego_completo, $d_pliego_completo)) {	
		logs($user['id'],"obras-archivos",$id,"Subio archivos en la carpeta Archivo/1-Pliego completo");
		header('Location:' . getenv('HTTP_REFERER'));
	} else {	
		header('Location:' . getenv('HTTP_REFERER'));
	}			
	}
	}





	$query = "INSERT INTO relevamientos (nota,expediente,nombre,ubicacion,iddepartamentos,archivo,condicion,registro_usuario,registro_fecha) VALUES ('{$nota}','{$expediente}', '{$nombre}', '{$ubicacion}', '".$user['iddepartamentos']."', '".utf8_encode($file_name)."', '1', ".$user['id'].", '{$date}');";
	$user_activity = registro($user['id'],"Registro un nuevo relevamiento");
	if($db->query($query) && $db->affected_rows() === 1){
		$session->msg('s',"El archivo ".$file_name.", se ha cargado correctamente.");
		header('Location:' . getenv('HTTP_REFERER'));
	} else {
		$session->msg('d',' No se pudo cargar.');
		header('Location:' . getenv('HTTP_REFERER'));
	}
}