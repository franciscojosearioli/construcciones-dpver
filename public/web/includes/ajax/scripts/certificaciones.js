//Función que se ejecuta al inicio
function inicio(){
	form_agregar(false);
	form_editar(false);
	form_certificado(false);
}

//Función mostrar/ocultar formulario
function form_certificado(flag)
{
	if (flag)
	{
		$("#nuevo_certificados").hide();

	}
	else
	{
		$("#nuevo_certificados").show();
	}
}
function form_agregar(flag)
{
	if (flag)
	{
		$("#listar_certificados").hide();
		$("#agregar_certificados").show();
		$("#btn_agregar").hide();
	}
	else
	{
		$("#listar_certificados").show();
		$("#agregar_certificados").hide();
		$("#btn_agregar").show();
	}
}

function form_editar(flag)
{
	if (flag)
	{
		$("#listar_certificados").hide();
		$("#editar_certificados").show();
	}
	else
	{
		$("#listar_certificados").show();
		$("#editar_certificados").hide();
	}
}

//Función cancelar formulario
function cancelar_certificado()
{
	form_certificado(false);
}

function cancelar_agregar()
{
	form_agregar(false);
}

function cancelar_editar()
{
	form_editar(false);
}

//Función enviar formulario

function submit_agregar_certificado()
{
    validar = $("#form_agregar_certificado").validate();
    if(validar){
    $('#form_agregar_certificado').submit();
    }
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

inicio();

function editar_aviso(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/forms/editar_aviso.php",
success: function(respuesta) {
$('#avisos').hide();
$('#editar_avisos').html(respuesta).show();
}
});
}

$('.certificados').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,nav:false,
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:4,
            nav:false,
            loop:false
        }
    }
});

$('.certificados-redeterminados').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,nav:false,
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:4,
            nav:false,
            loop:false
        }
    }
});