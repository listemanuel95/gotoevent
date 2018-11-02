$(document).ready(function() {
    // the body of this function is in assets/js/now-ui-kit.js
    //nowuiKit.initSliders();

    var calendarID;

    $('.btn-comprar').on('click', function() {
        calendarID = $(this).attr('id');
        $('#modal-buy-ticket' + calendarID).modal('show');
    });

    $('.btn-not-logged').on('click', function() {
        $.notify({
            message: 'Inicia sesión para comprar. Podes registrarte <a style="color:white;" href="../../register"><u>acá</u></a>.' 
            }, {
                type: 'danger',
                placement: {
                    from: "top",
                    align: "center"
                }
        });
    });

    $('.buy-tickets-form').submit(function(e) {

        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(data)
            {                
                // sacamos espacios y saltos de linea para comparar
                var data_sanitized = data.replace(/ /g,'');
                data_sanitized = data_sanitized.replace(/\n|\r/g, "");

                if(data_sanitized.localeCompare("ajax_error") == 0)
                {
                    $.notify({
                    message: 'Las plazas solicitadas no estan disponibles' 
                    }, {
                        type: 'danger',
                        placement: {
                            from: "top",
                            align: "center"
                        }
                    });
                } else {

                    $.notify({
                        message: 'Compra agregada al carrito' 
                    }, {
                        type: 'success',
                        placement: {
                            from: "top",
                            align: "center"
                        }
                    });

                    setTimeout(function(){
                        location.reload();
                    }, 1500);
                }

            }, error: function() {
                $.notify({
                    message: 'Error al conectar' 
                }, {
                    type: 'danger',
                    placement: {
                        from: "top",
                        align: "center"
                    }
                });
            }
        });

        e.preventDefault(); // para que no se mande el formulario
        $('#modal-buy-ticket' + calendarID).modal('hide');
    });

    $(".number-input").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl/cmd+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: Ctrl/cmd+C
            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: Ctrl/cmd+X
            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});

function scrollToDownload() {

    if ($('.section-download').length != 0) {
        $("html, body").animate({
        scrollTop: $('.section-download').offset().top
        }, 1000);
    }
}