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

                alert(data);

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

                    //city = qweqwe & province = qweqweq & address = qweqwe & establishment = qweqwe
                    alert(form.serialize());

                    // actualizamos las categorias
                    var parse = form.serialize().split('&');
                    var establishment = parse[3].split('=');
                    $('#site-select').append('<option value="' + decodeURI(establishment[1]) + '">' + decodeURI(establishment[1]) + '</option>');
                    //$('#site-select').append('<option value="' + decodeURI(new_site[1]) + '">' + decodeURI(new_site[1]) + '</option>');
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

});