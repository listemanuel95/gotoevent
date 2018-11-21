<?php

namespace dao;

use interfaces\IDAO as IDAO;

use model\Ticket as Ticket;
use model\User as User;
use model\Seat as Seat;
use model\Invoice as Invoice;
use model\Site as Site;
use model\Calendar as Calendar;
use model\Event as Event;

class TicketDBDAO extends SingletonDAO implements IDAO {

    public function create($instance)
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        try {

            $statement = $conn->prepare("INSERT INTO `tickets` (`invoice_id`, `seat_id`, `qrcode`)
                                            VALUES (:i_id, :s_id, :qr)");
            
            $statement->bindValue(':i_id', $instance->get_invoice()->getID());
            $statement->bindValue(':s_id', $instance->get_seat()->getID());
            $statement->bindValue(':qr', $instance->get_qrcode());
            $statement->execute(); 

            return true;
        } catch (PDOException $e) { // TODO: excepciones mas copadas
            echo "ERROR " . $e->getMessage();
        }
    }

    public function retrieve($instance)
    {

    }

    /**
     * Devuelve todos los Tickets correspondientes a un usuario.
     * Es una función más "lightweight" porque no me devuelve todos los elementos del calendario
     * incluido en la plaza del ticket, sino sólo los necesarios para mostrar el ticket
     * (evento, descripcion, fecha, hora y lugar). También, en la plaza sólo ponemos el calendario,
     * ningún otro atributo
     */
    public function retrieve_by_user(User $user)
    {
        $conn = new Connection();
        $conn = $conn->get_connection();

        try {

            $user_id = $user->getID();
            $statement = $conn->prepare("SELECT `T`.`id` AS `t_id`, `T`.`seat_id` AS `s_id`, `T`.`qrcode` AS `qr`, `T`.`invoice_id` AS `i_id`,
                                                `G`.`name` AS `g_name`, `C`.`descr` AS `c_desc`, `C`.`day` AS `c_day`, `C`.`hour` AS `c_time`,
                                                `SI`.`city` AS `si_city`, `SI`.`province` AS `si_prov`, `SI`.`address` AS `si_add`, `SI`.`establishment` AS `si_est`
                                         FROM `tickets` AS `T`
                                         JOIN `invoices` AS `I` ON `T`.`invoice_id` = `I`.`id`
                                         JOIN `seats` AS `S` ON `S`.`id` = `T`.`seat_id`
                                         JOIN `calendars` AS `C` ON `S`.`calendar_id` = `C`.`id`
                                         JOIN `gigs` AS `G` ON `C`.`event_id` = `G`.`id`
                                         JOIN `sites` AS `SI` ON `C`.`site_id` = `SI`.`id`
                                         WHERE `I`.`user_id` = $user_id
                                         ORDER BY `G`.`id` ASC");
            
            $statement->execute();

            $tickets = $statement->fetchAll();
            $tickets_array = array();

            foreach($tickets as $thicc)
                $tickets_array[] = new Ticket(new Seat(null, null, null, new Calendar($thicc['c_desc'], $thicc['c_day'], $thicc['c_time'], new Site($thicc['si_city'], $thicc['si_prov'], $thicc['si_add'], $thicc['si_est'], null), new Event($thicc['g_name'], null, null, null, null), null), null), new Invoice($user, $thicc['i_id']), $thicc['qr'], $thicc['t_id']);

            return $tickets_array;
        } catch (PDOException $e) { // TODO: excepciones mas copadas
            echo "ERROR " . $e->getMessage();
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