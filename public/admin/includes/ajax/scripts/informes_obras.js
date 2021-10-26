function inicio(){
  form_agregar_modificacion(false);
  form_agregar_ampliacion(false);
  form_agregar_neutralizacion(false);
  form_agregar_recepcion(false);
  form_agregar_cotizacion(false);
  form_agregar_plandetrabajo(false);

  
  form_agregar_mod_plandetrabajo(false);
  form_editar_modificacion(false);
    form_editar_ampliacion(false);
    form_editar_neutralizacion(false);
    form_editar_recepcion(false);
    form_editar_mod_plandetrabajo(false);

    
form_editar_planilla_plandetrabajo(false);
form_editar_planilla_cotizacion(false);
  }


  function form_agregar_modificacion(flag)
  {
    if (flag)
    {
      $("#info_obra").hide();
      $("#agregar_modificacion").show();
    }
    else
    {
      $("#info_obra").show();
      $("#agregar_modificacion").hide();
    }
  }
  function form_agregar_ampliacion(flag)
  {
    if (flag)
    {
      $("#info_obra").hide();
      $("#agregar_ampliacion").show();
    }
    else
    {
      $("#info_obra").show();
      $("#agregar_ampliacion").hide();
    }
  }
  function form_agregar_neutralizacion(flag)
  {
    if (flag)
    {
      $("#info_obra").hide();
      $("#agregar_neutralizacion").show();
    }
    else
    {
      $("#info_obra").show();
      $("#agregar_neutralizacion").hide();
    }
  }
  function form_agregar_recepcion(flag)
  {
    if (flag)
    {
      $("#info_obra").hide();
      $("#agregar_recepcion").show();
    }
    else
    {
      $("#info_obra").show();
      $("#agregar_recepcion").hide();
    }
  }
  function form_agregar_cotizacion(flag)
  {
    if (flag)
    {
      $("#info_obra").hide();
      $("#agregar_cotizacion").show();
    }
    else
    {
      $("#info_obra").show();
      $("#agregar_cotizacion").hide();
    }
  }
  function form_agregar_plandetrabajo(flag)
  {
    if (flag)
    {
      $("#info_obra").hide();
      $("#agregar_plandetrabajo").show();
    }
    else
    {
      $("#info_obra").show();
      $("#agregar_plandetrabajo").hide();
    }
  }

  function form_agregar_mod_plandetrabajo(flag)
  {
    if (flag)
    {
      $("#info_obra").hide();
      $("#agregar_mod_planesdetrabajo").show();
    }
    else
    {
      $("#info_obra").show();
      $("#agregar_mod_planesdetrabajo").hide();
    }
  }

  function form_editar_modificacion(flag)
  {
    if (flag)
    {
      $("#info_obra").hide();
      $("#editar_modificaciones").show();
    }
    else
    {
      $("#info_obra").show();
      $("#editar_modificaciones").hide();
    }
  }
  function form_editar_ampliacion(flag)
  {
    if (flag)
    {
      $("#info_obra").hide();
      $("#editar_ampliaciones").show();
    }
    else
    {
      $("#info_obra").show();
      $("#editar_ampliaciones").hide();
    }
  }
  function form_editar_neutralizacion(flag)
  {
    if (flag)
    {
      $("#info_obra").hide();
      $("#editar_neutralizaciones").show();
    }
    else
    {
      $("#info_obra").show();
      $("#editar_neutralizaciones").hide();
    }
  }
  function form_editar_recepcion(flag)
  {
    if (flag)
    {
      $("#info_obra").hide();
      $("#editar_recepciones").show();
    }
    else
    {
      $("#info_obra").show();
      $("#editar_recepciones").hide();
    }
  }

  function form_editar_mod_plandetrabajo(flag)
  {
    if (flag)
    {
      $("#info_obra").hide();
      $("#editar_mod_planesdetrabajo").show();
    }
    else
    {
      $("#info_obra").show();
      $("#editar_mod_planesdetrabajo").hide();
    }
  }

  function form_editar_planilla_plandetrabajo(flag)
  {
    if (flag)
    {
      $("#info_obra").hide();
      $("#editar_planilla_planesdetrabajo").show();
    }
    else
    {
      $("#info_obra").show();
      $("#editar_planilla_planesdetrabajo").hide();
    }
  }
  function form_editar_planilla_cotizacion(flag)
  {
    if (flag)
    {
      $("#info_obra").hide();
      $("#editar_planilla_cotizacion").show();
    }
    else
    {
      $("#info_obra").show();
      $("#editar_planilla_cotizacion").hide();
    }
  }
