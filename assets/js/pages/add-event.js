$(document).ready(function() {
    // modal de nueva categoria
    $('#add-category').on('click', function() {
        $('#modal-add-category').modal('show');
    });

    // modal de un nuevo artista
    $('#add-artist').on('click', function() {
        $('#modal-add-artist').modal('show');
    });

    // modal de un nuevo lugar
    $('#add-site').on('click', function() {
        $('#modal-add-site').modal('show');
    });

    // form del modal de categorias
    $("#add-category-form").submit(function(e) {
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
                    // la categoria ya existia
                    $.notify({
                    message: 'Categoria ya existente' 
                    }, {
                        type: 'danger',
                        placement: {
                            from: "top",
                            align: "center"
                        }
                    });
                } else {
                    $.notify({
                        message: 'Categoria Agregada' 
                    }, {
                        type: 'success',
                        placement: {
                            from: "top",
                            align: "center"
                        }
                    });

                    // actualizamos las categorias
                    var arr = form.serialize().split('=');
                    $('#categories-select').append('<option value="' + decodeURI(arr[1]) + '">' + decodeURI(arr[1]) + '</option>');
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
        
        $('#modal-add-category').modal('hide');
    });

    // form del modal de categorias
    $("#add-artist-form").submit(function(e) {
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
                    // la categoria ya existia
                    $.notify({
                    message: 'Artista ya existente' 
                    }, {
                        type: 'danger',
                        placement: {
                            from: "top",
                            align: "center"
                        }
                    });
                } else {
                    $.notify({
                        message: 'Artista Agregado' 
                    }, {
                        type: 'success',
                        placement: {
                            from: "top",
                            align: "center"
                        }
                    });

                    // actualizamos los artistas en el select
                    var arr = form.serialize().split('&');
                    var nombre = arr[0].split('=');

                    $('#artists-select').append('<option value="' + decodeURI(nombre[1]) + '">' + decodeURI(nombre[1]) + '</option>');
                    
                    // actualizo el multiselect
                    $('#artists-select').multiselect('rebuild');
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

        $('#modal-add-artist').modal('hide');

        e.preventDefault(); // para que no se mande el formulario
    });

    // form del modal de LUGARES
    $("#add-site-form").submit(function(e) {
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
                    // el lugar ya existia
                    $.notify({
                    message: 'Lugar ya existente' 
                    }, {
                        type: 'danger',
                        placement: {
                            from: "top",
                            align: "center"
                        }
                    });
                } else {
                    $.notify({
                        message: 'Lugar agregado' 
                    }, {
                        type: 'success',
                        placement: {
                            from: "top",
                            align: "center"
                        }
                    });

                    // actualizamos las categorias
                    var parse = form.serialize().split('&');
                    var establishment = parse[3].split('=');
                    var capacity = parse[4].split('=');

                    $('#site-select').append('<option value="' + decodeURI(establishment[1]) + '">' + decodeURI(establishment[1]) + ' (' + decodeURI(capacity[1]) + ')</option>');
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

        $('#modal-add-site').modal('hide');
    });

    // CAPACIDAD (INPUT)
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

    // MULTISELECT DE ARTISTAS
    $('#artists-select').multiselect({enableFiltering: true});
});

function validateCalendarForm(cantPlazas)
{
    // buscar el lugar que esta seleccionado
    var lugar = $("#site-select option:selected").text();

    // parsear la capacidad
    var capacityArr = lugar.split('(');

    // la capacidad quedaria guardada en capacity[0]
    var capacity = capacityArr[1].split(')');

    // ahora corroboramos que la suma de plazas no sobrepase la capacidad
    var sumaPlazas = 0;
    
    for(var i = 0; i < cantPlazas; i++)
        sumaPlazas += parseInt($('#plaza' + i).val(), 10);

    var ret = sumaPlazas <= parseInt(capacity[0], 10);

    if(!ret)
    {
        $.notify({
            message: 'Las plazas no pueden superar la capacidad del establecimiento' 
        }, {
            type: 'danger',
            placement: {
                from: "top",
                align: "center"
            }
        });

        return false;
    }

    return true;
}