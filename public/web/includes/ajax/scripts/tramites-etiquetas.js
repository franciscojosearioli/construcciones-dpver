//Función que se ejecuta al inicio
function inicio(){
    form_agregar_etiquetas(false);
}

function form_agregar_etiquetas(flag)
{
	if (flag)
	{
		$("#listar_etiquetas_tramites").hide();
		$("#agregar_etiqueta_tramite").show();
		$("#btn_agregar_etiqueta").hide();
	}
	else
	{
		$("#agregar_etiqueta_tramite").hide();
		$("#listar_etiquetas_tramites").show();
		$("#btn_agregar_etiqueta").show();
	}
}

function cancelar_agregar()
{
    form_agregar_etiquetas(false);
}

function cancelar_editar()
{
	form_editar(false);
}

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

function editar_etiqueta(valor){
	$('#btn_agregar_etiqueta').hide();
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/forms/editar_etiquetas.php",
success: function(respuesta) {
$('#listar_etiquetas_tramites').hide();
$('#editar_etiquetas').html(respuesta).show();
}
});
}

$(document).ready(function() {
$('#tabla_tramites_etiquetas').DataTable( {
    processing: false,
    ajax: 
    {
      url : 'includes/ajax/lista_tramites_etiquetas.php',
      type: 'POST'
    },
    dom: '<"top"flBp>irt<"bottom"i><"clear">flBp',
    "fnInitComplete": function(){
        // Disable TBODY scoll bars
        
        // Enable TFOOT scoll bars
        //$('.dataTables_scrollFoot').css('overflow', 'auto');
        
        $('.dataTables_scrollHead').css('overflow', 'auto');
        
        // Sync TFOOT scrolling with TBODY
        $('.dataTables_scrollFoot').on('scroll', function () {
            $('.dataTables_scrollBody').scrollLeft($(this).scrollLeft());
        });      
        
        $('.dataTables_scrollHead').on('scroll', function () {
            $('.dataTables_scrollBody').scrollLeft($(this).scrollLeft());
        });
    },
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
    fixedHeader: {
        header: true,
        footer: true
    },
    buttons: [
    {
        extend: 'collection',
        text: 'Exportar',
        buttons: ['copy','excel','csv','pdf','print']
    },
    { extend: 'colvis',
      text: 'Filtro'  }
    ],
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
    paging: true,
    scrollY:        "300px",
    fixedColumns:   {
        heightMatch: 'none'
    }
});
});
