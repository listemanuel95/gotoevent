<?php

namespace dao;

use model\Event as Event;
use model\Category as Category;

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

                if($conn != null)
                {
                    try {
                        $statement = $conn->prepare("INSERT INTO `gigs` (`event_category_id`, `descr`, `name`, `image_link`) VALUES (
                            :c_id, :e_desc, :e_name, :e_img)");

                        $statement->bindValue(':c_id', $instance->get_category()->getID());
                        $statement->bindValue(':e_desc', $instance->get_desc());
                        $statement->bindValue(':e_name', $instance->get_name());
                        $statement->bindValue(':e_img', $instance->get_image_link());
                            
                        $statement->execute();

                        return true;
                    } catch (PDOException $e) { // TODO: excepciones mas copadas
                        echo "ERROR " . $e->getMessage();
                    }
                }
            } else {
                throw new \Exception("ERROR al guardar evento");
            }
        }  else {
            throw new \Exception("ERROR al guardar evento");
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
                    $statement = $conn->prepare("SELECT `G`.`id` AS `e_id`, `G`.`name` AS `e_name`, `G`.`descr` AS `e_descr`,
                                                        `C`.`name` AS `c_name`, `G`.`image_link` AS `e_img` FROM `gigs` AS `G` JOIN `event_categories` AS `C` 
                                                        ON `G`.`event_category_id` = `C`.`id` WHERE `G`.`name` = '$name'");
                    $statement->execute();

                    $ret_event = $statement->fetch();

                    return new Event($ret_event['e_name'], $ret_event['e_descr'], new Category($ret_event['c_name']), $ret_event['e_img'], $ret_event['e_id']);
                } catch (PDOException $e) { // TODO: excepciones mas copadas
                    echo "ERROR " . $e->getMessage();
                }
            }
        } else {
            return new \Exception("Error en retrieve Event");
        }
    }

    public function update($instance)
    {

    }

    public function delete($instance)
    {
        
    }

    public function retrieve_by_id($id)
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        if($conn != null)
        {
            try {
                $statement = $conn->prepare("SELECT `G`.`id` AS `e_id`, `G`.`name` AS `e_name`, `G`.`descr` AS `e_descr`,
                                                        `C`.`name` AS `c_name`, `G`.`image_link` AS `e_img` FROM `gigs` AS `G` JOIN `event_categories` AS `C` 
                                                        ON `G`.`event_category_id` = `C`.`id` WHERE `G`.`id` = '$id'");
                $statement->execute();
                $evt = $statement->fetch();

                return new Event($evt['e_name'], $evt['e_descr'], new Category($evt['c_name']), $evt['e_img'], $evt['e_id']);
            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }
    }

    /**
     * Devuelve los ultimos 3 eventos, porque pintó
     */
    public function retrieve_last()
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        if($conn != null)
        {
            try {
                $statement = $conn->prepare("SELECT `G`.`id` AS `e_id`, `G`.`name` AS `e_name`, `G`.`descr` AS `e_descr`,
                                                        `C`.`name` AS `c_name`, `G`.`image_link` AS `e_img` FROM `gigs` AS `G` JOIN `event_categories` AS `C` 
                                                        ON `G`.`event_category_id` = `C`.`id` ORDER BY `G`.`id` DESC LIMIT 3");
                $statement->execute();
                $results = $statement->fetchAll();

                $ret = array();
                foreach($results as $evt)
                    $ret[] = new Event($evt['e_name'], $evt['e_descr'], new Category($evt['c_name']), $evt['e_img'], $evt['e_id']);

                return $ret;

            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }
    }

    public function retrieve_all()
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        if($conn != null)
        {
            try {
                $statement = $conn->prepare("SELECT `G`.`id` AS `e_id`, `G`.`name` AS `e_name`, `G`.`descr` AS `e_descr`,
                                                        `C`.`name` AS `c_name`, `G`.`image_link` AS `e_img` FROM `gigs` AS `G` JOIN `event_categories` AS `C` 
                                                        ON `G`.`event_category_id` = `C`.`id` ORDER BY `G`.`id`");
                $statement->execute();
                $results = $statement->fetchAll();

                $ret = array();
                foreach($results as $evt)
                    $ret[] = new Event($evt['e_name'], $evt['e_descr'], new Category($evt['c_name']), $evt['e_img'], $evt['e_id']);

                return $ret;

            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }
    }
}

?>