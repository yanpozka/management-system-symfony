$(document).ready(function() {

    $('.datepicker').datepicker({"format": 'yyyy-mm-dd', "autoclose": true});

    // Para las ventanitas modal via Ajax y por método get(url ...)
    $('[data-toggle="modal"]').bind('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var $respuesta_modal = $('#respuesta_modal')
        if (url.indexOf('#') == 0) {
            $respuesta_modal.modal('show');
        } else {
            $.get(url, function(data) {
                $respuesta_modal.html(data);
                $respuesta_modal.modal('show');
            }).success(function() {
                //enfocar primer input
                $respuesta_modal.find('input:text:visible:first').focus();
            })
        }
    })
    $.ajaxSetup({
        // Disable caching of AJAX responses
        cache: false
    })

//Tooltip
    $('.tt').tooltip()

//Popover
    $('.po').popover({html: true})
    $('.po-delete').live("click", function(e) {
        $('.po').popover('hide')
        $('tr#' + $('input.id').val()).remove()
    })
    $('.po-close').live("click", function(e) {
        $('.po').popover('hide')
    })

//Notification
    $notification = $('.notification')
    $notification
            .animate({'bottom': '10px'}, 700)
    setTimeout(function(){
        $notification.animate({'margin-bottom': '-300px'}, 1500)
    }, 8000)
    $notification.click(function() {
        $notification.animate({'margin-bottom': '-300px'}, 1500)
    })

//add class to last ui li
    $("ul.todo li:last-child, ul.user-list li:last-child").addClass("last-item")

//Custom Selectmenu
    $("select").select2()

//details no bottom border on last li
    $('ul.details > li:last-child').css('border-bottom', '0px')
})