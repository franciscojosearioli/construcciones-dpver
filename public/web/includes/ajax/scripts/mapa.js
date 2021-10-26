var tabla;

//Función que se ejecuta al inicio
function init(){
	form_mapa_agregar(false);
	form_mapa_eliminar(false);
}

//Función limpiar
function limpiar_mapa_agregar()
{
	$("#titulo").val("");
	$("#descripcion").val("");
	$("#color").val("Seleccione una opcion");
	$("#geo").val("");
	$("#lng").val("");
	$("#lat").val("");
	resetStreet();
}

//Función mostrar formulario
function form_mapa_agregar(flag)
{
	limpiar_mapa_agregar();
	if (flag)
	{
		$("#vista_mapa_obra").hide();
		$("#mapa_agregar").show();
		$("#btnGuardar_mapa").prop("disabled",false);
		$("#btnagregar_mapa").hide();
	}
	else
	{
		$("#vista_mapa_obra").show();
		$("#mapa_agregar").hide();
		$("#btnagregar_mapa").show();
	}
}

//Función cancelarform
function cancelarform_mapa_agregar()
{
	limpiar_mapa_agregar();
	form_mapa_agregar(false);
}

function limpiar_mapa_eliminar()
{
	$("#selectlinea").val("Seleccione un tramo");
	$("#selectmark").val("Seleccione un marcador");
}

//Función mostrar formulario
function form_mapa_eliminar(flag)
{
	if (flag)
	{
		$("#vista_mapa_obra").hide();
		$("#mapa_eliminar").show();
		$("#btnGuardar_mapa").prop("disabled",false);
		$("#btneliminar_mapa").hide();
	}
	else
	{
		$("#vista_mapa_obra").show();
		$("#mapa_eliminar").hide();
		$("#btneliminar_mapa").show();
	}
}

//Función cancelarform
function cancelarform_mapa_eliminar()
{
	limpiar_mapa_eliminar();
	form_mapa_eliminar(false);
}

init();