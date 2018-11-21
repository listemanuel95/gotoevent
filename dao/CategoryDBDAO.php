<?php

namespace dao;

use interfaces\IDAO as IDAO;

use model\Category as Category;

class CategoryDBDAO extends SingletonDAO implements IDAO {

    public function create($instance)
    {
        if($instance instanceof Category)
        {
            $conn = new Connection();
            $conn = $conn->get_connection();

            try {
                $name = $instance->get_name();
                $statement = $conn->prepare("INSERT INTO `event_categories` (`name`) VALUES ('$name')");
                $statement->execute();

                return true;
            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }

        } else {
            throw new \Exception("Error en create category");
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
                    $statement = $conn->prepare("SELECT * FROM `event_categories` WHERE `name` = '$name'");
                    $statement->execute();
                    $cat = $statement->fetch();
                    $ret = new Category($cat['name'], $cat['id']);
                    
                    return $ret;
                } catch (PDOException $e) { // TODO: excepciones mas copadas
                    echo "ERROR " . $e->getMessage();
                }
            }
        } else {
            throw new \Exception("Error en retrieve Category");
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
                $statement = $conn->prepare("SELECT * FROM `event_categories` WHERE `id` = '$id'");
                $statement->execute();
                $cat = $statement->fetch();
                $ret = new Category($cat['name'], $cat['id']);
                
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
                $statement = $conn->prepare("SELECT * FROM event_categories");
                $statement->execute();

                $results = $statement->fetchAll();
            
                $ret = array();
                foreach($results as $cat)
                    $ret[] = new Category($cat['name'], $cat['id']);

                return $ret;
            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }
    }

}

?>