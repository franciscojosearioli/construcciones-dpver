<?php
   header("Content-type: application/vnd.ms-word");
   header("Content-Disposition: attachment; Filename=".$titulo.".doc");
?>
<html lang="en-US">
<head>
    <meta charset="utf-8" />
    
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title><?php echo $titulo; ?></title> 
</head>
<body>
  <div class="container">
    <div class="pagina">
      <header class="header">
        <div class="row">
          <div class="col-12">
            <div class="pull-left">
              <h4 style="font-size:100%;">
                <div class="pull-right"><b>DIRECCION PROVINCIAL DE VIALIDAD<br>DIRECCION DE CONSTRUCCIONES</b>
                </div>
              </h4>
            </div>
            <div class="pull-right"><br>
              <h4 style="font-size:90%;">Paraná, <?php echo format_date(date("d-m-Y")); ?></h4>
            </div>
          </div>
        </div>
      </header>