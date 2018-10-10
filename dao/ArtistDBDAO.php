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
        } else {
            throw new \Exception("Error en create Artist");
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

    public function retrieve_all()
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        if($conn != null)
        {
            try {
                $statement = $conn->prepare("SELECT A.id, A.name, G.genre_name FROM artists AS A JOIN genres AS G ON A.genre_id = G.id");
                $statement->execute();

                $results = $statement->fetchAll();
                $ret = array();
                
                foreach($results as $art)
                    $ret[] = new Artist($art['name'], $art['genre_name'], $art['id']);

                return $ret;
            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }
        
    }
}

?>