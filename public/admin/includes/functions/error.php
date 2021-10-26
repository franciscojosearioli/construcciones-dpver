<?php
require_once('../load.php');
  if(!$session->logout()) {
    $session->msg('d','No tiene permisos para acceder.');
  	redirect("index.php");
  }
 ?>