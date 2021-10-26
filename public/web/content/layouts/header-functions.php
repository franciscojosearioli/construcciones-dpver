<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $titulo; ?></title>
    <link href="includes/assets/images/favicon.png" rel="shortcut icon" type="image/png">
    <link href="includes/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="includes/assets/plugins/accordion/style.css" rel="stylesheet">
    <link href="includes/assets/css/style.css" rel="stylesheet">
    <link href="includes/assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="includes/assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="includes/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="includes/assets/plugins/css-chart/css-chart.css" rel="stylesheet">
    <link href="includes/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet">
    <link href="includes/assets/plugins/datatables/select.dataTables.min.css" rel="stylesheet">
    <link href="includes/assets/plugins/datatables-buttons/buttons.dataTables.min.css" rel="stylesheet">
    <link href="includes/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!--<link href="includes/assets/plugins/c3-master/c3.min.css" rel="stylesheet">-->
    <link href="includes/assets/plugins/file_tree/default.css" rel="stylesheet" type="text/css" media="screen">  
    <!--<link href="includes/assets/plugins/mensajes/css/messenger.css" rel="stylesheet">
    <link href="includes/assets/plugins/notificaciones/css/notificaciones.css" rel="stylesheet">
    <script src="http://simile.mit.edu/timeline/api/timeline-api.js" type="text/javascript"></script>
    <link href="includes/assets/plugins/recordatorios/css/style.css" rel="stylesheet">-->
    <link href="includes/assets/plugins/leaflet/css/leaflet.css" rel="stylesheet">
    <link href="includes/assets/plugins/leaflet/css/leaflet.fullscreen.css" rel="stylesheet">
    <link href="includes/assets/css/icons/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="includes/assets/plugins/owl-carousel/style.css" rel="stylesheet">  
    <link href="includes/assets/plugins/dropify/dist/css/dropify.min.css" rel="stylesheet">
    <link href="includes/assets/plugins/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <link href="includes/assets/plugins/typeahead/css/typeahead.css" rel="stylesheet">
    <link href="includes/assets/plugins/wizard/steps.css" rel="stylesheet">
    <link href="includes/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
   <!-- <link rel="stylesheet" type="text/css" href="includes/assets/plugins/timeline/css/timeline.css" />-->
   <?php if($user['theme'] == 'light'){ ?>
   <link href="includes/assets/css/themes/light-mode.css" id="theme" rel="stylesheet">
   <?php } elseif($user['theme'] == 'dark'){ ?>
   <link href="includes/assets/css/themes/dark-mode.css" id="theme" rel="stylesheet">
   <?php } else{ ?>
   <link href="includes/assets/css/themes/light-mode.css" id="theme" rel="stylesheet">
   <?php } ?>
   <link rel="stylesheet" href="includes/assets/plugins/owl-carousel2/assets/owl.carousel.min.css">
<link rel="stylesheet" href="includes/assets/plugins/owl-carousel2/assets/owl.theme.default.min.css">

   <!-- SCRIPTS JS -->
    <script src="includes/assets/plugins/jquery/jquery.min.js"></script>
    <script src="includes/assets/plugins/jquery/jquery-ui.min.js"></script>
    <script src="includes/assets/plugins/ckeditor5/ckeditor.js"></script>
    <script src="includes/assets/plugins/leaflet/js/leaflet.js"></script>
    <script src="includes/assets/plugins/leaflet/js/leaflet.fullscreen.min.js"></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css' rel='stylesheet' />
    <script src="includes/assets/js/isMobile.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ti-icons@0.1.2/css/themify-icons.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
</head>
<body>