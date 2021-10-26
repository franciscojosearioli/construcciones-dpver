<?php
  require_once('../../includes/load.php');
?>
<?php
  $leer_id = leer_by_id($_GET['id-msj']);
  if($leer_id){
echo "<html><head></head>".
"<body onload=\"javascript:history.back()\">".
"</body></html>";
  } else {
  	echo "<html><head></head>".
"<body onload=\"javascript:history.back()\">".
"</body></html>";
  }
?>
