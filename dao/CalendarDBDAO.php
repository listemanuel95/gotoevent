<?php

namespace dao;

use model\Calendar as Calendar;
use model\Site as Site;
use model\Event as Event;

class CalendarDBDAO extends SingletonDAO implements IDAO {

    public function create($instance)
    {
        if($instance instanceof Calendar)
        {
            if($instance->get_event() instanceof Event && $instance->get_event()->getID() != null
                && $instance->get_site() instanceof Site && $instance->get_site()->getID() != null)
            {
                // lo metemos en la BD con fritas
                $conn = new Connection();
                $conn = $conn->get_connection();

                if($conn != null)
                {
                    try {
                        // convierto el string a una fecha valida, sino lo toma como 00-00-0000
                        $fecha_valida = date('Y-m-d', strtotime($instance->get_date()));

                        $statement = $conn->prepare("INSERT INTO `calendars` (`descr`, `day`, `hour`, `site_id`, `event_id`) VALUES (
                            :desc, :day, :hour, :site, :event)");
                            
                        $statement->bindValue(':desc', $instance->get_desc());
                        $statement->bindValue(':day', $fecha_valida);
                        $statement->bindValue(':hour', $instance->get_time());
                        $statement->bindValue(':site', $instance->get_site()->getID());
                        $statement->bindValue(':event', $instance->get_event()->getID());

                        $statement->execute();

                        $last_id = $conn->lastInsertID();

                        // metemos los artistas en artists_in_calendars
                        foreach($instance->get_artists() as $artist)
                        {
                            $statement = $conn->prepare("INSERT INTO `artists_in_calendars` (`id_artist`, `id_calendar`)
                            VALUES (:id_a, :id_c)");

                            $statement->bindValue(':id_a', $artist->getID());
                            $statement->bindValue(':id_c', $last_id);

                            $statement->execute();
                        }

                        return true;
                    } catch (PDOException $e) { // TODO: excepciones mas copadas
                        echo "ERROR " . $e->getMessage();
                    }
                }
            } else {
                throw new \Exception("ERROR al guardar calendario 1");
            }
        }  else {
            throw new \Exception("ERROR al guardar calendario 2");
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