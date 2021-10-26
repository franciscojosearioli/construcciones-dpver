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
        $("#listar_precios_items").hide();
        $("#agregar_precios_items").show();
        $("#btn_agregar").hide();
    }
    else
    {
        $("#listar_precios_items").show();
        $("#agregar_precios_items").hide();
        $("#btn_agregar").show();
    }
}

function form_items(flag)
{
    if (flag)
    {
        $("#listar_precios_items").hide();
        $("#ver-items").show();
    }
    else
    {
        $("#listar_precios_items").show();
        $("#ver-items").hide();
    }
}

function form_editar(flag)
{
    if (flag)
    {
        $("#listar_precios_items").hide();
        $("#editar_precios_items").show();
    }
    else
    {
        $("#listar_precios_items").show();
        $("#editar_precios_items").hide();
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

function cancelar_items()
{
    form_items(false);
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
  $('#editar_precios').hide();
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/forms/editar_precio_item.php",
success: function(respuesta) {
$('#listar_precios_items').hide();
$('#editar_precios').html(respuesta).show();
}
});
}

$(document).ready(function() {
$('#tabla_precios_items').DataTable({
             dom: 'lBfrtip',   
             ajax: {
          url : 'includes/ajax/listar_precios_items.php',
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
        paging: true});
     	
});