function cancelar_agregar(){
  
  form_agregar_modificacion(false);
  form_agregar_ampliacion(false);
  form_agregar_neutralizacion(false);
  form_agregar_recepcion(false);
  form_agregar_cotizacion(false);
  form_agregar_plandetrabajo(false);
  form_agregar_mod_plandetrabajo(false);
}

function cancelar_editar()
{
  form_editar_modificacion(false);
form_editar_ampliacion(false);
form_editar_neutralizacion(false);
form_editar_recepcion(false);
form_editar_mod_plandetrabajo(false);
form_editar_planilla_plandetrabajo(false);
form_editar_planilla_cotizacion(false);
}

function submit_editar_modificacion()
  {
    validar = $("#form_editar_modificacion").validate();
    if(validar){
    $('#form_editar_modificacion').submit();
    }
  }

  function submit_editar_ampliacion()
  {
    validar = $("#form_editar_ampliacion").validate();
    if(validar){
    $('#form_editar_ampliacion').submit();
    }
  }

  function submit_editar_neutralizacion()
  {
    validar = $("#form_editar_neutralizacion").validate();
    if(validar){
    $('#form_editar_neutralizacion').submit();
    }
  }
  
  function submit_editar_recepcion()
  {
    validar = $("#form_editar_recepcion").validate();
    if(validar){
    $('#form_editar_recepcion').submit();
    }
  }
  
inicio();




$('.modificaciones-de-obras').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:5,
            nav:true,
            loop:false
        }
    }
});   
$('.ampliaciones-de-obras').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:5,
            nav:true,
            loop:false
        }
    }
});   
$('.neutralizaciones-de-obras').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:5,
            nav:true,
            loop:false
        }
    }
});   


function estado_informe(valor){
    var valor = valor;
    $.ajax({
    type: "POST",
    data: "id="+valor,
    url: "content/modals/estado_informe.php",
    success: function(respuesta) {
    $('#estado_del_informe').html(respuesta).appendTo('body');
    $('#estado_informe').modal('show');
    }
    });
    }

    
function editar_modificacion(valor){
    var valor = valor;
    $.ajax({
    type: "POST",
    data: "id="+valor,
    url: "content/forms/editar_modificacion.php",
    success: function(respuesta) {
    $('#info_obra').hide();
    $('#editar_modificaciones').html(respuesta).show();
    }
    });
    }
  
    function editar_ampliacion(valor){
      var valor = valor;
      $.ajax({
      type: "POST",
      data: "id="+valor,
      url: "content/forms/editar_ampliacion.php",
      success: function(respuesta) {
      $('#info_obra').hide();
      $('#editar_ampliaciones').html(respuesta).show();
      }
      });
      }
  
      function editar_neutralizacion(valor){
        var valor = valor;
        $.ajax({
        type: "POST",
        data: "id="+valor,
        url: "content/forms/editar_neutralizacion.php",
        success: function(respuesta) {
        $('#info_obra').hide();
        $('#editar_neutralizaciones').html(respuesta).show();
        }
        });
        }

        function editar_recepcion(valor){
          var valor = valor;
          $.ajax({
          type: "POST",
          data: "id="+valor,
          url: "content/forms/editar_recepcion.php",
          success: function(respuesta) {
          $('#info_obra').hide();
          $('#editar_recepciones').html(respuesta).show();
          }
          });
          }

          function editar_mod_plandetrabajo(valor){
            var valor = valor;
            $.ajax({
            type: "POST",
            data: "id="+valor,
            url: "content/forms/editar_mod_planesdetrabajo_obra.php",
            success: function(respuesta) {
            $('#info_obra').hide();
            $('#editar_mod_plandetrabajo').html(respuesta).show();
            }
            });
            }

            function editar_planilla_cotizacion(valor){
              var valor = valor;
              $.ajax({
              type: "POST",
              data: "id="+valor,
              url: "content/forms/editar_cotizacion_obra.php",
              success: function(respuesta) {
              $('#info_obra').hide();
              $('#editar_cotizacion').html(respuesta).show();
              }
              });
              }     
              function editar_planilla_plandetrabajo(valor){
                var valor = valor;
                $.ajax({
                type: "POST",
                data: "id="+valor,
                url: "content/forms/editar_plan_de_trabajo_obra.php",
                success: function(respuesta) {
                $('#info_obra').hide();
                $('#editar_plandetrabajo').html(respuesta).show();
                }
                });
                }            