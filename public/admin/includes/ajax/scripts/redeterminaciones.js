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
		$("#listar_redeterminaciones_actas").hide();
		$("#ver_form_agregar").show();
		$("#btn_agregar").hide();
	}
	else
	{
		$("#listar_redeterminaciones_actas").show();
		$("#ver_form_agregar").hide();
		$("#btn_agregar").show();
	}
}

function form_editar(flag)
{
	if (flag)
	{
		$("#listar_redeterminaciones_actas").hide();
		$("#ver_form_editar").show();
	}
	else
	{
		$("#listar_redeterminaciones_actas").show();
		$("#ver_form_editar").hide();
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

function editar_precios(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/forms/editar_redeterminacion_acta.php",
success: function(respuesta) {
$('#listar_redeterminaciones_actas').hide();
$('#editar_redeterminacion_acta').html(respuesta).show();
}
});
}


  $(document).ready(function() {
    $('#tabla_redeterminaciones_actas').DataTable( {

dom: 'lBfrtip',        
ajax: {
          url : 'includes/ajax/listar_redeterminaciones_actas.php',
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