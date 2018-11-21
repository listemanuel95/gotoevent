<?php

namespace dao;

use interfaces\IDAO as IDAO;

use model\Genre as Genre;

class GenreDBDAO extends singletonDAO implements IDAO {

    public function create($instance)
    {
        if($instance instanceof Genre)
        {
            $conn = new Connection();
            $conn = $conn->get_connection();

            try {
                $name = $instance->get_name();
                $statement = $conn->prepare("INSERT INTO `genres` (`genre_name`) VALUES ('$name')");
                
                $statement->execute();

                return true;
            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }

        } else {
            throw new \Exception("Error en create genre");
        }

        return false;
    }

    public function retrieve($instance) // por nombre
    {
        if($instance instanceof Category)
        {
            $conn = new Connection();
            $conn = $conn->get_connection();

            if($conn != null)
            {
                try {
                    $name = $instance->get_name();
                    $statement = $conn->prepare("SELECT * FROM `genres` WHERE `genre_name` = '$name'");
                    $statement->execute();
                    $query_gen = $statement->fetch();
                    $ret = new Genre($query_gen['genre_name'], $query_gen['id']);
                    
                    return $ret;
                } catch (PDOException $e) { // TODO: excepciones mas copadas
                    echo "ERROR " . $e->getMessage();
                }
            }
        } else {
            throw new \Exception("Error en retrieve genre");
        }

        return null;
    }

    public function retrieve_by_id($id)
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        if($conn != null)
        {
            try {
                $statement = $conn->prepare("SELECT * FROM `genres` WHERE `id` = '$id'");
                $statement->execute();
                $gen = $statement->fetch();
                $ret = new Genre($gen['genre_name'], $gen['id']);
                
                return $ret;
            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }
    }

    public function retrieve_by_name($name)
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        if($conn != null)
        {
            try {
                $statement = $conn->prepare("SELECT * FROM `genres` WHERE `genre_name` = '$name'");
                $statement->execute();
                $gen = $statement->fetch();
                $ret = new Genre($gen['genre_name'], $gen['id']);
                
                return $ret;
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
                $statement = $conn->prepare("SELECT * FROM genres");
                $statement->execute();

                $results = $statement->fetchAll();
            
                $ret = array();
                foreach($results as $gen)
                    $ret[] = new Genre($gen['genre_name'], $gen['id']);

                return $ret;
            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }
    }

}

?>