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
		$("#relevamientos").hide();
		$("#agregar_relevamientos").show();
		$("#btn_agregar").hide();
	}
	else
	{
		$("#relevamientos").show();
		$("#agregar_relevamientos").hide();
		$("#btn_agregar").show();
	}
}

function form_editar(flag)
{
	if (flag)
	{
		$("#relevamientos").hide();
		$("#editar_relevamientos").show();
	}
	else
	{
		$("#relevamientos").show();
		$("#editar_relevamientos").hide();
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

function submit_editarr()
{
	validar = $("#form_editar").validate();
	if(validar){
	$('#form_editar').submit();
	}
}

inicio();


function editar_relevamiento(valor){
	$('#editar_relevamientos').hide();
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/forms/editar_relevamientos.php",
success: function(respuesta) {
$('#relevamientos').hide();
$('#editar_relevamientos').html(respuesta).show();
}
});
}

function mostrar(dato) {
  if (dato == "expediente") {
    $("#nota").hide();
    $("#expediente").show();
  }
  if (dato == "nota") {
    $("#nota").show();
    $("#expediente").hide();
  }
}

function eliminar_relevamiento(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/eliminar_relevamiento.php",
success: function(respuesta) {
$('#eliminar_relevamientos').html(respuesta).appendTo('body');
$('#eliminar_relevamiento').modal('show');
}
});
}

  $(document).ready(function() {
$('#lista_relevamientos').DataTable( {        
ajax: {
          url : 'includes/ajax/listar_relevamientos.php',
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

    $('#lista_relevamientos_processing').hide();
} );