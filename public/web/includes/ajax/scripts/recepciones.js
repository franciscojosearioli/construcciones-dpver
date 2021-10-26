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
		$("#listar_recepciones").hide();
		$("#agregar_recepcion").show();
		$("#btn_agregar").hide();
	}
	else
	{
		$("#listar_recepciones").show();
		$("#agregar_recepcion").hide();
		$("#btn_agregar").show();
	}
}

function form_editar(flag)
{
	if (flag)
	{
		$("#listar_recepciones").hide();
		$("#editar_recepcion").show();
	}
	else
	{
		$("#listar_recepciones").show();
		$("#editar_recepcion").hide();
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

function submit_editar_recepcion()
{
	validar = $("#form_editar_recepcion").validate();
	if(validar){
	$('#form_editar_recepcion').submit();
	}
}

inicio();

function editar_recepcion(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/forms/editar_recepcion.php",
success: function(respuesta) {
$('#listar_recepciones').hide();
$('#editar_recepcion').html(respuesta).show();
}
});
}

function movimiento_recepcion(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/movimientos_rp.php",
success: function(respuesta) {
$('#movimientos_recepciones').html(respuesta).appendTo('body');
$('#movimientos_rp').modal('show');
}
});
}


$(document).ready(function() {
        $('#lista_recepciones_todo').DataTable( {
              processing: false,
              ajax: 
              {
                url : 'includes/ajax/lista_recepciones_todo.php',
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
                $('#lista_recepciones_tramite').DataTable( {
                  processing: false,
                  ajax: 
                  {
                    url : 'includes/ajax/lista_recepciones_tramite.php',
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
                    $('#lista_recepciones_aprobado').DataTable( {
                      processing: false,
                      ajax: 
                      {
                        url : 'includes/ajax/lista_recepciones_aprobado.php',
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