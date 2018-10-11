<?php

namespace dao;

use model\Artist as Artist;
use model\Genre as Genre;
use dao\GenreDBDAO as GenreDBDAO;

class ArtistDBDAO extends SingletonDAO implements IDAO {

    public function create($instance)
    {
        if($instance instanceof Artist)
        {
            $conn = new Connection();
            $conn = $conn->get_connection();

            try {
                $name = $instance->get_name();
                $genre_id = $instance->get_genre()->getID();
                $statement = $conn->prepare("INSERT INTO `artists` (`name`, `genre_id`) VALUES ('$name', '$genre_id')");
                $statement->execute();
                
                return true;
            } catch(Exception $e) {
                echo $e->getMessage();
            } 
        } else {    
            throw new \Exception("Error en create Artist");
        }

        return false;
    }

    public function retrieve($instance) 
    {

    }

    public function retrieve_by_name($name)
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        $genredb = GenreDBDAO::get_instance();

        if($conn != null)
        {
            try {
                $statement = $conn->prepare("SELECT * FROM `artists` WHERE `name` = '$name'");
                $statement->execute();
                $art = $statement->fetch();

                if($art['id'] != null) {
                    $genre = $genredb->retrieve_by_id($art['genre_id']);

                    if($genre instanceof Genre && $genre->getID() != null)
                        $ret = new Artist($art['name'], $genre, $art['id']);
                    else
                        throw new \Exception("Error al agarrar genero");

                    return $ret;
                } else {
                    return false;
                }
            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }
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