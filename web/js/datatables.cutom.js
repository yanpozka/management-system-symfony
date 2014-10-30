$(document).ready(function () {
    //Datatables
    var dontSort = [];
    $('.data-sorting thead th').each(function () {
        if ($(this).hasClass('no_sort')) {
            dontSort.push({"bSortable": false})
        } else {
            dontSort.push(null)
        }
    })

    $('table.data').dataTable({
        "iDisplayLength": 25,
        "aaSorting": [
            [0, 'desc']
        ],
        "oLanguage": {
            "sInfo": "Mostrar _START_ a _END_ de registros _TOTAL_",
            "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
            "sEmptyTable": "No hay elementos para mostrar.",
            "oPaginate": {
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        }
    });
    $('table.data-sorting').dataTable({
        "iDisplayLength": 25,
        "aoColumns": dontSort,
        "aaSorting": [
            [0, 'desc']
        ],
        "oLanguage": {
            "sInfo": "Mostrar _START_ a _END_ de registros _TOTAL_",
            "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
            "sEmptyTable": "No hay elementos para mostrar.",
            "oPaginate": {
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        }
    });
    $('table.data-small').dataTable({
        "iDisplayLength": 5,
        "aaSorting": [
            [2, 'desc']
        ],
        "oLanguage": {
            "sInfo": "Mostrar _START_ a _END_ de registros _TOTAL_",
            "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
            "sEmptyTable": "No hay elementos para mostrar.",
            "oPaginate": {
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        }
    })

    $(prettyPrint)

    $("table.tablas_chulas td")
        .live("click", function () {
            var url = $(this).parent().data('urlocation')
            if (url) {
                if (!$(this).hasClass('option')) {
                    window.location = url;
                }
            }
        });
});
