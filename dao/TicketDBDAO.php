<?php

namespace dao;

use model\Ticket as Ticket;

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

    public function update($instance)
    {

    }

    public function delete($instance)
    {
        
    }

}

?>