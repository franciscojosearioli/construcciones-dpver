//Función que se ejecuta al inicio
function inicio(){
    form_agregar_modificacion(false);
    form_agregar_ampliacion(false);
    form_agregar_neutralizacion(false);
    form_agregar_mod_planesdetrabajo(false);
    form_editar_modificacion(false);
    form_editar_ampliacion(false);
    form_editar_neutralizacion(false);
  }
  
  //Función mostrar/ocultar formulario
  function form_agregar_modificacion(flag)
  {
    if (flag)
    {
      $("#lista_modificaciones").hide();
      $("#agregar_modificacion").show();
      $("#btn_agregar").hide();
    }
    else
    {
      $("#lista_modificaciones").show();
      $("#agregar_modificacion").hide();
      $("#btn_agregar").show();
    }
  }
  function form_agregar_ampliacion(flag)
  {
    if (flag)
    {
      $("#lista_ampliaciones").hide();
      $("#agregar_ampliacion").show();
      $("#btn_agregar").hide();
    }
    else
    {
      $("#lista_ampliaciones").show();
      $("#agregar_ampliacion").hide();
      $("#btn_agregar").show();
    }
  }
  function form_agregar_neutralizacion(flag)
  {
    if (flag)
    {
      $("#lista_neutralizaciones").hide();
      $("#agregar_neutralizacion").show();
      $("#btn_agregar").hide();
    }
    else
    {
      $("#lista_neutralizaciones").show();
      $("#agregar_neutralizacion").hide();
      $("#btn_agregar").show();
    }
  }  

  function form_agregar_mod_planesdetrabajo(flag)
  {
    if (flag)
    {
      $("#lista_mod_planesdetrabajo").hide();
      $("#agregar_mod_planesdetrabajo").show();
      $("#btn_agregar").hide();
    }
    else
    {
      $("#lista_mod_planesdetrabajo").show();
      $("#agregar_mod_planesdetrabajo").hide();
      $("#btn_agregar").show();
    }
  }

  function form_editar_modificacion(flag)
  {
    if (flag)
    {
      $("#lista_modificaciones").hide();
      $("#editar_modificaciones").show();
    }
    else
    {
      $("#lista_modificaciones").show();
      $("#editar_modificaciones").hide();
    }
  }
  function form_editar_ampliacion(flag)
  {
    if (flag)
    {
      $("#lista_ampliaciones").hide();
      $("#editar_ampliaciones").show();
    }
    else
    {
      $("#lista_ampliaciones").show();
      $("#editar_ampliaciones").hide();
    }
  }
  function form_editar_neutralizacion(flag)
  {
    if (flag)
    {
      $("#lista_neutralizaciones").hide();
      $("#editar_neutralizaciones").show();
    }
    else
    {
      $("#lista_neutralizaciones").show();
      $("#editar_neutralizaciones").hide();
    }
  }
  

  function form_editar_mod_planesdetrabajo(flag)
  {
    if (flag)
    {
      $("#lista_mod_planesdetrabajo").hide();
      $("#editar_mod_planesdetrabajo").show();
      $("#btn_agregar").hide();
    }
    else
    {
      $("#lista_mod_planesdetrabajo").show();
      $("#editar_mod_planesdetrabajo").hide();
      $("#btn_agregar").show();
    }
  }

  //Función cancelar formulario
  function cancelar_agregar()
  {
    form_agregar_modificacion(false);
    form_agregar_ampliacion(false);
    form_agregar_neutralizacion(false);
    form_agregar_mod_planesdetrabajo(false);
  }
  
  function cancelar_editar()
  {
    form_editar_modificacion(false);
    form_editar_ampliacion(false);
    form_editar_neutralizacion(false);
    form_editar_mod_planesdetrabajo(false);
  }
  
  //Función enviar formulario
  function submit_agregar()
  {
    validar = $("#form_agregar_obra").validate();
    if(validar){
    $('#form_agregar_obra').submit();
    }
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

function editar_modificacion(valor){
  var valor = valor;
  $.ajax({
  type: "POST",
  data: "id="+valor,
  url: "content/forms/editar_modificacion.php",
  success: function(respuesta) {
  $('#lista_modificaciones').hide();
  $('#editar_modificacion').html(respuesta).show();
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
    $('#lista_ampliaciones').hide();
    $('#editar_ampliacion').html(respuesta).show();
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
      $('#lista_neutralizaciones').hide();
      $('#editar_neutralizacion').html(respuesta).show();
      }
      });
      }


      function editar_mod_plandetrabajo(valor){
        var valor = valor;
        $.ajax({
        type: "POST",
        data: "id="+valor,
        url: "content/forms/editar_mod_planesdetrabajo.php",
        success: function(respuesta) {
        $('#lista_mod_planesdetrabajo').hide();
        $('#editar_mod_planesdetrabajo').html(respuesta).show();
        }
        });
        }
      

      $(document).ready(function() {
        $('#lista_modificaciones_todo').DataTable( {
              processing: false,
              ajax: 
              {
                url : 'includes/ajax/lista_modificaciones_todo.php',
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
                $('#lista_modificaciones_tramite').DataTable( {
                  processing: false,
                  ajax: 
                  {
                    url : 'includes/ajax/lista_modificaciones_tramite.php',
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
                    $('#lista_modificaciones_aprobado').DataTable( {
                      processing: false,
                      ajax: 
                      {
                        url : 'includes/ajax/lista_modificaciones_aprobado.php',
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
                        $('#lista_ampliaciones_todo').DataTable( {
                          processing: false,
                          ajax: 
                          {
                            url : 'includes/ajax/lista_ampliaciones_todo.php',
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
                            $('#lista_ampliaciones_tramite').DataTable( {
                              processing: false,
                              ajax: 
                              {
                                url : 'includes/ajax/lista_ampliaciones_tramite.php',
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
                                $('#lista_ampliaciones_aprobado').DataTable( {
                                  processing: false,
                                  ajax: 
                                  {
                                    url : 'includes/ajax/lista_ampliaciones_aprobado.php',
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
                                    $('#lista_neutralizaciones_todo').DataTable( {
                                      processing: false,
                                      ajax: 
                                      {
                                        url : 'includes/ajax/lista_neutralizaciones_todo.php',
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
                                        $('#lista_neutralizaciones_tramite').DataTable( {
                                          processing: false,
                                          ajax: 
                                          {
                                            url : 'includes/ajax/lista_neutralizaciones_tramite.php',
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
                                            $('#lista_neutralizaciones_aprobado').DataTable( {
                                              processing: false,
                                              ajax: 
                                              {
                                                url : 'includes/ajax/lista_neutralizaciones_aprobado.php',
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
                                                $('#lista_mod_planesdetrabajo_todo').DataTable( {
                                                    processing: false,
                                                    ajax: 
                                                    {
                                                      url : 'includes/ajax/lista_mod_planesdetrabajo_todo.php',
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
                                                      $('#lista_mod_planesdetrabajo_tramite').DataTable( {
                                                          processing: false,
                                                          ajax: 
                                                          {
                                                            url : 'includes/ajax/lista_mod_planesdetrabajo_tramite.php',
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
                                                            $('#lista_mod_planesdetrabajo_aprobado').DataTable( {
                                                                processing: false,
                                                                ajax: 
                                                                {
                                                                  url : 'includes/ajax/lista_mod_planesdetrabajo_aprobado.php',
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
                                  });