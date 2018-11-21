<?php

namespace dao;

use interfaces\IDAO as IDAO;

use model\Calendar as Calendar;
use model\Site as Site;
use model\Seat as Seat;
use model\SeatType as SeatType;
use model\Event as Event;
use model\Category as Category;
use model\Artist as Artist;
use model\Genre as Genre;

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

                        return $last_id;
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

    public function retrieve_by_event($event)
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        if($conn != null)
        {
            try {
                $statement = $conn->prepare("SELECT `C`.`id` AS `c_id`, `C`.`descr` AS `c_descr`, `C`.`day` AS `c_day`,
                                                    `C`.`hour` AS `c_hour`, `S`.`id` AS `s_id`, `S`.`city` AS `s_city`,
                                                    `S`.`province` AS `s_province`, `S`.`address` AS `s_address`,
                                                    `S`.`establishment` AS `s_establishment`, `S`.`capacity` AS `s_capacity`
                                                    FROM `calendars` AS `C` JOIN `sites` AS `S` ON `C`.`site_id` = `S`.`id` WHERE `event_id` = :e_id
                                                    ORDER BY `C`.`id` ASC");

                $statement->bindValue(':e_id', $event->getID());                           
                $statement->execute();

                $resultados = $statement->fetchAll();

                $calendarios = array();
                foreach($resultados as $cal)
                {
                    // busco los artistas correspondientes a este calendario
                    $new_statement = $conn->prepare("SELECT * FROM `artists_in_calendars` WHERE `id_calendar` = :c_id");
                    $new_statement->bindValue(':c_id', $cal['c_id']);

                    $new_statement->execute();

                    $artistas = $new_statement->fetchAll();
                   
                    $array_artistas = array();

                    foreach($artistas as $art)
                    {
                        // busco el genero del artista
                        $otro_statement = $conn->prepare("SELECT `A`.`id` AS `id`, `A`.`name` AS `name`, `G`.`genre_name` AS `genre`, `G`.`id` AS `g_id` FROM `artists` AS `A` JOIN `genres` AS `G` ON `A`.`genre_id` = `G`.`id` WHERE `A`.`id` = :a_id");
                        $otro_statement->bindValue(':a_id', $art['id_artist']);

                        $otro_statement->execute();

                        $resultado = $otro_statement->fetch();

                        $array_artistas[] = new Artist($resultado['name'], new Genre($resultado['genre'], $resultado['g_id']), $resultado['id']);
                    }

                    $calendarios[] = new Calendar($cal['c_descr'], $cal['c_day'], $cal['c_hour'], new Site($cal['s_city'], $cal['s_province'], $cal['s_address'], $cal['s_establishment'], $cal['s_capacity'], $cal['s_id']), $event, $array_artistas, $cal['c_id']);
                }

                return $calendarios;
            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }
    }

    public function retrieve_plazas($calendar)
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        if($conn != null)
        {
            try {
                $id = $calendar->getID();
                $statement = $conn->prepare("SELECT `S`.`id` AS `s_id`, `S`.`number` AS `s_num`, `S`.`price` AS `s_price`, `S`.`availability` AS `s_ava`, `ST`.`id` AS `type_id`, `ST`.`type` AS `type_name` 
                                            FROM `seats` AS `S` JOIN `seat_types` AS `ST` ON `S`.`seat_type_id` = `ST`.`id` 
                                            WHERE `calendar_id` = $id");
                $statement->execute();

                $resultados = $statement->fetchAll();
                $plazas = array();

                foreach($resultados as $res)
                    $plazas[] = new Seat($res['s_num'], $res['s_price'], new SeatType($res['type_name'], $res['type_id']), $calendar, $res['s_ava'], $res['s_id']);

                return $plazas;

            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }
    }

    public function retrieve_events_by_artist_id($id)
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        if($conn != null)
        {
            try {
                $statement = $conn->prepare("SELECT DISTINCT `G`.`id` AS `e_id`, `G`.`descr` AS `e_descr`, `G`.`name` AS `e_name`, `G`.`image_link` AS `e_img`, `GC`.`id` AS `c_id`, `GC`.`name` AS `c_name`
                                            FROM `calendars` as `C` JOIN `gigs` AS `G` ON `C`.`event_id` = `G`.`id` JOIN `event_categories` AS `GC` ON `G`.`event_category_id` = `GC`.`id`
                                            JOIN `artists_in_calendars` AS `AC` ON `AC`.`id_calendar` = `C`.`id` WHERE `AC`.`id_artist` = $id");
                $statement->execute();

                $evts = $statement->fetchAll();

                $events = array();

                foreach($evts as $evt)
                    $events[] = new Event($evt['e_name'], $evt['e_descr'], new Category($evt['c_name']), $evt['e_img'], $evt['e_id']);

                return $events;
            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
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