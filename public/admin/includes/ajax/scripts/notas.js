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
		$("#listar_notas").hide();
		$("#agregar_notas").show();
		$("#btn_agregar").hide();
	}
	else
	{
		$("#listar_notas").show();
		$("#agregar_notas").hide();
		$("#btn_agregar").show();
	}
}

function form_editar(flag)
{
	if (flag)
	{
		$("#listar_notas").hide();
		$("#editar_notas").show();
	}
	else
	{
		$("#listar_notas").show();
		$("#editar_notas").hide();
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

function editar_nota(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/forms/editar_nota.php",
success: function(respuesta) {
$('#listar_notas').hide();
$('#editar_notas').html(respuesta).show();
}
});
}

function observaciones_nota(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/observaciones_nota.php",
success: function(respuesta) {
$('#observaciones_notas').html(respuesta).appendTo('body');
$('#observacion_notas').modal('show');
}
});
}

function pases_nota(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/pases_nota.php",
success: function(respuesta) {
$('#pases_notas').html(respuesta).appendTo('body');
$('#pases_nota').modal('show');
}
});
}

function eliminar_nota(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/eliminar_nota.php",
success: function(respuesta) {
$('#eliminar_notas').html(respuesta).appendTo('body');
$('#eliminar_nota').modal('show');
}
});
}

  $(document).ready(function() {
    $('#lista_notas').DataTable( {
        processing: true,
        ajax: 
        {
          url : 'includes/ajax/lista_notas.php',
          type: 'POST'
        },
            dom: '<"top"flBp>irt<"bottom"i><"clear">flBp',
    "fnInitComplete": function(){
                // Disable TBODY scoll bars
                $('.dataTables_scrollBody').css({
                    'overflow': 'hidden',
                    'border': '0'
                });
                
                // Enable TFOOT scoll bars
                $('.dataTables_scrollFoot').css('overflow', 'auto');
                
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
          text: 'Filtro'  },
        {
            text: '<i class="ti-help-alt"></i>',
            action: function (e, node, config){
                $('#ayuda_dt').modal('show')
            }
        }
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
        paging: true
});



    $('#lista_notas_processing').hide();
    $('#lista_notas_archivo').DataTable( {
    	dom: 'lBfrtip',  
        processing: true,
        ajax: {
          url : 'includes/ajax/lista_notas_archivo.php',
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
        	style: 'multi'
        },
        scrollX: true,
        scrollCollapse: true,
        paging: true
});
});