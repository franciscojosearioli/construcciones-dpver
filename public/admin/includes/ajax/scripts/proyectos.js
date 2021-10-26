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
    $("#proyectos").hide();
    $("#agregar_proyecto").show();
    $("#btn_agregar").hide();
  }
  else
  {
    $("#proyectos").show();
    $("#agregar_proyecto").hide();
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


  $(document).ready(function() {
    $('#listar_proyectos').DataTable( {
ajax: {
          url : 'includes/ajax/listar_proyectos.php',
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

$('#listar_proyectos_archivo').DataTable( {

dom: 'lBfrtip',        
ajax: {
          url : 'includes/ajax/listar_proyectos_archivo.php',
          type: 'POST'
        },
        buttons: [
        {
          extend: 'collection',
          text: 'Opciones',
          buttons: ['copy','excel','csv','pdf','print']
        },
        {

            text: 'Ayuda',
            action: function (e, node, config){
                $('#ayuda_dt').modal('show')
            }

        }
        ],
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

    $('#listar_proyectos_processing').hide();
} );