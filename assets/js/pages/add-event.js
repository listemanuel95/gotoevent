$(document).ready(function() {
    // modal de nueva categoria
    $('#add-category').on('click', function() {
        $('#modal-add-category').modal('show');
    });

    // modal de un nuevo artista
    $('#add-artist').on('click', function() {
        $('#modal-add-artist').modal('show');
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
                $('#modal-add-category').modal('hide');

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
                $('#modal-add-artist').modal('hide');

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

                    // actualizamos las categorias
                    var arr = form.serialize().split('&');
                    var nombre = arr[0].split('=');
                    $('#artists-select').append('<option value="' + decodeURI(nombre[1]) + '">' + decodeURI(nombre[1]) + '</option>');
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
    });

});