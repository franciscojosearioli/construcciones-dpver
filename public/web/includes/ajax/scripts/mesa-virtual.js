//Función que se ejecuta al inicio
function inicio(){
	form_agregar_expediente(false);
	form_agregar_nota(false);

	form_agregar_memorandum(false);
	form_llegada_tarde(false);
	form_comision(false);
	form_egreso(false);
}


//Función mostrar/ocultar formulario
function form_agregar_expediente(flag)
{
	if (flag)
	{
		$("#container_libro-diario").hide();
		$("#localizar_expedientes").show();
		$("#btn_agregar_expedientes").hide();
	}
	else
	{
		$("#localizar_expedientes").hide();
		$("#agregar_expedientes").hide();
		$("#container_libro-diario").show();
		$("#btn_agregar_expedientes").show();
	}
}

function form_agregar_nota(flag)
{
	if (flag)
	{
		$("#container_libro-diario").hide();
		$("#agregar_notas").show();
		$("#btn_agregar_notas").hide();
	}
	else
	{
		$("#agregar_notas").hide();
		$("#container_libro-diario").show();
		$("#btn_agregar_notas").show();
	}
}

function form_agregar_memorandum(flag)
{
	if (flag)
	{
		$("#tramites").hide();
		$("#tipo_memorandum").show();
	}
	else
	{
		$("#tipo_memorandum").hide();
		$("#tramites").show();
	}
}

function form_llegada_tarde(flag)
{
	if (flag)
	{
		$("#container_libro-diario").hide();
		$("#memo_llegada_tarde").show();
		$("#btn_llegada_tarde").hide();
		$("#btn_comision").hide();
		$("#btn_header").hide();
		$("#btn_egreso").hide();
	}
	else
	{
		$("#container_libro-diario").show();
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
		$("#container_libro-diario").hide();
		$("#memo_egreso").show();
		$("#btn_llegada_tarde").hide();
		$("#btn_comision").hide();
		$("#btn_header").hide();
		$("#btn_egreso").hide();
	}
	else
	{
		$("#container_libro-diario").show();
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
		$("#container_libro-diario").hide();
		$("#memo_comision").show();
		$("#btn_llegada_tarde").hide();
		$("#btn_comision").hide();
		$("#btn_header").hide();
		$("#btn_egreso").hide();
	}
	else
	{
		$("#container_libro-diario").show();
		$("#memo_comision").hide();
		$("#btn_llegada_tarde").show();
		$("#btn_comision").show();
		$("#btn_header").show();
		$("#btn_egreso").show();
	}
}

//Función cancelar formulario
function cancelar_agregar()
{
	form_agregar_expediente(false);
	form_agregar_nota(false);
	form_agregar_memorandum(false);
	form_llegada_tarde(false);
	form_comision(false);
	form_egreso(false);
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

// Seleccionar direccion
$( "#select_direccion" ).change(function() {
      var valor = $(this).val();
        $.post("includes/ajax/direccion-departamentos.php",  { valor: valor }).done(function(data) {
                    $('#departamentos').html(data);
});
});


// buscar todo
$('#todos').on('change', function() {
    if ($(this).is(':checked') ) {
            $("#select_direccion").prop("disabled", true);
        } else  {
            $("#todos").prop("disabled", false);
            $("#select_direccion").prop("disabled", false);
        }
    });
    $("#select_direccion").change( function() {
        if ($(this).val() != "") {
            $("#todos").prop("disabled", true);
        } else {
            $("#select_direccion").prop("disabled", false);
        }
    });
	
  $(document).ready(function () {
    $('.agentes').select2();
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