$(document).ready(function() {

$('#listar_informes_inspeccion').DataTable({ 
             ajax: {
          url : 'includes/ajax/listar_informes_inspeccion.php',
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
});

$('.informes-inspeccion').owlCarousel({
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