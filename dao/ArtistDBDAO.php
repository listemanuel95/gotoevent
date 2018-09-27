<?php

namespace dao;

use model\Artist as Artist;

class ArtistDBDAO extends SingletonDAO implements IDAO {

    public function create($instance)
    {
        if($instance instanceof Artist)
        {
            $conn = new Connection();
            $conn = $conn->get_connection();

            if($conn)
                echo 'conexion establecida';
        }
    }

    public function retrieve($instance)
    {

    }

    public function update($instance)
    {

    }

    public function delete($instance)
    {
        
    }

}

?>