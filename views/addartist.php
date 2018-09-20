<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <title>Agregar Artista</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4 text-center">
                <h1>Agregar artista</h1><br>
                <form action="artist/save" method="post">
                    <input class="form-control" type="text" placeholder="Nombre..." name="nombre-artista"><br>
                    <select class="form-control" name="genero">
                        <option value="rock">Rock and roll</option>
                        <option value="cumbia">Cumbia</option>
                        <option value="heavy-metal">Heavy Metal</option>
                        <option value="punchi-punchi">Electronica</option>
                    </select><br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> 

</body>
</html>