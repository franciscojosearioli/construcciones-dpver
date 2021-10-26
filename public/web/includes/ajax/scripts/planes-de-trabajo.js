//Función que se ejecuta al inicio
function inicio(){
	form_agregar(false);
	form_editar(false);
	form_ver(false);
	form_ver_plan(false);
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

//Función mostrar/ocultar formulario
function form_ver_plan(flag)
{
	if (flag)
	{
		$("#buscar_planes").hide();
		$("#plan-de-trabajo").show();
	}
	else
	{
		$("#buscar_planes").show();
		$("#plan-de-trabajo").hide();
	}
}

//Función mostrar/ocultar formulario
function form_agregar(flag)
{
	if (flag)
	{
		$("#buscar_planes").hide();
		$("#ver_form_agregar").show();
		$("#btn_agregar").hide();
	}
	else
	{
		$("#buscar_planes").show();
		$("#ver_form_agregar").hide();
		$("#btn_agregar").show();
	}
}

function form_editar(flag)
{
	if (flag)
	{
		$("#buscar_planes").hide();
		$("#ver_form_editar").show();
	}
	else
	{
		$("#buscar_planes").show();
		$("#ver_form_editar").hide();
	}
}

//Función cancelar formulario
function cancelar_agregar()
{
	form_agregar(false);
}

function cancelar_ver()
{
	form_ver(false);
	form_ver_plan(false);
}

function cancelar_editar()
{
	form_editar(false);
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

function editar_plan(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/forms/editar_plan_de_trabajo.php",
success: function(respuesta) {
$('#buscar_planes').hide();
$('#planes-de-trabajo').html(respuesta).show();
}
});
}
function ver_plan(valor){
  var valor = valor;
  $.ajax({
  type: "POST",
  data: "id="+valor,
  url: "content/modals/ver_plan_de_trabajo.php",
  success: function(respuesta) {
  $('#planes-de-trabajo-ver').html(respuesta).appendTo('body');
  $('#ver_plan_de_trabajo').modal('show');
  }
  });
  }
$('.ultimos-planes').owlCarousel({
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
    $('#tabla_planes_de_trabajo').DataTable( {

dom: 'lBfrtip',        
ajax: {
          url : 'includes/ajax/listar_planes_de_trabajo.php',
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