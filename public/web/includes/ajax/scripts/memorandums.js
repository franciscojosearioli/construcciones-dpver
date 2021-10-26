//Función que se ejecuta al inicio
function inicio(){
	form_llegada_tarde(false);
	form_comision(false);
	form_egreso(false);
	form_editar(false);
}

//Función mostrar/ocultar formulario
function form_llegada_tarde(flag)
{
	if (flag)
	{
		$("#listar_memorandums").hide();
		$("#memo_llegada_tarde").show();
		$("#btn_llegada_tarde").hide();
		$("#btn_comision").hide();
		$("#btn_header").hide();
		$("#btn_egreso").hide();
	}
	else
	{
		$("#listar_memorandums").show();
		$("#memo_llegada_tarde").hide();
		$("#btn_llegada_tarde").show();
		$("#btn_comision").show();
		$("#btn_header").show();
		$("#btn_egreso").show();
	}
}

function form_egreso(flag)
{
	if (flag)
	{
		$("#listar_memorandums").hide();
		$("#memo_egreso").show();
		$("#btn_llegada_tarde").hide();
		$("#btn_comision").hide();
		$("#btn_header").hide();
		$("#btn_egreso").hide();
	}
	else
	{
		$("#listar_memorandums").show();
		$("#memo_egreso").hide();
		$("#btn_llegada_tarde").show();
		$("#btn_comision").show();
		$("#btn_header").show();
		$("#btn_egreso").show();
	}
}

function form_comision(flag)
{
	if (flag)
	{
		$("#listar_memorandums").hide();
		$("#memo_comision").show();
		$("#btn_llegada_tarde").hide();
		$("#btn_comision").hide();
		$("#btn_header").hide();
		$("#btn_egreso").hide();
	}
	else
	{
		$("#listar_memorandums").show();
		$("#memo_comision").hide();
		$("#btn_llegada_tarde").show();
		$("#btn_comision").show();
		$("#btn_header").show();
		$("#btn_egreso").show();
	}
}

function form_editar(flag)
{
	if (flag)
	{
		$("#listar_memorandums").hide();
		$("#editar_memorandums").show();
	}
	else
	{
		$("#listar_memorandums").show();
		$("#editar_memorandums").hide();
	}
}

//Función cancelar formulario
function cancelar_agregar()
{
	form_llegada_tarde(false);
	form_comision(false);
	form_egreso(false);
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

function submit_agregar_egreso()
{
	validar = $("#form_agregar_egreso").validate();
	if(validar){
	$('#form_agregar_egreso').submit();
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

  $(document).ready(function() {
    $('#lista_memorandums').DataTable( {
        processing: true,
        ajax: 
        {
          url : 'includes/ajax/lista_memorandums.php',
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
});