<?php

namespace dao;

use interfaces\IDAO as IDAO;

use model\Seat as Seat;

class SeatDBDAO extends SingletonDAO implements IDAO {

    public function create($instance)
    {
        if($instance instanceof Seat)
        {
            $conn = new Connection();
            $conn = $conn->get_connection();

            try {
                $statement = $conn->prepare("INSERT INTO `seats` (`number`, `price`, `seat_type_id`, `calendar_id`, `availability`) VALUES (
                    :number, :price, :s_id, :c_id, 0)");
                    
                $statement->bindValue(':number', $instance->get_number());
                $statement->bindValue(':price', $instance->get_price());
                $statement->bindValue(':s_id', $instance->get_type()->getID());
                $statement->bindValue(':c_id', $instance->get_calendar()->getID());

                $statement->execute();

                return true;
            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }

        } else {
            throw new \Exception("Error en create Seat");
        }

        return false;
    }

    public function retrieve($instance)
    {

    }

    /**
     * Una función más "lightweight" para buscar Seats en la DB; no crea todo el objeto calendario,
     * sino que sólo devuelve los atributos básicos del Seat
     */
    public function retrieve_without_calendar($instance)
    {
        if($instance instanceof Seat)
        {
            $conn = new Connection();
            $conn = $conn->get_connection();

            if($conn != null)
            {
                try {
                    $id = $instance->getID();

                    $statement = $conn->prepare("SELECT * FROM `seats` WHERE `id` = $id");
                    $statement->execute();

                    $res = $statement->fetch();

                    if($res['id'] != null)
                    {
                        return new Seat($res['number'], $res['price'], null, null, $res['availability'], $res['id']);
                    }

                    return false;
                } catch (PDOException $e) { // TODO: excepciones mas copadas
                    echo "ERROR " . $e->getMessage();
                }
            }
        } else {
            throw new \Exception("Error en retrieve Seat");
        }
    }

    public function update($instance)
    {

    }

    public function update_availability($instance)
    {
        if($instance instanceof Seat)
        {
            $conn = new Connection();
            $conn = $conn->get_connection();

            if($conn != null)
            {
                try {
                    $availability = $instance->get_availability();
                    $id = $instance->getID();

                    $statement = $conn->prepare("UPDATE `seats` SET `availability` = $availability WHERE `id` = $id");
                    $statement->execute();

                    return true;
                } catch (PDOException $e) { // TODO: excepciones mas copadas
                    echo "ERROR " . $e->getMessage();
                }
            }
        } else {
            throw new \Exception("Error en retrieve Seat");
        }
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

            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }    

        return null;
    }

    public function retrieve_sold() {

        $conn = new Connection();
        $conn = $conn->get_connection();

        if($conn != null)
        {
            try {

                $statement = $conn->prepare("SELECT `E`.`name`, SUM(`P`.`price`) as `total` FROM `seats` AS `P` 
                                            JOIN `calendars` AS `C` ON `P`.`calendar_id` = `C`.`id` 
                                            JOIN `gigs` AS `E` ON `E`.`id` = `C`.`event_id`
                                            WHERE `availability` = 1
                                            GROUP BY `E`.`id`");
                $statement->execute();
                
                return $statement->fetchAll();

            } catch (PDOException $e) {
                echo "ERROR " . $e->getMessage();
            }
        }
    }

    public function retrieve_sold_total() {

        $conn = new Connection();
        $conn = $conn->get_connection();

        if($conn != null)
        {
            try {

                $statement = $conn->prepare("SELECT SUM(`price`) AS `total` FROM `seats` WHERE `availability` = 1");
                $statement->execute();

                $total = $statement->fetch();
                
                return $total['total'];

            } catch (PDOException $e) {
                echo "ERROR " . $e->getMessage();
            }
        }
    }

}

?>