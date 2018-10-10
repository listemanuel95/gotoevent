<?php

namespace dao;

use model\Calendar as Calendar;
use model\Site as Site;
use model\Event as Event;

use dao\EventDBDAO as EventDBDAO;
use dao\SiteDBDAO as SiteDBDAO;

class CalendarDBDAO extends SingletonDAO implements IDAO {

    public function create($instance)
    {
        if($instance instanceof Site)
        {
            if($instance->get_event() instanceof Event && $instance->get_event()->getID() != null
                && $instance->get_site() instanceof Site && $instance->get_site()->getID() != null)
            {
                // lo metemos en la BD con fritas
                $conn = new Connection();
                $conn = $conn->get_connection();
        
                $event = $instance->get_event();
                $site = $instance->get_site();

                $sitedao = SiteDBDAO::get_instance();
                $site_id = $sitedao->retrieve($site)->getID();

                $eventdao = EventDBDAO::get_instance();
                $event_id = $eventdao->retrieve($event)->getID();

                if($conn != null)
                {
                    try {
                        
                        $desc = $instance->get_desc();
                        $day = $instance->get_date();
                        $hour = $instance->get_time();

                        $statement = $conn->prepare("INSERT INTO calendars (descr, day, hour, site_id, event_id) VALUES (
                            '$desc', '$day', '$hour', '$site_id', '$event_id')");
                            
                        $statement->execute();
                        return true;
                    } catch (PDOException $e) { // TODO: excepciones mas copadas
                        echo "ERROR " . $e->getMessage();
                    }
                }
            } else {
                //throw new Exception("ERROR al guardar evento");
                echo 'hpña';
            }
        }  else {
            //throw new Exception("ERROR al guardar evento");
            echo 'qwe2';
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