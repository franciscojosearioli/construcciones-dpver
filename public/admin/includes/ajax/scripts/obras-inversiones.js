//Función que se ejecuta al inicio
function inicio(){
	form_ver(false);
	form_ver_plan(false);
	form_ver_cotizacion(false);
}

//Función mostrar/ocultar formulario
function form_ver(flag)
{
	if (flag)
	{
		$("#buscar-curvas").hide();
		$("#curva-de-inversion").show();
	}
	else
	{
		$("#buscar-curvas").show();
		$("#curva-de-inversion").hide();
	}
}

//Función mostrar/ocultar formulario
function form_ver_plan(flag)
{
	if (flag)
	{
		$("#buscar_planes").hide();
		$("#plan-de-trabajo").show();
	}
	else
	{
		$("#buscar_planes").show();
		$("#plan-de-trabajo").hide();
	}
}
//Función mostrar/ocultar formulario
function form_ver_cotizacion(flag)
{
	if (flag)
	{
		$("#buscar-obras").hide();
		$("#cotizacion-de-obra").show();
	}
	else
	{
		$("#buscar-obras").show();
		$("#cotizacion-de-obra").hide();
	}
}
function cancelar_ver()
{
	form_ver(false);
	form_ver_plan(false);
	form_ver_cotizacion(false);
}

inicio();
