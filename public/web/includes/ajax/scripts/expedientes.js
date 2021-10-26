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
		$("#listar_expedientes").hide();
		$("#localizar_expedientes").show();
		$("#btn_agregar").hide();
	}
	else
	{
		$("#localizar_expedientes").hide();
		$("#agregar_expedientes").hide();
		$("#listar_expedientes").show();
		$("#btn_agregar").show();
	}
}

function form_editar(flag)
{
	if (flag)
	{
		$("#listar_expedientes").hide();
		$("#editar_expedientes").show();
	}
	else
	{
		$("#listar_expedientes").show();
		$("#editar_expedientes").hide();
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

function editar_expediente(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/forms/editar_expediente.php",
success: function(respuesta) {
$('#listar_expedientes').hide();
$('#editar_expedientes').html(respuesta).show();
}
});
}

function observaciones_expediente(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/observaciones_expediente.php",
success: function(respuesta) {
$('#observaciones_expediente').html(respuesta).appendTo('body');
$('#observacion_expedientes').modal('show');
}
});
}

function pases_expediente(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/pases_expediente.php",
success: function(respuesta) {
$('#pases_expedientes').html(respuesta).appendTo('body');
$('#pases_expediente').modal('show');
}
});
}

function localizar_expediente(){
if($("#numero").val().length > 0){
var valor = $('#numero').val();
$.ajax({
type: "POST",
data: "numero="+valor,
url: "content/forms/agregar_expedientes.php",
success: function(respuesta) {
$('#localizar_expedientes').hide();
$('#agregar_expedientes').html(respuesta).show();
}
});
}
}

function movimientos_expediente(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/movimientos_expedientes.php",
success: function(respuesta) {
$('#movimientos_expedientes').html(respuesta).appendTo('body');
$('#expediente_movimiento').modal('show');
}
});
}

function eliminar_expediente(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/eliminar_expediente.php",
success: function(respuesta) {
$('#eliminar_expedientes').html(respuesta).appendTo('body');
$('#eliminar_expediente').modal('show');
}
});
}
  $(document).ready(function() {
	    $('#lista_expedientes').DataTable( {
        processing: false,
        ajax: 
        {
          url : 'includes/ajax/lista_expedientes.php',
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
    $('#lista_expedientes_processing').hide();
   
});