//Función que se ejecuta al inicio
function inicio(){
	form_agregar(false);
	form_editar(false);
	form_ver(false);
	form_ver_cotizacion(false);
  unidades_items(false);
}

function form_ver(flag)
{
	if (flag)
	{
		$("#buscar-curvas").hide();
		$("#curva-de-inversion").show();
	}
	else
	{
		$("#buscar-curvas").show();
		$("#curva-de-inversion").hide();
	}
}
function form_ver_cotizacion(flag)
{
	if (flag)
	{
		$("#buscar-obras").hide();
		$("#cotizacion-de-obra").show();
	}
	else
	{
		$("#buscar-obras").show();
		$("#cotizacion-de-obra").hide();
	}
}
//Función mostrar/ocultar formulario
function form_agregar(flag)
{
	if (flag)
	{
		$("#buscar-obras").hide();
		$("#ver_form_agregar").show();
		$("#btn_agregar").hide();
	}
	else
	{
		$("#buscar-obras").show();
		$("#ver_form_agregar").hide();
		$("#btn_agregar").show();
	}
}

function form_editar(flag)
{
	if (flag)
	{
		$("#buscar-obras").hide();
		$("#ver_form_editar").show();
	}
	else
	{
		$("#buscar-obras").show();
		$("#ver_form_editar").hide();
	}
}

//Función mostrar/ocultar formulario
function unidades_items(flag)
{
	if (flag)
	{
		$("#buscar-obras").hide();
		$("#ver_unidade_items").show();
		$("#btn_ver_unidades").hide();
		$("#btn_agregar").hide();
	}
	else
	{
		$("#buscar-obras").show();
		$("#ver_unidades_items").hide();
		$("#btn_ver_unidades").show();
		$("#btn_agregar").show();
	}
}

function cancelar_unidades(){
  
  unidades_items(false);
}

//Función cancelar formulario
function cancelar_agregar()
{
	form_agregar(false);
}

function cancelar_editar()
{
	form_editar(false);
}
function cancelar_ver()
{
	form_ver(false);
	form_ver_cotizacion(false);
}

//Función enviar formulario
function submit_agregar()
{
	validar = $("#form_agregar").validate();
	if(validar){
	$('#form_agregar').submit();
	}
}

function submit_editar()
{
	validar = $("#form_editar").validate();
	if(validar){
	$('#form_editar').submit();
	}
}

inicio();

function editar_cotizacion(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/forms/editar_cotizacion.php",
success: function(respuesta) {
$('#buscar-obras').hide();
$('#cotizaciones-obras').html(respuesta).show();
}
});
}

function ver_cotizacion(valor){
  var valor = valor;
  $.ajax({
  type: "POST",
  data: "id="+valor,
  url: "content/modals/ver_cotizacion.php",
  success: function(respuesta) {
  $('#cotizaciones-obras-ver').html(respuesta).appendTo('body');
  $('#ver_cotizacion').modal('show');
  }
  });
  }

$('.ultimas-cotizaciones').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:5,
            nav:true,
            loop:false
        }
    }
});   

  $(document).ready(function() {
    $('#tabla_cotizaciones').DataTable( {

dom: 'lBfrtip',        
ajax: {
          url : 'includes/ajax/listar_cotizaciones.php',
          type: 'POST'
        },
        buttons: [
        {
          extend: 'collection',
          text: 'Opciones',
          buttons: ['copy','excel','csv','pdf','print']
        },
        {

            text: 'Ayuda',
            action: function (e, node, config){
                $('#ayuda_dt').modal('show')
            }

        }
        ],
        language: {
          buttons: {
            copy: 'Copiar',
            excel: 'Exportar a Excel',
            csv: 'Exportar a CSV',
            pdf: 'Exportar a PDF',
            colvis: 'Filtrar datos',
            print: 'Imprimir'
          }
        },
        columnDefs: [
        {
          targets: 0,
          className: 'select-checkbox',
          checkboxes: {
            selectRow: true
          }
        },
        {
          orderable: false,
          targets: [0,1]
        }
        ],
        select: 
        {
          selector: 'td:first-child',
            style: 'multi'
        },
        scrollX: true,
        scrollCollapse: true,
        paging: true
});
    $('#tabla_redeterminaciones_actas_processing').hide();
} );