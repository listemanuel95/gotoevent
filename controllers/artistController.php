<?php

namespace controllers;

use model\Artist as Artist;
use dao\ArtistListDAO as ArtistDAO;

class ArtistController {

    public function index()
    {
        require(ROOT . '/views/addartist.php');
    }

    public function save()
    {
        if(isset($_POST))
        {
            $nombre = isset($_POST['nombre-artista']) ? $_POST['nombre-artista'] : '';
            $genero = isset($_POST['genero']) ? $_POST['genero'] : '';

            $artista = new Artist($nombre, $genero);

            // y lo guardamos
            $dao = ArtistDAO::getInstance();
            $dao->create($artista);
        }
    }
}

?>