<?php

namespace dao;

use model\Event as Event;
use model\Category as Category;

use dao\CategoryDBDAO as CategoryDBDAO;

class EventDBDAO extends SingletonDAO implements IDAO {

    public function create($instance)
    {
        if($instance instanceof Event)
        {
            if($instance->get_category() instanceof Category && $instance->get_category()->getID() != null)
            {
                // lo metemos en la BD con fritas
                $conn = new Connection();
                $conn = $conn->get_connection();
        
                $cat = $instance->get_category();

                if($conn != null)
                {
                    try {
                        $c_id = $cat->getID();
                        $e_desc = $instance->get_desc();
                        $e_name = $instance->get_name();

                        $statement = $conn->prepare("INSERT INTO gigs (event_category_id, descr, name) VALUES (
                            '$c_id', '$e_desc', '$e_name')");
                            
                        $statement->execute();
                        return true;
                    } catch (PDOException $e) { // TODO: excepciones mas copadas
                        echo "ERROR " . $e->getMessage();
                    }
                }
            } else {
                throw new Exception("ERROR al guardar evento");
            }
        }  else {
            throw new Exception("ERROR al guardar evento");
        }
    }

    public function retrieve($instance) // por nombre
    {
        if($instance instanceof Event)
        {
            $conn = new Connection();
            $conn = $conn->get_connection();

            if($conn != null)
            {
                try {
                    $name = $instance->get_name();
                    $statement = $conn->prepare("SELECT * FROM gigs WHERE name = '$name'");
                    $statement->execute();

                    $ret_event = $statement->fetch();

                    /* como el objeto Evento recibe un objeto Categoria y aca solo tengo el ID
                        me tengo que meter en el DAO de categorias para buscar un Objeto completo */
                    $categorydao = CategoryDBDAO::get_instance();
                    
                    return new Event($ret_event['name'], $ret_event['descr'], $categorydao->retrieve_by_id($ret_event['event_category_id']), $ret_event['id']);
                } catch (PDOException $e) { // TODO: excepciones mas copadas
                    echo "ERROR " . $e->getMessage();
                }
            }
        }
    }

    public function update($instance)
    {

    }

    public function delete($instance)
    {
        
    }

}

?>