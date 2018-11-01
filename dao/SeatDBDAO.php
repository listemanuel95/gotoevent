<?php

namespace dao;

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
        if($instance instanceof SeatType)
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
        } else {
            throw new \Exception("Error en retrieve Seat");
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

            } catch (PDOException $e) { // TODO: excepciones mas copadas
                echo "ERROR " . $e->getMessage();
            }
        }    

        return null;
    }

}

?>