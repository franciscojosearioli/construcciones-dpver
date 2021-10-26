<?php
require_once('../../includes/load.php');

// USUARIOS
$user = current_user();
// HEADER
cabecera('Pagina en blanco'); 

echo '<div class="row justify-content-center">Hola, esta en una pagina en blanco para lo que necesites.</div>';

pie(); 
?>