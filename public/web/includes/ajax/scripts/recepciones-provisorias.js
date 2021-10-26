//Función que se ejecuta al inicio
function inicio(){
	form_agregar(false);
	form_editar(false);
}

//Función mostrar/ocultar formulario
function form_agregar(flag)
{
	if (flag)
	{
		$("#listar_rp").hide();
		$("#agregar_rp").show();
		$("#btn_agregar").hide();
	}
	else
	{
		$("#listar_rp").show();
		$("#agregar_rp").hide();
		$("#btn_agregar").show();
	}
}

function form_editar(flag)
{
	if (flag)
	{
		$("#listar_rp").hide();
		$("#editar_rp").show();
	}
	else
	{
		$("#listar_rp").show();
		$("#editar_rp").hide();
	}
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

function editar_rp(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/forms/editar_rp.php",
success: function(respuesta) {
$('#listar_rp').hide();
$('#editar_rp').html(respuesta).show();
}
});
}

function movimiento_rp(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/movimientos_rp.php",
success: function(respuesta) {
$('#movimientos_recepciones').html(respuesta).appendTo('body');
$('#movimientos_rp').modal('show');
}
});
}

  $(document).ready(function() {
$('#lista_rp').DataTable( {

dom: 'lBfrtip',        
ajax: {
          url : 'includes/ajax/listar_rp.php',
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

    $('#lista_rp_processing').hide();

$('#lista_rp_archivo').DataTable( {

dom: 'lBfrtip',        
ajax: {
          url : 'includes/ajax/listar_rp_archivo.php',
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
} );