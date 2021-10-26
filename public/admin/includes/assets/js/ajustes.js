// DATATABLES

/*// Setup - add a text input to each footer cell
$('#1 thead tr').clone(true).appendTo( '#1 thead' );
$('#1 thead tr:eq(1) th').each( function (i) {
var title = $(this).text();
$(this).html( '<input type="text" class="filtro_tabla" placeholder="..." />' );

$( 'input', this ).on( 'keyup change', function () {
if ( table.column(i).search() !== this.value ) {
table
.column(i)
.search( this.value )
.draw();
}
} );
} );*/


$(document).ready(function() {
    
    var table = $('#all').DataTable( {
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
       // scrollY:        "300px",
        fixedColumns:   {
            heightMatch: 'none'
        }
});

$('a.toggle-vis').on( 'click', function (e) {
e.preventDefault();
// Get the column API object
var column = table.column( $(this).attr('data-column') );
// Toggle the visibility
column.visible( ! column.visible() );
} );

} );

$('#1').DataTable({
    bDestroy: true,
    bInfo: true,
    bProcessing: true,
    bDeferRender: true,
    iDisplayLength: 20,
    orderCellsTop: true,
    fixedHeader: true,
    dom: 'Bfrtip',

    buttons: [
    {
        extend: 'excel',
        exportOptions: {
            columns: ':visible',
            columnDefs: { searchable: false, orderable:false, targets: [0,1] }
        }
    },   
    'colvis',
    {
        extend: 'print',
        exportOptions: {
            columns: ':visible',
            columnDefs: { searchable: false, orderable:false, targets: [0,1] }
        }
    }
    ],

    select: {
        style:    'os',
        selector: 'td:first-child'
    },

    language: {
        buttons: {
            excel: 'Exportar a excel',
            colvis: 'Filtrar datos',
            print: 'Imprimir'
        }
    },

    columnDefs: [ {
        "searchable": false,
        "orderable": false,
        "targets": [0,1]
    } ],
    order: [],

    responsive: true,
//scrollY:        "500px",
scrollCollapse: true,
paging:         true
});


$('#plan-oficial').DataTable({
    columnDefs: [ {
        "searchable": false,
        "orderable": false,
        "targets": 0
    } ],
    order: [],

    responsive: true,
//scrollY:        "500px",
scrollCollapse: true,
paging:         true
});
$('#certificados').DataTable({
    columnDefs: [ {
        "searchable": false,
        "orderable": false,
        "targets": 0
    } ],
    order: [],

    responsive: true,
//scrollY:        "500px",
scrollCollapse: true,
paging:         true
});
$('#margen-multa').DataTable({
    columnDefs: [ {
        "searchable": false,
        "orderable": false
    } ],
    order: [],
    responsive: true,
//scrollY:        "500px",
scrollCollapse: true,
paging:         true
});
$('#certificados-redeterminados').DataTable({
    columnDefs: [ {
        "searchable": false,
        "orderable": false,
        "targets": 0
    } ],
    order: [],

    responsive: true,
//scrollY:        "500px",
scrollCollapse: true,
paging:         true
});


$('#default').DataTable({searching: false});     
$('#ordenes').DataTable();
$('#notas').DataTable();
$('#informes-inspeccion').DataTable();
$('#certificados-inspeccion').DataTable();
$('#asistencia-inspeccion').DataTable();

// ROTAR ICONO DE ACCORDION
$(".rotate").click(function(){ $(this).toggleClass("down"); });

// FILE UPLOAD INDIVIDUAL
$(document).ready(function() {
    $('.dropify').dropify();
    $('.dropify-es').dropify({
        messages: {
            default: 'Arrastre y suelte el archivo, o haga click aqui',
            replace: 'Arrastre y suelte el archivo, o haga click aqui para reemplazar',
            remove: 'Eliminar',
            error: 'El archivo es demasiado grande'
        }
    });
    var drEvent = $('#input-file-events').dropify();
    drEvent.on('dropify.beforeClear', function(event, element) {
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
    });
    drEvent.on('dropify.afterClear', function(event, element) {
        alert('File deleted');
    });
    drEvent.on('dropify.errors', function(event, element) {
        console.log('Has Errors');
    });
    var drDestroy = $('#input-file-to-destroy').dropify();
    drDestroy = drDestroy.data('dropify')
    $('#toggleDropify').on('click', function(e) {
        e.preventDefault();
        if (drDestroy.isDropified()) {
            drDestroy.destroy();
        } else {
            drDestroy.init();
        }
    })
});

function AgregarModificacion() {
    $("<div>").load("includes/ajax/AddModificaciones.php", function() {
        $("#AddModificaciones").append($(this).html());
        $("#AddBotonModificacion").remove();
    }); 

}
function AgregarAmpliacion() {
    $("<div>").load("includes/ajax/AddAmpliaciones.php", function() {
        $("#AddAmpliaciones").append($(this).html());
        $("#AddBotonAmpliacion").remove();
    });    
}
function AgregarNeutralizacion() {
    $("<div>").load("includes/ajax/AddNeutralizaciones.php", function() {
        $("#AddNeutralizaciones").append($(this).html());
        $("#AddBotonNeutralizacion").remove();
    });    
}     

$(document).ready(function() {
    $('#icon-reportes').click(function() {
        $(this).toggleClass('fa-angle-down').toggleClass('fa-angle-up');
    });
    $('#icon-obras-hide').click(function() {
        $(this).toggleClass('fa-angle-down').toggleClass('fa-angle-up');
    });
    $('#icon-obras').click(function() {
        $(this).toggleClass('fa-angle-up').toggleClass('fa-angle-down');
    });

});


$('.owl-nav').hide();