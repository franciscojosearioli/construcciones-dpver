//Función que se ejecuta al inicio
function inicio(){
	form_agregar(false);
	form_agregar_expediente(false);
	form_agregar_nota(false);
	form_editar(false);
}

//Función mostrar/ocultar formulario
function form_agregar(flag)
{
	if (flag)
	{
		$("#listar_tramites").hide();
		$("#localizar_expedientes").show();
		$("#btn_agregar_expedientes").hide();
	}
	else
	{
		$("#localizar_expedientes").hide();
		$("#agregar_expedientes").hide();
		$("#listar_tramites").show();
		$("#btn_agregar_expedientes").show();
	}
}

//Función mostrar/ocultar formulario
function form_agregar_expediente(flag)
{
	if (flag)
	{
		$("#listar_tramites").hide();
		$("#localizar_expedientes").show();
	}
	else
	{
		$("#localizar_expedientes").hide();
		$("#agregar_expedientes").hide();
		$("#listar_tramites").show();
	}
}

function form_agregar_nota(flag)
{
	if (flag)
	{
		$("#listar_tramites").hide();
		$("#agregar_notas").show();
		$("#btn_agregar_notas").hide();
	}
	else
	{
		$("#agregar_notas").hide();
		$("#listar_tramites").show();
		$("#btn_agregar_notas").show();
	}
}



function form_editar(flag)
{
	if (flag)
	{
		$("#listar_tramites").hide();
		$("#editar_expedientes").show();
		$("#editar_notas").show();
	}
	else
	{
		$("#listar_tramites").show();
		$("#editar_expedientes").hide();
		$("#editar_notas").hide();
	}
}

//Función cancelar formulario
function cancelar_agregar()
{
	form_agregar(false);
	form_agregar_expediente(false);
	form_agregar_nota(false);
	form_editar(false);
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
function submit_agregar_nota()
{
	validar = $("#form_agregar_nota").validate();
	if(validar){
	$('#form_agregar_nota').submit();
	}
}
function submit_agregar_expediente()
{
	validar = $("#form_agregar_expediente").validate();
	if(validar){
	$('#form_agregar_expediente').submit();
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
    $('#listar_tramites').hide();
    $('#editar_expedientes').html(respuesta).show();
    }
    });
    }

    function editar_nota(valor){
        var valor = valor;
        $.ajax({
        type: "POST",
        data: "id="+valor,
        url: "content/forms/editar_nota.php",
        success: function(respuesta) {
        $('#listar_tramites').hide();
        $('#editar_notas').html(respuesta).show();
        }
        });
        }

function observar_tramite(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/observar_tramite.php",
success: function(respuesta) {
$('#tramites_observaciones').html(respuesta).appendTo('body');
$('#observacion_tramite').modal('show');
}
});
}

function pases_tramite(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/pases_tramite.php",
success: function(respuesta) {
$('#pases_tramites').html(respuesta).appendTo('body');
$('#pases_tramite').modal('show');
}
});
}

  // Seleccionar direccion
$( "#select_direccion" ).change(function() {
    var valor = $(this).val();
      $.post("includes/ajax/direccion-departamentos.php",  { valor: valor }).done(function(data) {
                  $('#departamentos').html(data);
});
});
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

function movimientos_tramite(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/movimientos_tramites.php",
success: function(respuesta) {
$('#movimientos_tramites').html(respuesta).appendTo('body');
$('#tramite_movimiento').modal('show');
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
	$('#lista_tramites').DataTable( {
        processing: false,
        ajax: 
        {
          url : 'includes/ajax/lista_tramites.php',
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
            fixedColumns:   {
                heightMatch: 'none'
            }
});
    $('#lista_tramites_processing').hide();
	
   
});
