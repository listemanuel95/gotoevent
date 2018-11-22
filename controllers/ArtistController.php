<?php

namespace controllers;

use dao\ArtistDBDAO as ArtistDBDAO;
use model\Artist as Artist;

use dao\GenreDBDAO as GenreDBDAO;
use model\Genre as Genre;

/**
 * Controladora usada solamente para insertar artistas vía peticiones AJAX, por eso no tiene método index() (no dispara vistas)
 */
class ArtistController {

    /**
	 * Inserta un artista a la base de datos vía una petición POST de AJAX (jQuery)
	 */
    public function ajax_insert($name = null, $genre_name = null) 
    {
        if($name != null && $genre_name != null)
        {
            try {
                $artistdao = ArtistDBDAO::get_instance();
                $genredao = GenreDBDAO::get_instance();

                // si ya existe no lo agregamos 
                $query = $artistdao->retrieve_by_name($name);

                if($query instanceof Artist && $query->getID() != null) 
                    echo "ajax_error"; // los errores de ajax los comparamos con esta string (no usamos la función error())
                else
                    $query = $artistdao->create(new Artist($name, $genredao->retrieve_by_name($genre_name)));
               
            } catch (Exception $e) {
                echo '[Controller->Artist] ' . $e->getMessage();
            }
        }

    }

}

?>