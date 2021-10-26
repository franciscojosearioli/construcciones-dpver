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
      $("#listar_obras").hide();
      $("#agregar_obra").show();
      $("#btn_agregar").hide();
    }
    else
    {
      $("#listar_obras").show();
      $("#agregar_obra").hide();
      $("#btn_agregar").show();
    }
  }
  
  function form_editar(flag)
  {
    if (flag)
    {
      $("#proyectos").hide();
      $("#editar_proyecto").show();
    }
    else
    {
      $("#proyectos").show();
      $("#editar_proyecto").hide();
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
    validar = $("#form_agregar_obra").validate();
    if(validar){
    $('#form_agregar_obra').submit();
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

function alias_obra(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/alias_obra.php",
success: function(respuesta) {
$('#alias_obra_ver').html(respuesta).appendTo('body');
$('#alias_obra_modal').modal('show');
}
});
}