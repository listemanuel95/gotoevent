<?php

namespace controllers;

use dao\ArtistDBDAO as ArtistDBDAO;
use model\Artist as Artist;

use dao\GenreDBDAO as GenreDBDAO;
use model\Genre as Genre;

class ArtistController {

    public function index($name = null, $genre_name = null) 
    {
        if($name != null && $genre_name != null)
        {
            try {
                $artistdao = ArtistDBDAO::get_instance();
                $genredao = GenreDBDAO::get_instance();

                //echo 'entre aca';

                // Si ya existe no lo agregamos 
                $query = $artistdao->retrieve_by_name($name);

                if($query instanceof Artist && $query->getID() != null) 
                {
                    echo "ajax_error";
                } else {
                    $query = $artistdao->create(new Artist($name, $genredao->retrieve_by_name($genre_name)));
                }
               
            } catch (Exception $e) {
                echo 'excepcion !!!!';
            }
            
        } else {
            header("Location: index");
        }

    }

}

?>