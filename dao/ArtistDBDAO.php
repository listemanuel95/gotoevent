<?php

namespace dao;

use interfaces\IDAO as IDAO;

use model\Artist as Artist;
use model\Genre as Genre;

class ArtistDBDAO extends SingletonDAO implements IDAO {

    public function create($instance)
    {
        if($instance instanceof Artist)
        {
            $conn = new Connection();
            $conn = $conn->get_connection();

            try {
                $statement = $conn->prepare("INSERT INTO `artists` (`name`, `genre_id`) VALUES (:name, :genre)");

                $statement->bindValue(':name', $instance->get_name());
                $statement->bindValue(':genre', $instance->get_genre()->getID());

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

        if($conn != null)
        {
            try {
                $statement = $conn->prepare("SELECT `A`.`id` AS `a_id`, `A`.`name` AS `a_name`, `G`.`genre_name` AS `g_name` 
                                             FROM `artists` AS `A` JOIN `genres` AS `G` ON `A`.`genre_id` = `G`.`id` 
                                             WHERE `name` = '$name'");
                $statement->execute();
                $art = $statement->fetch();

                return new Artist($art['a_name'], new Genre($art['g_name']), $art['a_id']);
                
            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }
    }

    public function retrieve_by_id($id)
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        if($conn != null)
        {
            try {
                $statement = $conn->prepare("SELECT `A`.`id` AS `a_id`, `A`.`name` AS `a_name`, `G`.`genre_name` AS `g_name` 
                                             FROM `artists` AS `A` JOIN `genres` AS `G` ON `A`.`genre_id` = `G`.`id` 
                                             WHERE `A`.`id` = $id");
                $statement->execute();
                $art = $statement->fetch();

                return new Artist($art['a_name'], new Genre($art['g_name']), $art['a_id']);
                
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
                $statement = $conn->prepare("SELECT `A`.`id`, `A`.`name`, `G`.`genre_name` FROM `artists` AS `A` 
                                             JOIN `genres` AS `G` ON `A`.`genre_id` = `G`.`id`");
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